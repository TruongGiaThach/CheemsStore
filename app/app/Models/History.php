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
    protected $colection = 'historys';
    protected $fillable = [
        'staff_id', 'content', 'implementDate'
    ];
    public function staff()
    {
        return $this->belongsTo(Staff::class, 'staff_id');
    }

}
