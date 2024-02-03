<?php

namespace App\Exports;

use App\Models\Students;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class StudentsExport implements  FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Students::select('name', 'roll', 'registration')->get();
    }
    public function headings(): array
    {
        // Specify the column headings
        return [
            'Name',
            'Roll',
            'Registration',
        ];
    }
}
