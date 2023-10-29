<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\DetailOrder;
class OrderController extends Controller
{
    public function DataOrders(){
        $order = Order::all();

        return view('', compact('order'));
    }

    public function DetailsOrder($id){
        $dec = decrypt($id);
        $order = Order::findOrFail($dec);
        $itmOrder = DetailOrder::where('id_order', $order->id)->get();

        return view('', compact('order', 'itmOrder'));
    }
}
