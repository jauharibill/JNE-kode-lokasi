<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Village extends Model
{
    /**
     * @var string
     */
    protected $table = "jne_village";

    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'zip',
        'jne_subdistrict_id'
    ];

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var string
     */
    protected $primaryKey = "id";
}
