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
		$Users = User::all(); // usersテーブルから全てのユーザー情報を取得
		$courses = Course::all(); // Coursesテーブルから全てのコース情報を取得
		$Reservations = Reservation::all();

		return view('Reservations.Reserve_create', compact('Users', 'courses', 'Reservations' , 'course_time'));
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
			'Add_option1' => 'max:100',
			'Add_option2' => 'max:100',
			'Add_option3' => 'max:100',
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

		// 予約データの作成// $course_time = $request->input('course_time');		dd($request->input('course_id'));
		$name = $request->input('name');
		$tel_number = $request->input('tel_number');
		$email = $request->input('email');
		$reservation_date1 = $request->input('reservation_date1');
		$reservation_date2 = $request->input('reservation_date2');
		$start_time1 = $request->input('start_time1');
		$start_time2 = $request->input('start_time2');
		$course = $request->input('course');
		$course_row = Course::findOrFail($request->input('course'));
		$course_time = $course_row->time;
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
			'course_time' => $course_time,
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
	/**
	 * ユーザー編集画面
	 */
	public function edit(string $id)
	{
		if (Auth::id() == $id) {
			$Reservation = Reservation::findOrFail($id);
			$courses = Course::all(); // Coursesモデルから全てのコース情報を取得
			return view('staffs.edit', compact('Reservation', 'courses'))->with(['id' => $id]);
		} else {
			abort(404, 'Unauthorized');
		}
	}

	public function update(Request $request)
	{ //個々の中身は明日核
		$id = $request->id;
		$validatedData = $request->validate([
			'name' => 'required|string|max:255',
			'email' => 'required|string|email|max:255',
			'tel_number' => ['required', 'string', 'max:255', 'regex:/^[0-9]{2,4}-[0-9]{2,4}-[0-9]{3,4}$/'],
			'height' => 'numeric|max:999',
			'body_weight' => 'numeric|max:999',
			'age' => 'numeric|max:999',
			'sports_history' => 'max:100',
			'possible_option_1' => 'max:100',
			'possible_option_2' => 'max:100',
			'possible_option_3' => 'max:100',
			'Remarks_column1' => 'max:100',
			'Remarks_column2' => 'max:100',
			'profile' => 'max:500',
			'owner' => 'boolean',
			'image_path' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
		]);
		$Reservation = Reservation::findOrFail($id);
		$Reservations = Reservation::where('id', $id)->get();
		$Reservation->name = $validatedData['name'];
		$Reservation->email = $validatedData['email'];
		$Reservation->tel_number = $validatedData['tel_number'];
		$Reservation->height = $validatedData['height'];
		$Reservation->body_weight = $validatedData['body_weight'];
		$Reservation->age = $validatedData['age'];
		$Reservation->sports_history = $validatedData['sports_history'];
		$Reservation->possible_option_1 = $validatedData['possible_option_1'];
		$Reservation->possible_option_2 = $validatedData['possible_option_2'];
		$Reservation->possible_option_3 = $validatedData['possible_option_3'];
		$Reservation->Remarks_column1 = $validatedData['Remarks_column1'];
		$Reservation->Remarks_column2 = $validatedData['Remarks_column2'];
		$Reservation->profile = $validatedData['profile'];
		$Reservation->owner = $validatedData['owner'];

		$Reservation->save();

		return view('staffs.index', ['Reservations' => $Reservations])->with('message', 'ユーザー情報を変更しました');
	}

	/**		dd($request->file('image_path'));
	 * ユーザー情報を削除
	 */
	public function destroy(string $id)
	{
		$Reservation = Reservation::findOrFail($id);
		$Reservation->delete();
		return redirect()->back()->with('message', 'Reservationを削除しました');
	}
}
