<?php

namespace App\Livewire\Frontend;

use App\Models\Cart;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class CartShow extends Component
{   
    public $cart;
    public function render()
    {
        $this->cart=Cart::where('user_id',Auth::user()->id)->get();
        return view('livewire.frontend.cart-show',['cart'=>$this->cart]);
    }
}
