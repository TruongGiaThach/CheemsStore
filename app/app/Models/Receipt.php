<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;


class Receipt extends Eloquent
{
    use HasFactory, SoftDeletes;

    protected $connection = 'mongodb';
    protected $table = 'receipt';
    protected $fillable = [
        'user_id','createDay','total','VAT','staff_id'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'user_id');
    }
    public function receiptDetail()
    {
        return $this->hasMany(ReceiptDetail::class);
    }
}
