<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    protected $table = 'laporans';
    protected $primaryKey = 'ID_Laporan';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'Tanggal_Laporan',
        'Total_Masuk',
        'Total_Keluar',
        'Total_Penyesuaian',
        'Jenis_Laporan',
        'Generated_By'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'Generated_By', 'ID_User');
    }
}
