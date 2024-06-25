<?php

namespace App\Models\Admin;

use App\Models\Admin\Category;
use App\Models\Admin\ProductImages;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Products extends Model
{
    use HasFactory;
    protected $table="products";
    protected $fillable = ['name','description','brand','status','selling_price',
    'original_price','qty','category_id'];

    public function productImages(){
        return $this->hasMany(ProductImages::class , 'product_id','id');
    }
    public function category(){
        return $this->belongsTo(Category::class , 'category_id','id');
    }
}
