<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('customer_id');
            $table->string('customer_type')->default('normal');
            $table->string('title');
            $table->string('english_name');
            $table->string('local_name');
            $table->string('gender');
            $table->date('birth_date');
            $table->string('prefered_language');
            $table->string('nationality');
            $table->string('national_id');
            $table->string('age');
            $table->string('country');
            $table->string('city');
            $table->string('address');
            $table->string('dial_code');
            $table->string('mobile_number');
            $table->string('email');
            $table->string('receive_notifications');
            $table->string('office_number');
            $table->float('total_spent')->default(0);
            $table->integer('total_points')->default(0);
            $table->text('notes');
            $table->boolean('moftah_club')->default(0);
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
        Schema::dropIfExists('customers');
    }
}
