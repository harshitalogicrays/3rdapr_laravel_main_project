<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use App\Models\Admin\Products;

class Cproducts extends Component
{
    public $category,$products,$priceInput;
protected $queryString = ['priceInput'=>['except'=>'','as'=>'price']];

    public function mount($category,$products){
        $this->category  = $category;
        $this->products = $products;
    }

    public function filterData($price){
     $this->priceInput =$price ;  
      $this->products = Products::where('status','1')
                         ->when($this->priceInput,function($q){
                            $q->when($this->priceInput=="below1000",function($q1){
                                $q1->where('selling_price','<',"1000")->where('selling_price','>=',"100");
                            })->when($this->priceInput=="below2000",function($q1){
                                $q1->where('selling_price','<',"2000")->where('selling_price','>',"1000");
                            })->when($this->priceInput=="below3000",function($q1){
                                $q1->where('selling_price','<=',"3000")->where('selling_price','>',"2000");
                            });
                         })->get();    
    }

    public function render()
    {
        // return view('livewire.frontend.cproducts',['products'=>$this->products,'category'=>$this->category]);

        // $this->products = Products::where('status','1')
        //                  ->when($this->priceInput,function($q){
        //                     $q->when($this->priceInput=="high-to-low",function($q1){
        //                         $q1->orderBy('selling_price','DESC');
        //                     })->when($this->priceInput=='low-to-high',function($q1){
        //                         $q1->orderBy('selling_price','ASC');
        //                     });
        //                  })->get();
        //                  return view('livewire.frontend.cproducts',['products'=>$this->products,'category'=>$this->category]);

        return view('livewire.frontend.cproducts',['products'=>$this->products,'category'=>$this->category]);
    }
}
