<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Course; // 追加 戦闘大文字はクラス名くらい。
use Illuminate\Support\MessageBag;
use Illuminate\Validation\Rule;

class ReservationController extends Controller
{
	public function index(Request $request)
	{
		$Users = User::all(); // usersテーブルから全てのユーザー情報を取得
		$courses = Course::all(); // Coursesモデルから全てのコース情報を取得
		return view('reservations.reserve_create', compact('Users', 'courses'));
	}

	public function create(Request $request)
	{
		$Users = User::all(); // usersテーブルから全てのユーザー情報を取得
		$courses = Course::all(); // Coursesテーブルから全てのコース情報を取得
		$Reservations = Reservation::all();

		return view('reservations.reserve_create', compact('Users', 'courses', 'Reservations', 'course_time'));
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
			'request' => 'max:500'
		]);


		// 予約の競合チェック
		$reservationDate1 = $request->input('reservation_date1');
		// $reservationDate2 = $request->input('reservation_date2');
		$startTime1 = $request->input('start_time1');
		// $startTime2 = $request->input('start_time2');
		$therapistId1 = $request->input('therapist_id1');
		// $therapistId2 = $request->input('therapist_id2');
		$course = $request->input('course');
		$course_row = Course::findOrFail($request->input('course'));
		$course_time = $course_row->time;

		// 予約の重複チェック		dd(checkReservationOverlap()); $reservationDate2, $startTime2, $therapistId2
		$existingReservation = Reservation::checkReservationOverlap($reservationDate1, $startTime1, $course_time, $therapistId1,);
		if ($existingReservation) {
			$errors = new MessageBag(['error' => '選択した施術開始時間は他の予約の施術時間中なので予約できません。']);
			return redirect()->back()->withErrors($errors)->withInput($request->input());
		}

		// // セラピストの予約不可判定
		// $therapistUnavailable = Reservation::checkTherapistAvailability($reservationDate1, $reservationDate2, $course_time, $startTime1, $startTime2, $therapistId1, $therapistId2);

		// if ($therapistUnavailable) {
		// 	$errors = new MessageBag(['error' => '選択した施術時間はセラピストの予約可能時間外です。']);
		// 	return redirect()->back()->withErrors($errors)->withInput($request->input());
		// }

		// 予約データの作成// $course_time = $request->input('course_time');		
		$name = $request->input('name');
		$tel_number = $request->input('tel_number');
		$email = $request->input('email');
		$reservation_date1 = $request->input('reservation_date1');
		$reservation_date2 = $request->input('reservation_date2');
		$start_time1 = $request->input('start_time1');
		$start_time2 = $request->input('start_time2');
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
			'予約が完了しました、施術までお待ちください。予約について何かありましたらご連絡させていただきます。'
		);
	}
	/**
	 * ユーザー編集画面
	 */
	public function edit(string $id)
	{
			$Reservation = Reservation::findOrFail($id);
			$courses = Course::all(); // Coursesモデルから全てのコース情報を取得
			$users = User::all();
			return view('reservations.reserve_edit', compact('Reservation', 'courses','users'))->with(['id' => $id]);
	}

	public function update(Request $request)
	{ //個々の中身は明日核
		$id = $request->id;
		$options=['予約中','確定', '施術済み'];
		$validatedData = $request->validate([
			'status' =>'required', Rule::in($options),
			'reservation_date2' => 'max:100',
			'start_time2' => 'max:100',
			'Add_option1' => 'max:100',
			'Add_option2' => 'max:100',
			'Add_option3' => 'max:100',
			'request' => 'max:500'
		]);
		$Reservation = Reservation::findOrFail($id);
		$Reservations = Reservation::where('id', $id)->get();
		$Reservation->status = $validatedData['status'];
		$Reservation->reservation_date2 = $validatedData['reservation_date2'];
		$Reservation->start_time2 = $validatedData['start_time2'];
		$Reservation->Add_option1 = $validatedData['Add_option1'];
		$Reservation->Add_option2 = $validatedData['Add_option2'];
		$Reservation->Add_option3 = $validatedData['Add_option3'];
		$Reservation->request = $validatedData['request'];	
		$Reservation->save();

		return view('staffs.admin', ['Reservations' => $Reservations])->with('message', '予約情報を変更しました');
	}

	/**		dd($request->file('image_path'));
	 * ユーザー情報を削除
	 */
	public function destroy($id)
	{
		$reservation = Reservation::findOrFail($id);
		$reservation->delete();
		return redirect()->back()->with('message', 'Reservationを削除しました');
	}
}
