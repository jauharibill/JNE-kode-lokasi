<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubDistrict extends Model
{
    /**
     * @var string
     */
    protected $table = "jne_subdistrict";

    /**
     * @var array
     */
    protected $fillable = [
        'koding',
        'syscode',
        'name',
        'jne_city_id'
    ];

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var string
     */
    protected $primaryKey = "id";

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function city()
    {
        return $this->belongsTo(City::class, 'jne_city_id');
    }
}
