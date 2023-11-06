<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\OrderDetail;
use App\Models\OrderHead;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF;

class OrderController extends Controller
{
    public function index()
    {
        $data = OrderHead::with('orderdetail')->get();


        return view('order.index', ['data' => $data]);
    }


    public function store(Request $request)
    {

        $orderHeadId = OrderHead::AddHeadOrder(Auth::user()->username, $request->buyer);

        $cart = Cart::all();


        if (count($cart) > 0) {
            foreach ($cart as $produk) {

                $detailOrder = new OrderDetail();
                $detailOrder->order_heads_id = $orderHeadId;
                $detailOrder->produk = $produk->products->name;
                $detailOrder->qty = $produk->qty;
                $detailOrder->subtotal = $produk->qty * $produk->products->price;
                $detailOrder->save();

                $decremetnQty = Products::find($produk->products->id);
                $decremetnQty->stock = $decremetnQty->stock - $produk->qty;
                $decremetnQty->save();

                $produk->delete();
            };

            return redirect()->route('order.index')->with('success', 'Berhasil Menambahkan Order');
        } else {
            return redirect()->route('cart.index')->with('warning', 'Something Wrong Pada Order');
        }
    }

    public function show(OrderHead $id)
    {
        return view('order.show', ['data' => $id]);
    }

    public function createPDF(OrderHead $id)
    {
        $data = $id;
        $pdf = PDF::loadview('order.print', array('data' => $data));
        return $pdf->download('invoice.pdf');
    }


    public function destroy(OrderHead $id)
    {
        $destroy = $id->delete();

        if ($destroy == true) {
            return redirect()->route('order.index')->with('success', 'Produk Berhasil DiHapus');
        } else {
            return redirect()->route('order.index')->with('error', 'Produk Gagal Dihapus Ada Kesalahan Pada Sistem');
        }
    }

    public function  dashboard()
    {
        $produk = Products::get();

        $order = OrderDetail::get();
        return view('dashboard', ['produk' => $produk, 'order' => $order]);
    }
}
