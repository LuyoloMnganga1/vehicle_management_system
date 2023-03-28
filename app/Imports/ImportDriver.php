<?php

namespace App\Imports;

use App\Models\Driver;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ImportDriver implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Driver([
            "name" => $row['name'],
            "surname" => $row['surname'],
            "department" => $row['department'],
            "email" => $row['email'],
            "phone" => $row['phone'],
            "user_type" => $row['user_type'],
            "licence_no" => $row['license_no'],
            "licence_class" => $row['license_class'],
            "license_state" => $row['license_state'],
            "license_image" => $row['license_image'],
        ]);
    }
}
