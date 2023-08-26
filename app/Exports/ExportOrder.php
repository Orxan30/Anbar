<?php

namespace App\Exports;

use App\Models\orders;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExportOrder implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return orders::all();
    }
}
