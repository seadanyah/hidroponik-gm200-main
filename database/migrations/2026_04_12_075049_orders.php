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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100)->nullable();
            $table->string('phone', 20)->nullable();
            $table->string('email', 100);
            $table->text('address');
            $table->text('note');
            $table->dateTime('order_date');
            $table->integer('total_price');
            $table->enum('status', ['pending', 'dibayar', 'dikirim', 'selesai', 'dibatalkan', 'paid', 'shipped', 'completed', 'cancelled']);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
