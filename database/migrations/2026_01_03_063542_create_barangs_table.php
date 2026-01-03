<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('barangs', function (Blueprint $table) {
            $table->increments('ID_Barang'); // INT PK
            $table->string('Nama_Barang');
            $table->string('Kategori');
            $table->string('Nomor_Batch');
            $table->integer('Jumlah');
            $table->string('Lokasi');

            $table->timestamps();

            // Jika Nomor_Batch ingin unik per barang:
            // $table->unique(['Nama_Barang', 'Nomor_Batch']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('barangs');
    }
};
