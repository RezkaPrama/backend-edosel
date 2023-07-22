<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InputDokumen extends Model
{
    use HasFactory;

     /**
     * guarded
     *
     * @var array
     */
    protected $guarded = [];
    // protected $fillable = [
    //     'nik',
    //     'no_dosir',
    //     'nama',
    //     'tanggal_input',
    //     'pangkat',
    //     'satuan',
    //     'personel',
    //     'shelf_id',
    // ];

    /**
     * shelves
     *
     * @return void
     */
    public function Shelf()
    {
        return $this->belongsTo(Shelf::class);
    }

    /**
     * detail
     *
     * @return void
     */
    public function inputDokumenDetail()
    {
        return $this->hasMany(InputDokumenDetail::class);
    }
}
