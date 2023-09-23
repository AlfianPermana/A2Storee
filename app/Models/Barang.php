<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Barang extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'gambar',
        'stok',
        'harga_jual',
        'harga_beli',
    ];


    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'harga_beli' => 'decimal:2',
        'harga_jual' => 'decimal:2',
    ];

    /**
     * Override the default gambar getter.
     * 
     * @return string
     */
    public function getGambarAttribute($value): string
    {
        if (!$value)
            return 'https://via.placeholder.com/150';

        if ($value && Storage::exists('public/barang/' . $value))
            return Storage::url('public/barang/' . $value);
        return $value;
    }
}
