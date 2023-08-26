<?php

namespace App\Exports;

use App\Models\vezifeexport;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExportVezife implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return vezifeexport::all();
    }
}
