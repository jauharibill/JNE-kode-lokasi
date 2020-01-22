<?php

namespace App\Imports;

use App\Enums\ColumnJNEEnums;
use App\Models\City;
use App\Models\Province;
use App\Models\SubDistrict;
use Maatwebsite\Excel\Concerns\ToModel;

class SubDistrictImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $city = $this->getCityId($row[ColumnJNEEnums::KOTA], $row[ColumnJNEEnums::PROVINSI]);

        if (!$this->isDistrictExists($row[ColumnJNEEnums::KECAMATAN], $city->id ?? 0) && $city) {
            return new SubDistrict([
                'koding' => $row[ColumnJNEEnums::KODING],
                'syscode' => $row[ColumnJNEEnums::SYSCODE],
                'name' => $row[ColumnJNEEnums::KECAMATAN],
                'jne_city_id' => $city->id
            ]);
        }

        return null;
    }

    /**
     * @param $city_name
     * @param $province_code
     * @return mixed
     */
    private function getCityId($city_name, $province_name)
    {
        $province = Province::where('name', $province_name)->first();

        return City::where('administrative', '!=', '-')
            ->where([
                'name' => $city_name,
                'jne_province_id' => $province->id
            ])->first();
    }

    /**
     * @param $name
     * @param $city_id
     * @return mixed
     */
    private function isDistrictExists($name, $city_id)
    {
        return SubDistrict::where([
            'name' => $name,
            'jne_city_id' => $city_id
        ])->first();
    }

}
