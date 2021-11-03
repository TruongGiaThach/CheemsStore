<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;


class Staff extends Eloquent
{
    use HasFactory, SoftDeletes;

    protected $connection = 'mongodb';
    protected $colection = 'staff';
    protected $fillable = [
        'email', 'name', 'cmnd', 'numOfDayOff'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'email');
    }
}