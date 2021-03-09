<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class BaseAModel extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'credit';
    protected $fillable = [
        'name',
        'cpf',
        'address',
        'listOfDebts',
        'dateOfBirth',
        'listOfGoods',
        'sourceOfIncome',
        'bureau',
        'financialMovement',
        'creditCardPurchases'
    ];
    protected $hidden = [
        '_id',
        'dateOfBirth',
        'listOfGoods',
        'sourceOfIncome',
        'bureau',
        'financialMovement',
        'creditCardPurchases',
        'created_at',
        'updated_at'
    ];
}
