<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVendorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendors', function (Blueprint $table) {
            $table->increments('id');
            $table->string('vendor_code_number',50);
            $table->string('name',30);
            $table->string('email',30);
            $table->string('contact_number_primary',15);
            $table->string('contact_number_optional',15)->nullable();
            $table->string('address');
            $table->integer('country_id');
            $table->integer('city_id');
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
        Schema::dropIfExists('vendors');
    }
}
