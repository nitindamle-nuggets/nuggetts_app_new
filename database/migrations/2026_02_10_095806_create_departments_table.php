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
        Schema::create('departments', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code')->unique();
            $table->string('category');
            $table->string('parent_department')->nullable();
            $table->string('status');
            $table->date('established_date')->nullable();

            $table->string('department_head');
            $table->string('employee_id')->nullable();
            $table->string('email');
            $table->string('contact_number');
            $table->string('extension_number')->nullable();
            $table->string('reporting_to')->nullable();

            $table->string('location');
            $table->string('office_floor')->nullable();
            $table->integer('total_employees')->nullable();
            $table->string('working_hours')->nullable();
            $table->string('working_days')->nullable();
            $table->string('department_type')->nullable();

            $table->string('functions')->nullable(); // comma separated
            $table->string('compliance')->nullable();
            $table->string('certifications')->nullable();
            $table->string('security_level')->nullable();

            $table->text('description')->nullable();
            $table->text('kpis')->nullable();
            $table->text('remarks')->nullable();

            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('departments');
    }
};
