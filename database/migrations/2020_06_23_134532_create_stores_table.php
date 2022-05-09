<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('stores', function (Blueprint $table) {
          $table->id();
          $table->string('name');
          $table->bigInteger('company_id')->unsigned()->index();
          $table->foreign('company_id')->references('id')->on('companies')
            ->onDelete('CASCADE');
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
        Schema::dropIfExists('stores');
    }
}
