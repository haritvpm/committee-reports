<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportsTable extends Migration
{
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('file_number');
            $table->string('file_year');
            $table->string('from');
            $table->string('from_eng')->nullable();
            $table->date('received_date')->nullable();
            $table->date('submitted_date')->nullable();
            $table->string('subject')->nullable();
            $table->string('subject_eng')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
