<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;


class ReceiptDetail extends Eloquent
{
    use HasFactory, SoftDeletes;

    protected $table = 'receipt_detail';
    protected $connection = 'mongodb';
    protected $colection = 'receipt_detail';
    protected $fillable = [
        'receipt_id','product_id','unitPrice','amount', //đổi từ total sang amount
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
    public function receipt()
    {
        return $this->belongsTo(Receipt::class, 'receipt_id');
    }
}
