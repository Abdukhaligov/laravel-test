<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyPositionTable extends Migration {
  public function up() {
    Schema::create('company_position', function (Blueprint $table) {
      $table->bigInteger('company_id')->unsigned();
      $table->foreign('company_id')->references('id')->on('companies')->onDelete('CASCADE');
      $table->bigInteger('position_id')->unsigned();
      $table->foreign('position_id')->references('id')->on('positions')->onDelete('CASCADE');
    });
  }

  public function down() {
    Schema::dropIfExists('company_position');
  }
}
