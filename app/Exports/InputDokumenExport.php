<?php

namespace App\Exports;

use App\Models\InputDokumen;
use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;

class InputDokumenExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return User::all();
    }
}
