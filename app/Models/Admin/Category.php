<?php

namespace App\Models\Admin;

use App\Models\Admin\Products;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;
    protected $table="categories";
    protected $fillable = ['name','description','image','status'];

    public function products(){
        return $this->hasMany(Products::class , 'category_id','id');
    }
}
