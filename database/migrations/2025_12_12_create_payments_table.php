<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('servis_id')->constrained()->onDelete('cascade');
            $table->decimal('amount', 12, 2);
            $table->enum('method', ['tunai', 'transfer', 'kartu'])->default('tunai');
            $table->enum('status', ['pending', 'confirmed', 'completed'])->default('pending');
            $table->timestamp('payment_date')->nullable();
            $table->timestamps();
        });

        Schema::table('servis', function (Blueprint $table) {
            $table->boolean('paid')->default(false)->after('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
        Schema::table('servis', function (Blueprint $table) {
            $table->dropColumn('paid');
        });
    }
};
