<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameUnitToUnitIdInProductPurchaseTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::table('product_purchase', function (Blueprint $table) {
      $table->renameColumn('unit', 'unit_id');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::table('product_purchase', function (Blueprint $table) {
      // $table->renameColumn('unit_id', 'unit');
    });
  }
}
