<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Course; // 追加
use Illuminate\Support\MessageBag;

class ReservationController extends Controller
{
	public function index(Request $request)
	{
		$Users = User::all(); // usersテーブルから全てのユーザー情報を取得
		$courses = Course::all(); // Coursesモデルから全てのコース情報を取得
		$Reservations = Reservation::all();
		return view('Reservations.Reserve_create', compact('Users', 'Reservations', 'courses'));
	}

	public function create(Request $request)
	{
		$courses = Course::all(); // Coursesテーブルから全てのコース情報を取得
		$course = Course::findOrFail($request->input('course_id'));
		$course_time = $course->time;
		$Reservations = Reservation::all();
		return view('Reservations.Reserve_create', compact('courses', 'Reservations'));
	}

	public function store(Request $request)
	{
		$this->validate($request, [
			'name' => 'required|max:100',
			'tel_number' => 'required|max:100',
			'email' => 'required|max:255',
			'reservation_date1' => 'required|max:100',
			'reservation_date2' => 'required|max:100',
			'start_time1' => 'required|max:100',
			'start_time2' => 'required|max:100',
			// 'course_time' => [
			// 	'required',
			// 	function ($attribute, $value, $fail) use ($request) {
			// 		$course = Course::findOrFail($request->input('course_id'));
			// 		$existingReservations = $course->reservations;
			// 		foreach ($existingReservations as $existingReservation) {
			// 			// 競合する予約がある場合はエラーメッセージを出力
			// 			if ($value >= $existingReservation->start_time && $value < $existingReservation->end_time) {
			// 				$fail('選択した施術時間は他の予約の施術時間中なので予約できません。');
			// 			}
			// 		}
			// 	},
			// ],
			'course' => 'required|max:15',
			'Add_option1' => 'required|max:100',
			'Add_option2' => 'required|max:100',
			'Add_option3' => 'required|max:100',
			'therapist_id1' => 'required|max:100',
			'therapist_id2' => 'required|max:100',
			'flexRadioDefault' => 'required|max:100', // フォームの項目名を修正
		]);

		// 予約の競合チェック
		$reservationDate1 = $request->input('reservation_date1');
		$reservationDate2 = $request->input('reservation_date2');
		$startTime1 = $request->input('start_time1');
		$startTime2 = $request->input('start_time2');
		$existingReservation = Reservation::checkReservationOverlap($reservationDate1, $reservationDate2, $startTime1, $startTime2);

		if ($existingReservation) {
			$errors = new MessageBag(['error' => '選択した施術開始時間は他の予約の施術時間中なので予約できません。']);
			return redirect()->back()->withErrors($errors)->withInput($request->input());

			// リダイレクト
			return redirect()->back();
		}

		// 予約データの作成
		$name = $request->input('name');
		$tel_number = $request->input('tel_number');
		$email = $request->input('email');
		$reservation_date1 = $request->input('reservation_date1');
		$reservation_date2 = $request->input('reservation_date2');
		$start_time1 = $request->input('start_time1');
		$start_time2 = $request->input('start_time2');
		$course = $request->input('course');
		// $course_time = $request->input('course_time');
		$Add_option1 = $request->input('Add_option1');
		$Add_option2 = $request->input('Add_option2');
		$Add_option3 = $request->input('Add_option3');
		$therapist_id1 = $request->therapist_id1;
		$therapist_id2 = $request->therapist_id2;
		$location = $request->input('location');
		$request_data = $request->input('request');

		Reservation::create([
			'name' => $name,
			'tel_number' => $tel_number,
			'email' => $email,
			'reservation_date1' => $reservation_date1,
			'reservation_date2' => $reservation_date2,
			'start_time1' => $start_time1,
			'start_time2' => $start_time2,
			'course' => $course,
			// 'course_time' => $course_time,
			'Add_option1' => $Add_option1,
			'Add_option2' => $Add_option2,
			'Add_option3' => $Add_option3,
			'therapist_id1' => $therapist_id1,
			'therapist_id2' => $therapist_id2,
			'location' => $location,
			'request' => $request_data,
		]);

		// 予約完了後の処理
		// ...

		$Reservations = Reservation::all();
		return redirect()->route('home')->with(
			'success',
			'予約が完了しました。'
		);
	}
}
