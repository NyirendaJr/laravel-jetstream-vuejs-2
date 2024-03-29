<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvestmentsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('investments', function (Blueprint $table) {
      $table->id();
      $table->string('name');
      $table->decimal('amount');
      $table->bigInteger('account_id')->unsigned();
      $table->foreign('account_id')->references('id')
        ->on('accounts')->onDelete('cascade');
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('investments');
  }
}
