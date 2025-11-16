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
        Schema::table('orders', function (Blueprint $table) {
            // Informasi pengiriman
            $table->string('receiver_name')->nullable()->after('user_id');
            $table->string('phone_number')->nullable()->after('receiver_name');
            $table->text('full_address')->nullable()->after('phone_number');
            $table->string('city')->nullable()->after('full_address');
            $table->string('postal_code')->nullable()->after('city');
            $table->text('notes')->nullable()->after('postal_code');

            // Rincian harga
            $table->decimal('subtotal', 12, 2)->default(0)->after('notes');
            $table->decimal('shipping_cost', 12, 2)->default(0)->after('subtotal');
            $table->decimal('discount', 12, 2)->default(0)->after('shipping_cost');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn([
                'receiver_name',
                'phone_number',
                'full_address',
                'city',
                'postal_code',
                'notes',
                'subtotal',
                'shipping_cost',
                'discount',
            ]);
        });
    }
};
