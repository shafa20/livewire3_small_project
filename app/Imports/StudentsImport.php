<?php

namespace App\Imports;

use App\Models\Students;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Illuminate\Contracts\Queue\ShouldQueue;

class StudentsImport implements ToModel, WithHeadingRow, WithChunkReading, ShouldQueue
{
    public function model(array $row)
    {
        Log::info('Importing row: ' . json_encode($row));
        // Map the columns from the Excel file to the Student model
        return new Students([
            'name' => $row['name'],
            'roll' => $row['roll'],
            'registration' => $row['registration'],
        ]);
    }

    public function chunkSize(): int
    {
        return 200;
    }
}

