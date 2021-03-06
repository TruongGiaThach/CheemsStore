<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;


class ReceiptDetail extends Eloquent
{
    use HasFactory, SoftDeletes;

    protected $connection = 'mongodb';
    protected $colection = 'receipt_detail';
    protected $fillable = [
        'receipt_id','product_id','amount','unitPrice',
    ];
    protected $table = 'receipt_detail';
    public function product()
    {
        return $this->hasOne(Product::class, 'product_id');
    }
    public function receipt()
    {
        return $this->belongsTo(Receipt::class, 'receipt_id');
    }
}
