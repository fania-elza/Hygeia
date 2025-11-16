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
        // Pastikan semua data lama sesuai enum
        DB::table('orders')
            ->whereNotIn('status', ['diproses','dikirim','selesai','cancel'])
            ->update(['status' => 'diproses']);

        Schema::table('orders', function (Blueprint $table) {
            $table->enum('status', ['diproses','dikirim','selesai','cancel'])
                  ->default('diproses')
                  ->change();
        });
    }

    public function down(): void
    {
        // Jika rollback, kembalikan ke string
        Schema::table('orders', function (Blueprint $table) {
            $table->string('status')->default('diproses')->change();
        });
    }
};
