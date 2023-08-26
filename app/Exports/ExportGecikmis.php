<?php

namespace App\Exports;

use App\Models\gecikmis;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExportGecikmis implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return gecikmis::all();
    }
}
