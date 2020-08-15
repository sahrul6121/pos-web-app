<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id' ,
        'store_id',
        'staff_id',
        'total_price',
        'tax',
        'total_price_with_tax',
    ];

    public function store()
    {
        return $this->hasOne(Store::class, 'id', 'store_id');
    }

    public function staff()
    {
        return $this->hasOne(User::class, 'id', 'staff_id');
    }

    public function transactionCarts()
    {
        return $this->hasMany(TransactionCart::class, 'transaction_id', 'id');
    }
}
