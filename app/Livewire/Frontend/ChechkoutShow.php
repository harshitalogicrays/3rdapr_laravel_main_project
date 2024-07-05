<?php

namespace App\Livewire\Frontend;

use App\Models\Cart;
use App\Models\Orders;
use Livewire\Component;
use App\Models\OrderItems;
use Illuminate\Support\Str;

class ChechkoutShow extends Component
{
    public $carts,$totalAmount;
    public $fullname,$email,$phone,$pincode,$address;
    public $payment_mode=null,$payment_id=null;
    protected $listeners=['validationForAll','transactionEmit'=>'paidOnlineOrder'];

    public function rules(){
        return [
            'fullname'=>'required|string',
            'email'=>'required',
            'phone'=>'required|string|min:10|max:10',
            'pincode'=>'required|string|min:6|max:6',
            'address'=>'required|string'
        ];
    }
    public function mount(){
        $this->fullname=auth()->user()->name;
        $this->email =  auth()->user()->email;
    }

    public function placeorder(){
        $this->validate();
       $orders =  Orders::create([
            'user_id'=>auth()->user()->id,
            'tracking_no'=>Str::random(10),
            'fullname'=>$this->fullname,
            'email'=>$this->email,
            'phone'=>$this->phone,
            'pincode'=>$this->pincode,
            'address'=>$this->address,
            'status_message'=>'in progress',
            'payment_mode'=>$this->payment_mode,
            'payment_id'=>$this->payment_id
        ]);
        foreach($this->carts as $cartItem){
        $orderItems = OrderItems::create([
            'order_id'=>$orders->id,
            'product_id'=>$cartItem->product_id,
            'quantity'=>$cartItem->quantity,
            'price'=>$cartItem->product->selling_price
        ]);
        }
        return $orders;
    }


    public function validationForAll(){
        $this->validate();
    }
    public function codorder(){
        $this->payment_mode="cash on delivery";
        $codorder = $this->placeorder();
        if($codorder){
            $this->dispatch('message', ['text' =>"order placed", 'type'=>'success','status'=>200]);   
            Cart::where('user_id',auth()->user()->id)->delete();
            $this->dispatch('cartAddedorUpdated');
            return redirect('/thank-you');
        }
        else {
            $this->dispatch('message', ['text' =>"something went wrong", 'type'=>'error','status'=>400]);
     
        }
    }

    public function paidOnlineOrder($id){
        $this->payment_mode="online";
         $this->payment_id=$id;
        $onlineorder = $this->placeorder();
        if($onlineorder){
            $this->dispatch('message', ['text' =>"order placed", 'type'=>'success','status'=>200]);   
            Cart::where('user_id',auth()->user()->id)->delete();
            $this->dispatch('cartAddedorUpdated');
            return redirect('/thank-you');
        }
        else {
            $this->dispatch('message', ['text' =>"something went wrong", 'type'=>'error','status'=>400]);
     
        }
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
