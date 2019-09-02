<?php

/**
 * Stock Personal Model
 *
 * @author Adolfo
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stock_personal extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'erp_code', 'name', 'quantity','date'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'updated_at','created_at'
    ];
   
}




