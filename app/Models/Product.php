<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    protected $fillable = [
        'name',
        'price',
        'category_id',
        'quantity',
        'user_id'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function scopeSearch($query,$name,$min,$max) {
        return $query
        ->when($name != null, function ($q) use ($name) {
            return $q->where('name', 'like', "%" . $name . "%");
        })->when($min!=null and $max!= null,function ($q) use($min,$max){
                return $q->where('price', '>=',$min)->where('price','<=',$max);
            });
    }
}
