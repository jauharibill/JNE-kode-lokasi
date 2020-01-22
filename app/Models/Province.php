<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    /**
     * @var string
     */
    protected $table = "jne_province";

    /**
     * @var string
     */
    protected $primaryKey = "id";

    /**
     * @var bool
     */
    public $timestamps = false;

}
