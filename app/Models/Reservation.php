<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Course;
use App\Models\User;
use Carbon\Carbon;

class Reservation extends Model
{
	use HasFactory;

	protected $fillable = [
		'name',
		'tel_number',
		'email',
		'reservation_date1',
		'reservation_date2',
		'start_time1',
		'start_time2',
		'course',
		'Add_option1',
		'Add_option2',
		'Add_option3',
		'course_time',
		'therapist_id1',
		'therapist_id2',
		'flexRadioDefault',
		'request',
		'status'
	];

	public function course()
	{
		return $this->belongsTo(Course::class);
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}
	public static function checkReservationOverlap($reservationDate1, $startTime1, $course_time, $therapist_id1,)
	{
		$existingReservation = Reservation::where(function ($query) use ($reservationDate1, $startTime1, $course_time, $therapist_id1) {
			$query->where('reservation_date1', $reservationDate1)
				->where('start_time1', '<=', Carbon::parse($startTime1)->addHour($course_time))//$startTime1以降の時間をひっかけるのがこっち
				->where('start_time1', '>=', Carbon::parse($startTime1)->subHour($course_time))//$startTime1より手前の時間をひっかけるのがこっち 
				->where('therapist_id1', $therapist_id1);
		// })->orWhere(function ($query) use ($reservationDate2, $course_time, $startTime2, $therapist_id2) {   $reservationDate2,$startTime2,$therapist_id2
		// 	$query->where('reservation_date2', $reservationDate2)
		// 		->where('start_time2', '<=', Carbon::parse($startTime2)->addHour($course_time))
		// 		->where('start_time2', '>=', Carbon::parse($startTime2)->subHour($course_time))
		// 		->where('therapist_id2', $therapist_id2);
		})->first();


		return $existingReservation;
	}

	// public static function checkTherapistAvailability($reservation_date1, $reservation_date2, $start_time1, $start_time2, $course_time, )
	// {
	// 	$startTime = Carbon::parse($reservation_date1 . ' ' . $start_time1 . ':00');
	// 	$endTime = $startTime->addHours($reservation_date2 . ' ' . $start_time2 . ':00');

	// 	$reservations = Reservation::where('reservation_date1', $reservation_date1)
	// 		->where('reservation_date2', $reservation_date2)

	// 		->where(function ($query) use ($startTime, $endTime) {
	// 			$query->where(function ($q) use ($startTime, $endTime) {
	// 				$q->where('start_time', '>=', $startTime)
	// 					->where('start_time', '<', $endTime);
	// 			})->orWhere(function ($q) use ($startTime, $endTime) {
	// 				$q->where('end_time', '>', $startTime)
	// 					->where('end_time', '<=', $endTime);
	// 			});
	// 		})
	// 		->get();

	// 	// 予約情報が存在する場合は重複と判定し、trueを返す
	// 	if ($reservations->count() > 0) {
	// 		return true;
	// 	}

	// 	// 予約情報が存在しない場合は重複していないと判定し、falseを返す
	// 	return false;
	// }

	// Reservationモデル
	public function mainCourse()
	{
		return $this->belongsTo(Course::class, 'course', 'id');
	}
	public function Add_option1()
	{
		return $this->belongsTo(Course::class, 'Add_option1', 'id');
	}

	public function Add_option2()
	{
		return $this->belongsTo(Course::class, 'Add_option2', 'id');
	}

	public function Add_option3()
	{
		return $this->belongsTo(Course::class, 'Add_option3', 'id');
	}

	public function Therapist_id1()
	{
		return $this->belongsTo(User::class, 'therapist_id1', 'id');
	}
	public function Therapist_id2()
	{
		return $this->belongsTo(User::class, 'therapist_id2', 'id');
	}
}


// 上記のように、checkReservationOverlapメソッドをReservationモデルに追加することで、予約時間の重複チェックを行うことができます。

// コントローラーの方で、予約処理を行う前にこのメソッドを呼び出し、重複があるかどうかを判定してください。

// 例えば、コントローラー内での使用例は以下のようになります。
