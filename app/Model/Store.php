<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'admin_id',
        'name',
        'address',
        'logo',
    ];

    /**
     * Get store owner
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function owner()
    {
        return $this->hasOne(User::class, 'id', 'admin_id');
    }

    /**
     * Get store products
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products()
    {
        return $this->hasMany(Product::class, 'store_id', 'id');
    }

    public function getLogoAttribute($value)
    {
        if (! $value) {
            return url('images/default-avatar.jpg');
        }

        return url($value);
    }
}
