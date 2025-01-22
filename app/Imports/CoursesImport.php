<?php

namespace App\Imports;

use App\Models\Course;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CoursesImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // Validasi kolom 'price' untuk memastikan hanya angka
        if (!is_numeric($row['price'])) {
            throw new \Exception("Invalid value for 'Price': " . $row['price']);
        }

        return new Course([
            'name' => $row['name'],
            'description' => $row['description'],
            'price' => (float) $row['price'], 
            'status' => $row['status'],
        ]);
    }
}
