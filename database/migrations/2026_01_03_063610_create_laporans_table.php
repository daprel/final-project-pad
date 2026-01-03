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
        Schema::create('laporans', function (Blueprint $table) {
            $table->increments('ID_Laporan');               // PK laporan
            $table->dateTime('Tanggal_Laporan');            // tanggal laporan
            $table->integer('Total_Masuk')->default(0);     // total barang masuk
            $table->integer('Total_Keluar')->default(0);    // total barang keluar
            $table->integer('Total_Penyesuaian')->default(0); // total penyesuaian stok

            // Jenis laporan (pakai string agar aman di SQLite)
            $table->string('Jenis_Laporan');                // Harian | Mingguan | Bulanan | Tahunan

            // FK ke users.id (Laravel default)
            $table->unsignedBigInteger('Generated_By')->nullable();

            $table->timestamps();

            // Foreign key constraint
            $table->foreign('Generated_By')
                ->references('id')
                ->on('users')
                ->nullOnDelete()
                ->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporans');
    }
};
