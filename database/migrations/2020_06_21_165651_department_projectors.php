<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DepartmentProjectors extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('department_projectors', function (Blueprint $table) {
            $table->id();
            $table->unique(['department_id','projector_id']);
            $table->integer('department_id')->references('id')->on('departments')->onDelete('cascade');
            $table->integer('projector_id')->references('id')->on('projectors')->onDelete('cascade');

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
        //
    }
}
