<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InputDokumenDetail extends Model
{
    use HasFactory;
     /**
     * guarded
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * detail
     *
     * @return void
     */
    public function inputDokumen()
    {
        return $this->belongsTo(InputDokumen::class);
    }
}
