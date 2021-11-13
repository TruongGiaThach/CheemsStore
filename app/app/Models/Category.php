<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;


class Category extends Eloquent
{
    use HasFactory, SoftDeletes;

    protected $connection = 'mongodb';
    protected $colection = 'category';
    protected $fillable = [
        'name','description'
    ];
}
