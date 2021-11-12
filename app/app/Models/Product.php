<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;


class Product extends Eloquent
{
    use HasFactory, SoftDeletes;

    protected $connection = 'mongodb';
    protected $colection = 'products';
    protected $fillable = [
        'name','amount','image','importPrice','outportPrice','manufacture','warrantyPeriod',
        'category_id','description','tag'
    ];
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    
}
