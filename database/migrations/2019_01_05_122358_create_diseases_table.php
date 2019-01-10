<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDiseasesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diseases', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code', 5);
            $table->string('name');
            $table->text('description');
            $table->text('diagnose');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('diseases');
    }
}
