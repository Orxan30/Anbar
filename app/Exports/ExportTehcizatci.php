<?php

namespace App\Exports;

use App\Models\tehcizatci;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExportTehcizatci implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return tehcizatci::all();
    }
}
