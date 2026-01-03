<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('penyesuaian_stoks', function (Blueprint $table) {
            $table->increments('ID_Penyesuaian'); // INT PK
            $table->unsignedInteger('ID_Barang'); // FK
            $table->integer('Jumlah_Penyesuaian');
            $table->string('Alasan');
            $table->dateTime('Tanggal_Penyesuaian');

            $table->timestamps();

            $table->foreign('ID_Barang')
                ->references('ID_Barang')
                ->on('barangs')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();

            $table->index(['ID_Barang', 'Tanggal_Penyesuaian']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('penyesuaian_stoks');
    }
};
