<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PenyesuaianStok extends Model
{
    protected $table = 'penyesuaian_stoks';
    protected $primaryKey = 'ID_Penyesuaian';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'ID_Barang',
        'Jumlah_Penyesuaian',
        'Alasan',
        'Tanggal_Penyesuaian',
    ];

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'ID_Barang', 'ID_Barang');
    }
}
