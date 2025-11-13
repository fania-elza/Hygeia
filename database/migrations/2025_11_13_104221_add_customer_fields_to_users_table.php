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
            $table->string('username')->unique()->after('id');
            $table->date('dob')->nullable()->after('email');
            $table->enum('gender', ['male', 'female'])->nullable()->after('dob');
            $table->string('address')->nullable()->after('gender');
            $table->string('city')->nullable()->after('address');
            $table->string('contact_number')->nullable()->after('city');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['username', 'dob', 'gender', 'address', 'city', 'contact_number']);
        });
    }

};
