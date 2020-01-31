<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tarif extends Model
{
    /**
     * @var string
     */
    protected $table = "jne_tarif";

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = [
        'jne_city_id',
        'jne_subdistrict_id',
        'jne_village_id',
        'oke',
        'reg',
        'yes'
    ];
}
