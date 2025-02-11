<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Example extends Model
{
    /**
     * @var string
     */
    protected $table = 'examples';

    /**
     * @var array
     */
    protected $fillable = [
        'id', 'total'
    ];
}
