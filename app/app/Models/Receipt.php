<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;


class Receipt extends Eloquent
{
    use HasFactory, SoftDeletes;

    protected $table = 'receipt';
    protected $connection = 'mongodb';
    protected $colection = 'receipt';
    protected $fillable = [
        'user_id','createDay','total','VAT',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
