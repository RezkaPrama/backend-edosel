<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shelf extends Model
{
    use HasFactory;

    /**
     * guarded
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * input Dokumen
     *
     * @return void
     */
    public function inputDokumen()
    {
        return $this->hasMany(InputDokumen::class);
    }
}
