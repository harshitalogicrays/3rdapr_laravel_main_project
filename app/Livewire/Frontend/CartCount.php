<?php

namespace App\Livewire\Frontend;

use App\Models\Cart;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class CartCount extends Component
{   
    public $count=0;
    protected $listeners = ['cartAddedorUpdated' => 'checkCartCount'];
    public function checkCartCount(){
            if(Auth::check()){
                return $this->count= Cart::where('user_id',Auth::user()->id)->count();   
            }     
            else return $this->count=0;
    }
    public function render()
    {   
        $this->count = $this->checkCartCount();
        return view('livewire.frontend.cart-count',['count',$this->count]);
    }
}
