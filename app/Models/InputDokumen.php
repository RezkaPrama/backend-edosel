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
