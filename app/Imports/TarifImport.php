<?php

namespace App\Imports;

use App\Enums\ColumnJNEEnums;
use App\Models\City;
use App\Models\Province;
use App\Models\SubDistrict;
use App\Models\Village;
use App\Models\Tarif;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;

class TarifImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return Model|Model[]|null
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
                /**
                 * get Village
                */
                $village = Village::where([
                    'name' => $row[ColumnJNEEnums::KELURAHAN],
                    'jne_subdistrict_id' => $district->id
                ])->first();

                if ($village) {
                    /** insert row tarif */

                    return Tarif::create([
                        'jne_city_id' => $city->id,
                        'jne_subdistrict_id' => $district->id,
                        'jne_village_id' => $village->id,
                        'oke' => $row[ColumnJNEEnums::OKE],
                        'reg' => $row[ColumnJNEEnums::REG],
                        'yes' => $row[ColumnJNEEnums::YES]
                    ]);
                }
            }
        }

        return null;
    }
}
