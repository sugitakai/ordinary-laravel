<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('tel_number')->unique()->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->integer('height')->nullable();
            $table->integer('body_weight')->nullable();
            $table->integer('age')->nullable();
            $table->string('sports_history')->nullable();
            $table->unsignedBigInteger('possible_option_1')->nullable();
            $table->unsignedBigInteger('possible_option_2')->nullable();
            $table->unsignedBigInteger('possible_option_3')->nullable();
            $table->string('Remarks_column1', 100)->nullable();
            $table->string('Remarks_column2', 100)->nullable();
            $table->string('profile', 500)->nullable();
            $table->string('image_path')->nullable()->default(null);
            $table->timestamps();
            $table->boolean('is_deleted')->default(false)->nullable(false);
            $table->boolean('owner')->default(false)->nullable(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
