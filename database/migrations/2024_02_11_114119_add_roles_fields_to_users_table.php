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
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('role_id')->constrained();
            $table->string( 'client-type' )->nullable();
            $table->string('dealer-type')->nullable();
            $table->string('employee-type')->nullable();
            // $table->string('business_identity')->nullable();
            // $table->string('business_coop_account_number' )->nullable();
            // $table->string('business_phone_number' )->nullable();
            // $table->string('dealer_identity' )->nullable();
            // $table->string('dealer_address' )->nullable();
            // $table->string('dealer_phone_number' )->nullable();
            // $table->string('agent_identity' )->nullable();
            // $table->string('agent_phone_number' )->nullable();
            // $table->string('agent_location' )->nullable();
            // $table->string('employee_job_id')->nullable();
            // $table->string('employee_title')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
