<?php

namespace App\Exports;

use App\Models\gozlemede;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExportGozlemede implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return gozlemede::all();
    }
}
