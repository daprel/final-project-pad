<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $table = 'barangs';
    protected $primaryKey = 'ID_Barang';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'Nama_Barang',
        'Kategori',
        'Nomor_Batch',
        'Jumlah',
        'Lokasi'
    ];

    public function transaksi()
    {
        return $this->hasMany(TransaksiMasukKeluar::class, 'ID_Barang', 'ID_Barang');
    }

    public function penyesuaian()
    {
        return $this->hasMany(PenyesuaianStok::class, 'ID_Barang', 'ID_Barang');
    }
}
