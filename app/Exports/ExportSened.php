<?php

namespace App\Exports;

use App\Models\sened;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExportSened implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return sened::all();
    }
}
