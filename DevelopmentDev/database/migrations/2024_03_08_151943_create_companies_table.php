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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('nit')->unique();
            $table->string('nameCompany');
            $table->string('descriptionCompany');
            $table->string('industryCompany')->nullable();
            $table->string('LocationCompany');
            $table->string('numberCompany');
            $table->string('photo_logo')->nullable();
            $table->enum('status', ['pending', 'authorized', 'rejected'])->default('pending');
            $table->string('numberIdentification')->nullable();
            $table->bigInteger('authorized_by')->unsigned()->nullable();
            $table->timestamps();

            $table->foreign('authorized_by')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('companies');
    }
};
