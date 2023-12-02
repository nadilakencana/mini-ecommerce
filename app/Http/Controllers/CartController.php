<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DetailOrder;
use App\Models\Product;
use App\Models\Kategori;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Session;

class CartController extends Controller
{
    public function KodeOrder($length=8){
        $str ='';
        $charecters=array_merge(range('A','Z'),range('a','z'));
        $max = count($charecters)-1;
        for($i = 0; $i < $length; $i++){
            $rand = mt_rand(0, $max);
            $str .=$charecters[$rand];
        }
        return $str;
    }

    public function detailCart(){
         $kategori = Kategori::all();
         $carts = Session::get('cart');

         $subtotal = 0;

        if(isset($carts) === false){
			$carts = [];
		}else{
			foreach($carts as $cart){
                $subtotal = $subtotal + $cart['qty'] * $cart['harga'];
			}
		}

         return view('FrontEndUser.HomeCustomer.Cart', compact('kategori', 'carts', 'subtotal'));
    }

    public function addtoCart(Request $request){
        $product = Product::where('id', $request->get('id'))->first();

        $ex = false;
        $exId = 0;
        $cart = Session::get('cart');

        if($cart){
            foreach($cart as $key => $value){
                if($value['id'] == $request->get('id')){
                    $ex = true;
                    $exId = $key;
                }
            }
        }

        $count = 0 ;
        $curentPrice = 0;
        $curentPrice = $product->harga;

        if($ex == false){
            $cart[] = array(
                'id' => $product->id,
                'nama' => $product->nama,
                'image' => $product->image,
                'harga' => $product->harga,
                'qty' => $request->get('qty'),
                'id_ukuran' => $request->get('id_ukuran'),
                'id_warna' => $request->get('id_warna'),
                'ukuran' => $request->get('ukuran'),
                'warna' => $request->get('warna'),


            );
        }else{
            $cart[$exId]['qty'] = $request->get('qty');
        }

        Session::put('cart', $cart);
        Session::save();
        $cart = Session::get('cart');
        $count = count($cart);
        return response()->json(['success' => 1, 'message'=> 'Data Tersimpan', 'data'=>$cart,'count'=>$count]);

    }

    public function deleteCart(Request $request){
        $cart = Session::get('cart');

        if($cart){
            foreach($cart as $key => $value){
                if($key == $request->get('id')){
                     unset($cart[$key]);
                }
            }
        }

        Session::put('cart', $cart);
        Session::save();
        $cart = Session::get('cart');

        $count = count($cart);
        return response()->json([
            'success' => 1,
            'message' =>'Data berhasil Dihapus',
            'data' =>$cart,
            'count' => $count
        ]);
    }

    public function cekout(Request $request){
        $carts = Session::get('cart');

        $order = New Order();
        $order->kode_order = $this->KodeOrder();
        $order->id_user = Auth::id();
        $order->subTotal = $request->subtotal;
        $order->total = $request->total;
        $order->status = 'OnProses';
        $order->save();

        if($order->save()){
            foreach($carts as $cart){
                $detailOrder = new DetailOrder();
                $detailOrder->id_order = $order->id;
                $detailOrder->id_product = $cart['id'];
                $detailOrder->id_ukuran =$cart['id_ukuran'];
                $detailOrder->id_warna = $cart['id_warna'];
                $detailOrder->qty = $cart['qty'];
                $detailOrder->harga_product = $cart['harga'];
                $detailOrder->total_item = $cart['qty'] * $cart['harga'];
                $detailOrder->save();
            }
        }

        Session::forget('cart');
            return response()->json([
                'success' => 1,
                'message' => 'Order di Proses',
                'no_order' => $order->kode_pesanan
            ]);
    }
}
