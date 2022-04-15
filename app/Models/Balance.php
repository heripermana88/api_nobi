<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Balance extends Model
{
    protected $table = 'balance';
    protected $casts = ['amount_available' => 'float' ];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'amount_available'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'created_at',
        'updated_at'
    ];
}
