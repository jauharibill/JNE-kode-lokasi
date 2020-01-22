<?php

namespace App\Imports;

use App\Enums\ColumnJNEEnums;
use App\Models\City;
use App\Models\Province;
use Maatwebsite\Excel\Concerns\ToModel;

class ProvinceImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        if (!$this->isProvinceExists($row[ColumnJNEEnums::PROVINSI])) {
            return Province::create([
                'name' => $row[ColumnJNEEnums::PROVINSI]
            ]);
        }

        return null;
    }

    /**
     * @param $province_code
     * @return mixed
     */
    private function isProvinceExists($province_name)
    {
        return Province::where([
            'name' => $province_name
        ])->first();
    }
}
