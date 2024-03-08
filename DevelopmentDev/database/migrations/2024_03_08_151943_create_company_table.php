<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('company', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('nit')->unique();
            $table->string('nameCompany');
            $table->string('descriptionCompany');
            $table->string('industryCompany')->nullable();
            $table->string('LocationCompany');
            $table->string('numberCompany')->nullable();
            $table->string('photo_logo')->nullable();
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
};
