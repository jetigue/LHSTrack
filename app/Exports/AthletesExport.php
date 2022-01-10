<?php

namespace App\Exports;

use App\Models\Athletes\Athlete;
use Maatwebsite\Excel\Concerns\FromCollection;

class AthletesExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Athlete::all();
    }
}
