<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('status', ['予約中', '確定', '施術済み'])->default('予約中'); //予約がどんな状態か判定するカラム 確定で日時セラピストが決まる
            $table->string('tel_number');
            $table->string('email');
            $table->enum('location', ['個室', '出張']);
            //日付 第一希望優先
            $table->date('reservation_date1');
            $table->date('reservation_date2');
            $table->index(['reservation_date1', 'reservation_date2']);
            //時間 第一希望優先
            $table->time('start_time1');
            $table->time('start_time2');
            $table->index(['start_time1', 'start_time2']);
            // コースとオプション
            $table->unsignedInteger('course');
            $table->foreign('course')->references('id')->on('courses');
            $table->unsignedInteger('Add_option1')->nullable();
            $table->foreign('Add_option1')->references('id')->on('courses');
            $table->unsignedInteger('Add_option2')->nullable();
            $table->foreign('Add_option2')->references('id')->on('courses');
            $table->unsignedInteger('Add_option3')->nullable();
            $table->foreign('Add_option3')->references('id')->on('courses');
            // 施術所要時間
            $table->integer('course_time')->nullable();
            //セラピスト 第一希望優先
            $table->unsignedBigInteger('therapist_id1');
            $table->foreign('therapist_id1')->references('id')->on('users');
            $table->unsignedBigInteger('therapist_id2');
            $table->foreign('therapist_id2')->references('id')->on('users');
            $table->index(['therapist_id1', 'therapist_id2']);
            $table->string('request', 500)->nullable();
            $table->timestamps();
        });

        $reservations = DB::table('reservations')->get();
        foreach ($reservations as $reservation) {
            $course = DB::table('courses')->where('id', $reservation->course)->first();
            if ($course) {
                DB::table('reservations')->where('id', $reservation->id)->update([
                    'course_time' => $course->time,
                    ]);
                }
            }        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};