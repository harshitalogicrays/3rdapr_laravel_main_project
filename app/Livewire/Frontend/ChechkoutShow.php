<?php

namespace App\Livewire\Frontend;

use App\Models\Cart;
use Livewire\Component;

class ChechkoutShow extends Component
{
    public $carts,$totalAmount;
    public $fullName,$email,$phone,$pincode,$address;
    public function rules(){
        return [
            'fullName'=>'required|string',
            'email'=>'required',
            'phone'=>'required|string|min:10|max:10',
            'pincode'=>'required|string|min:6|max:6',
            'address'=>'required|string'
        ];
    }
    public function mount(){
        $this->fullName=auth()->user()->name;
        $this->email =  auth()->user()->email;
    }

    public function codorder(){
        $this->validate();
    }

    public function totalCartAmount(){
        $this->totalAmount=0;
        $this->carts = Cart::where('user_id',auth()->user()->id)->get();
        foreach($this->carts as $cartItem){
            $this->totalAmount +=   $cartItem->quantity * $cartItem->product->selling_price;
        }
        return $this->totalAmount;
    }
    public function render()
    {   $this->totalAmount = $this->totalCartAmount();
        return view('livewire.frontend.chechkout-show',['totalAmount'=>$this->totalAmount]);
    }
}
