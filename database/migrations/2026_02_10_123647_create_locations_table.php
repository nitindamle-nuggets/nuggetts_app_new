<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('locations', function (Blueprint $table) {
    $table->id();
    $table->string('location_id')->nullable();
    $table->string('location_name');
    $table->string('location_code')->unique();
    $table->string('location_type');
    $table->string('parent_location')->nullable();
    $table->string('status');

    $table->string('address1');
    $table->string('address2')->nullable();
    $table->string('locality')->nullable();
    $table->string('city')->nullable();
    $table->string('district')->nullable();
    $table->string('state')->nullable();
    $table->string('country')->nullable();
    $table->string('pincode')->nullable();

    $table->string('latitude')->nullable();
    $table->string('longitude')->nullable();
    $table->integer('total_area')->nullable();
    $table->integer('builtup_area')->nullable();
    $table->integer('elevation')->nullable();
    $table->string('timezone')->nullable();

    $table->string('manager_name')->nullable();
    $table->string('manager_emp_id')->nullable();
    $table->string('primary_contact')->nullable();
    $table->string('alternate_contact')->nullable();
    $table->string('email')->nullable();
    $table->string('fax')->nullable();

    $table->text('remarks')->nullable();
    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('locations');
    }
};
