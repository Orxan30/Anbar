<?php

namespace App\Exports;

use App\Models\tesdiqlenmis;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExportTesdiqlenmis implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return tesdiqlenmis::all();
    }
}
