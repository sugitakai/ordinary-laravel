<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Course;
use App\Models\User;

class Reservation extends Model
{
	use HasFactory;

	public function course()
	{
		return $this->belongsTo(Course::class);
	}

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
		'therapist_id1',
		'therapist_id2',
		'flexRadioDefault',
	];

	public function user()
	{
		return $this->belongsTo(User::class);
	}
// Reservationモデル

public static function checkReservationOverlap($reservationDate1, $reservationDate2, $startTime1, $startTime2)
{
    $existingReservation = Reservation::where(function ($query) use ($reservationDate1, $startTime1) {
        $query->where('reservation_date1', $reservationDate1)
            ->where('start_time1', '<', $startTime1)
            ->orWhere(function ($query) use ($reservationDate1, $startTime1) {
                $query->where('reservation_date1', $reservationDate1)
                    ->where('start_time2', '>', $startTime1);
            });
    })->orWhere(function ($query) use ($reservationDate2, $startTime2) {
        $query->where('reservation_date2', $reservationDate2)
            ->where('start_time1', '<', $startTime2)
            ->orWhere(function ($query) use ($reservationDate2, $startTime2) {
                $query->where('reservation_date2', $reservationDate2)
                    ->where('start_time2', '>', $startTime2);
            });
    })->first();

    return $existingReservation;
}
}


// 上記のように、checkReservationOverlapメソッドをReservationモデルに追加することで、予約時間の重複チェックを行うことができます。

// コントローラーの方で、予約処理を行う前にこのメソッドを呼び出し、重複があるかどうかを判定してください。

// 例えば、コントローラー内での使用例は以下のようになります。

