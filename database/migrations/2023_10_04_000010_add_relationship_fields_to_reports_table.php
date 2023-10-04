<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToReportsTable extends Migration
{
    public function up()
    {
        Schema::table('reports', function (Blueprint $table) {
            $table->unsignedBigInteger('seat_id')->nullable();
            $table->foreign('seat_id', 'seat_fk_9072784')->references('id')->on('users');
            $table->unsignedBigInteger('dept_id')->nullable();
            $table->foreign('dept_id', 'dept_fk_9072788')->references('id')->on('departments');
            $table->unsignedBigInteger('district_id')->nullable();
            $table->foreign('district_id', 'district_fk_9072792')->references('id')->on('districts');
        });
    }
}
