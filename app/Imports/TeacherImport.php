<?php

namespace App\Imports;

use App\Models\Teacher;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;

HeadingRowFormatter::default('none');

class TeacherImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new Teacher([
            'username' => $row['Username'],
            'password' => $row['Password'],
            'first_name' => $row['First_name'],
            'last_name' => $row['Last_name'],
            'roll' => $row['Roll'],
        ]);
    }
}
