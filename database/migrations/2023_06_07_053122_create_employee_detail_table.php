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
        Schema::dropIfExists('employee_detail');
        Schema::create('employee_detail', function (Blueprint $table) {
            
            $table->id();
            $table->string("empname");
            $table->string("empemail");
            $table->string("emprole");
            $table->string("usertype")->default('employee');
            $table->string("password");
            $table->string("cpassword");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_detail');
    }
};
