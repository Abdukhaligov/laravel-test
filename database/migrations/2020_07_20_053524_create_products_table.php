<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration {
  public function up() {
    Schema::create('products', function (Blueprint $table) {
      $table->id('id');
      $table->string('name');
      $table->string('category');
      $table->integer('price');
      $table->bigInteger('user_id')->unsigned();
      $table->foreign('user_id')->references('id')->on('users')->onDelete('CASCADE');
      $table->timestamps();
    });
  }

  public function down() {
    Schema::dropIfExists('products');
  }
}
