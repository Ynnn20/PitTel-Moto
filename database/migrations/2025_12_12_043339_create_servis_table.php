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
        Schema::create('servis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pelanggan_id')->nullable()->index();
            $table->foreignId('motor_id')->nullable()->index();
            $table->foreignId('mekanik_id')->nullable()->index();
            $table->string('keluhan');
            $table->string('tindakan')->nullable();
            $table->decimal('biaya', 12, 2)->default(0);
            $table->string('status')->default('pending');
            $table->date('tanggal_servis')->nullable();
            $table->dateTime('selesai_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('servis');
    }
};
