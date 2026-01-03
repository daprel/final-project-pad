<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('transaksi_masuk_keluars', function (Blueprint $table) {
            $table->increments('ID_Transaksi'); // INT PK
            $table->string('Departemen');
            $table->unsignedInteger('ID_Barang'); // FK
            $table->string('Nomor_Batch');
            $table->integer('Jumlah');
            $table->dateTime('Tanggal');
            $table->enum('Tipe_Transaksi', ['Masuk', 'Keluar']);

            $table->timestamps();

            $table->foreign('ID_Barang')
                ->references('ID_Barang')
                ->on('barangs')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();

            // Opsional indexing untuk query cepat:
            $table->index(['ID_Barang', 'Tanggal']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transaksi_masuk_keluars');
    }
};
