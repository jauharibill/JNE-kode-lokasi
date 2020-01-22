<?php

namespace App\Imports;

use App\Models\Province;
use App\Models\City;
use App\Models\SubDistrict;
use App\Models\Village;
use Maatwebsite\Excel\Concerns\ToModel;

class LocationImport implements ToModel
{
    public function __construct()
    {
        ini_set('memory_limit', '-1');
    }

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        if ($province = $this->isProvinceExists($row[2])) {

            $city = City::create([
                'name' => $row[5],
                'administrative' => $row[4],
                'jne_province_id' => $province->id
            ]);

        } else {

            $province = Province::create([
                'name' => $row[3],
                'code' => $row[2]
            ]);

            $city = City::create([
                'name' => $row[5],
                'administrative' => $row[4],
                'jne_province_id' => $province->id
            ]);

        }

        return true;
    }


    public function isProvinceExists($province_code)
    {
        return Province::where('code', $province_code)->first();
    }
}
