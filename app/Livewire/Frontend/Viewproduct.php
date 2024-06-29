<?php

namespace App\Livewire\Frontend;

use App\Models\Cart;
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
                if($this->product->where('id',$productId)->where('status',1)->exists()){
                    //add to cart table
                    Cart::create([
                        'user_id'=>auth()->user()->id,
                        'product_id'=>$productId,
                        'quantity'=>$this->qtyCount
                    ]);
                    session()->flash("success+_message","Item added to cart");

                    $this->dispatch('message', ['text' =>"product added to cart", 'type'=>'success','status'=>200]);
                }
                else {
                    $this->dispatch('message', [
                        'text' =>"product does not exists", 'type'=>'warning',  'status'=>401   ]);
                }
        }
        else {
            //error message 
            $this->dispatch('message', [ 'text' =>"please login first",  'type'=>'error', 'status'=>400]);
        }
    }

    public function render()
    {
        return view('livewire.frontend.viewproduct',['product'=>$this->product]);
    }
}
