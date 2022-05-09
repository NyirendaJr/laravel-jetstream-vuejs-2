<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStoreIdColumnIntoInvestmentsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::table('investments', function (Blueprint $table) {
      $table->bigInteger('store_id')->unsigned();
      $table->foreign('store_id')->references('id')
        ->on('stores')->onDelete('cascade');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::table('investments', function (Blueprint $table) {
      //
    });
  }
}
