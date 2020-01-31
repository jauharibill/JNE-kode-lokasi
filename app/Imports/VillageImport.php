<?php

namespace App\Imports;

use App\Enums\ColumnJNEEnums;
use App\Models\City;
use App\Models\Province;
use App\Models\SubDistrict;
use App\Models\Village;
use Maatwebsite\Excel\Concerns\ToModel;

class VillageImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        /**
         * get province
         */
        $province = Province::where('name', $row[ColumnJNEEnums::PROVINSI])->first();

        /**
         * get city
        */
        $city = City::where('administrative', '!=', '-')
            ->where([
                'name' => $row[ColumnJNEEnums::KOTA],
                'jne_province_id' => $province->id,
                'administrative' => $row[ColumnJNEEnums::ADMINISTRATIVE]
            ])->first();

        if ($city) {
            /**
             * get subdistrict
             */
            $district = SubDistrict::where([
                'name' => $row[ColumnJNEEnums::KECAMATAN],
                'jne_city_id' => $city->id
            ])->first();

            if ($district) {
                return Village::create([
                    'name' => $row[ColumnJNEEnums::KELURAHAN],
                    'zip' => $row[ColumnJNEEnums::KODE_POS],
                    'jne_subdistrict_id' => $district->id
                ]);
            } else {
                /** log error if any */
                echo $row[ColumnJNEEnums::KECAMATAN] . ":" . $city->id;
                exit();
            }

        }

        return null;

    }
}
