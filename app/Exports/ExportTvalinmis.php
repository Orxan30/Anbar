<?php

namespace App\Exports;

use App\Models\tvalinmis;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExportTvalinmis implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return tvalinmis::all();
    }
}
