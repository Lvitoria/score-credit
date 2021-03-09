<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;


use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
class BaseCModal extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'credit';
    protected $hidden = [
        '_id',
        'name',
        'cpf',
        'address',
        'listOfDebts',
        'dateOfBirth',
        'listOfGoods',
        'sourceOfIncome',
        'created_at',
        'updated_at'
    ];

}
