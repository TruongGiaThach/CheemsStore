<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Customer extends Eloquent
{
    use HasFactory, SoftDeletes;

    protected $table = 'customers';
    protected $connection = 'mongodb';
    protected $colection = 'customers';
    protected $fillable = [
        '_id','name', 'email', 'number'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'email');
    }
}