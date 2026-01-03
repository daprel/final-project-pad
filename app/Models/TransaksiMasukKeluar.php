<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransaksiMasukKeluar extends Model
{
    protected $table = 'transaksi_masuk_keluars';
    protected $primaryKey = 'ID_Transaksi';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'Departemen',
        'ID_Barang',
        'Nomor_Batch',
        'Jumlah',
        'Tanggal',
        'Tipe_Transaksi',
    ];

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'ID_Barang', 'ID_Barang');
    }
}
