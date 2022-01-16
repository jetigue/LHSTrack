<?php

namespace App\Exports;

use App\Models\Athletes\Athlete;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AthletesExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Athlete::pluck('fullName');
    }

    public function headings(): array
    {
        return [
            'Name'
        ];
    }
}
