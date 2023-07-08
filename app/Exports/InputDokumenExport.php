<?php

namespace App\Exports;

use App\Models\InputDokumen;
use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class InputDokumenExport implements FromCollection, WithHeadings
{

    protected $results;

    public function __construct($results)
    {
        $this->results = $results;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function headings(): array
    {
        return [
            'Id',
            'Nama',
            'Pangkat',
            'NRP',
            'No Rak',
            'Tanggal Input',
            'Satuan',
            'Jenis Karyawan',
            'created_at',
            'updated_at'
        ];
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        // return User::all();
        return $this->results;
    }
}
