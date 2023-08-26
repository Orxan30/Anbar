<?php

namespace App\Exports;

use App\Models\tvcatmis;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExportTvcatmis implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return tvcatmis::all();
    }
}
