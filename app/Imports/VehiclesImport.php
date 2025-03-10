<?php

namespace App\Imports;

use App\Models\Vehicle;
use App\Models\VehicleUpdateRecord;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class VehiclesImport implements ToModel, WithHeadingRow
{
    /**
     * Method to handle each row of the Excel file
     */
    public function model(array $row)
    {
        $vehicle = Vehicle::where('unique_item_no', $row['ba_no'])->first();
        if ($vehicle) {

            $vehicle->update([
                'starting_value' => $row['latestreading_inkm'],
                'starting_value_hour' => $row['latest_reading_inhours'],
            ]);

            // Store the update in vehicle_update_records table
            VehicleUpdateRecord::create([
                'excel_ba_no' => $row['ba_no'],
                'excel_km' => $row['latestreading_inkm'],
                'excel_hours' => $row['latest_reading_inhours'],
            ]);
        }

        return null; // No need to return a model here
    }
}
