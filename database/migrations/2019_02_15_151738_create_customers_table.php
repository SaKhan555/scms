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
            $table->increments('id');
            $table->integer('user_id');
            $table->string('customer_code_number');
            $table->string('name',30);
            $table->string('email',30);
            $table->string('contact_number_primary',15);
            $table->string('contact_number_optional',15)->nullable();
            $table->integer('country_id');
            $table->integer('city_id');
            $table->string('address',200);
            $table->string('image_url',100)->nullable();
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
