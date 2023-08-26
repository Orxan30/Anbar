<?php

namespace App\Exports;

use App\Models\aktiv;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExportAktiv implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return aktiv::all();
    }
}
