<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sap extends Model
{
    protected $fillable = [
        'firstName',
        'lastName',
        'middleName',
        'gender',
        'birthDay',
        'birthMonth',
        'birthYear',
        'received',
        'receivedWhere',
        'receivedWhen',
        'user_id'
    ];
}
