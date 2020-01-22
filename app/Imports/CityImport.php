<?php

namespace App\Imports;

use App\Enums\ColumnJNEEnums;
use App\Models\City;
use App\Models\Province;
use Maatwebsite\Excel\Concerns\ToModel;

class CityImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        if (!$this->isCityExists($row[ColumnJNEEnums::KOTA], $row[ColumnJNEEnums::ADMINISTRATIVE])) {
            return City::create([
                'name' => $row[ColumnJNEEnums::KOTA],
                'administrative' => $row[ColumnJNEEnums::ADMINISTRATIVE] ?? "-",
                'jne_province_id' => $this->getProvinceId($row[ColumnJNEEnums::PROVINSI])->id
            ]);
        }
    }

    /**
     * @param $province_code
     * @return mixed
     */
    private function getProvinceId($province_name)
    {
        return Province::where('name', $province_name)->first();
    }

    /**
     * @param $city_name
     * @return mixed
     */
    private function isCityExists($city_name, $administrative)
    {
        return City::where([
            'name' => $city_name,
            'administrative' => $administrative
        ])->first();
    }
}
