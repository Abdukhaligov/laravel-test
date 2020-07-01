<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration {
  public function up() {
    Schema::create('users', function (Blueprint $table) {
      $table->id();
      $table->string('name');
      $table->string('email')->unique();
      $table->timestamp('email_verified_at')->nullable();
      $table->string('password');
      $table->rememberToken();
      $table->timestamps();

      $table->bigInteger('company_id')->unsigned()->nullable();
      $table->foreign('company_id')->references('id')->on('companies')->onDelete('SET NULL');
      $table->bigInteger('position_id')->unsigned()->nullable();
      $table->foreign('position_id')->references('id')->on('positions')->onDelete('SET NULL');
    });
  }

  public function down() {
    Schema::dropIfExists('users');
  }
}
