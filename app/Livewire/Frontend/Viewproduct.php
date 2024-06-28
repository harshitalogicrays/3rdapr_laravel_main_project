<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Viewproduct extends Component
{
    public $product;
    public $qtyCount=1;
    public function mount($product){
        $this->product = $product;
    }

    public function increaseQty(){
        if($this->qtyCount < $this->product->qty)
             $this->qtyCount++;
    }
    public function decreaseQty(){
        if($this->qtyCount > 1)
        $this->qtyCount--;
    }
    
    public function addToCart($productId){
        if(Auth::check()){
            
        }
        else {
            //error message 
        }
    }

    public function render()
    {
        return view('livewire.frontend.viewproduct',['product'=>$this->product]);
    }
}
