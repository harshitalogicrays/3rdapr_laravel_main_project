<?php

namespace App\Models;

use App\Models\Admin\Products;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cart extends Model
{
    use HasFactory;
    protected $table="cart";
    protected $fillable = ['user_id','product_id','quantity'];

    public function product(){
        return $this->belongsTo(Products::class,'product_id','id');
    } 
}
