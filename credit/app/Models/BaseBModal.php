<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
class BaseBModal extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'credit';
    protected $hidden = [
        '_id',
        'name',
        'cpf',
        'listOfDebts',
        'bureau',
        'financialMovement',
        'creditCardPurchases',
        'created_at',
        'updated_at',
    ];

}
