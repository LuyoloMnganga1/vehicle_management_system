<?php

namespace App\Imports;

use App\Models\Booking;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Vehicle;

class BookingImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $Vehicle = Vehicle::orderby('id', 'ASC')->first();
        return new Booking([
            'full_name' => Auth::user()->name ." ". Auth::user()->surname,
            'email' => Auth::user()->email,
            'trip_start_date' =>$this->transformDate($row[0]),
            'return_date' => $this->transformDate($row[0]),
            'destination' => $row[1] ? $row[1] : 'N/A',
            'vehicle_id' =>$Vehicle->id,
            'trip_datails' => $row[2] ? $row[2] : 'N/A',
            'status' => 'Approved',
            'comment' => 'Auto approved because of upload by Excel spreadsheet',
        ]);
    }

    public function transformDate($value, $format = 'Y-m-d')
    {
        try {
            return Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($value));
        } catch (\ErrorException $e) {
            return Carbon::createFromFormat($format, $value);
        }
    }
}
  