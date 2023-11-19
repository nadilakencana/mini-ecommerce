<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\DetailOrder;
class OrderController extends Controller
{
    public function DataOrders(){
        $order = Order::all();
        $orders = Order::findOrFail(1);
        $itmOrder = DetailOrder::where('id_order', $orders->id)->get();
        return view('DasboardAdmin.Order.index', compact('order', 'orders', 'itmOrder'));
    }

    public function DetailsOrder($id){
        $dec = decrypt($id);
        $order = Order::findOrFail($dec);
        $itmOrder = DetailOrder::where('id_order', $order->id)->get();

        return view('DasboardAdmin.Order.detail', compact('order', 'itmOrder'));

    }

    public function AcceptOrder(Request $request, $id){

        $order = Order::where('id', $id)->first();
        $order->status = 'Order Accept';
        $order->save();

        return response()->json([
            'Success' => 1,
            'message' => 'data status terupdate',
            'data' => $order
        ]);
    }
    public function Finish(Request $request, $id){

        $order = Order::where('id', $id)->first();
        $order->status = 'Order Completed';
        $order->save();

        return response()->json([
            'Success' => 1,
            'message' => 'data status terupdate',
            'data' => $order
        ]);
    }

    public function deleteOrder($id){
        $dec = decrypt($id);
        $order = Order::findOrFail($dec);
        $order->delete();

       if($order->delete()){
            return redirect()->route('data-order')->with('success', 'Data delete successfully');
        }else{
            return redirect()->back()->with('faild', 'Data failed to delete');
        }
    }

    public function invoiceOrder($id){
        $dec = decrypt($id);
        $order = Order::findOrFail($dec);
        $itmOrder = DetailOrder::where('id_order', $order->id)->get();

        return view('DasboardAdmin.Order.invoice', compact('order', 'itmOrder'));
    }
}
