<?php

namespace App\Livewire\Frontend;

use App\Models\Cart;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class CartShow extends Component
{   
    public $cart;

    public function decreaseQty($id){
        $cartData = Cart::where('id',$id)->where('user_id',auth()->user()->id)->first();
        if($cartData){
            if($cartData->quantity > 1){
                $cartData->decrement('quantity');
                $this->dispatch('message', ['text' =>"product Qty decreased by 1", 'type'=>'info','status'=>200]);   
            }                       
        } 
        else {
            $this->dispatch('message', [ 'text'=>'something went wrong',
            'type'=>'error',
            'status'=>400]);   
        }
    }
    public function increaseQty($id){
        $cartData = Cart::where('id',$id)->where('user_id',auth()->user()->id)->first();
        if($cartData){
            if($cartData->quantity < $cartData->product->qty){
                $cartData->increment('quantity');
                $this->dispatch('message', ['text' =>"product Qty increased by 1", 'type'=>'info','status'=>200]);
            }
            else {
                $this->dispatch('message', [ 'text'=>'only '.$cartData->product->qty. " qty available",
                'type'=>'error',
                'status'=>400]);   
            }
                        
        }   else {
            $this->dispatch('message', [ 'text'=>'something went wrong',
            'type'=>'error',
            'status'=>400]);   
        }
    }


    public function removeFromCart($id){
        $cartData = Cart::where('id',$id)->where('user_id',auth()->user()->id)->delete();
        $this->dispatch('cartAddedorUpdated');
    }

    public function render()
    {
        $this->cart=Cart::where('user_id',Auth::user()->id)->get();
        return view('livewire.frontend.cart-show',['cart'=>$this->cart]);
    }
}
