<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Products;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Products::get();
        $cart = Cart::get();

        return view('cart.index', ['cart' => $cart, 'products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'products_id' => ['required'],
        ]);

        $produkcek = Products::find($request->products_id);

        $cartcek = Cart::where('products_id', '=', $request->products_id)->first();

        if ($cartcek == null) {
            if ($request->qty == null) {
                if ($produkcek->stock >= 1) {
                    $cart = new Cart();
                    $cart->products_id = $request->products_id;
                    $cart->qty = 1;
                    $saveCart = $cart->save();

                    if ($saveCart == true) {
                        return redirect()->route('cart.index')->with('success', 'Berhasil Menambahkan Cart');
                    } else {
                        return redirect()->route('cart.index')->with('error', 'Gagal Menambahkan Cart');
                    }
                } else {
                    return redirect()->route('cart.index')->with('warning', 'Stock Habis');
                }
            } else {

                if ($produkcek->stock >= $request->qty) {
                    $cart = new Cart();
                    $cart->products_id = $request->products_id;
                    $cart->qty = $request->qty;
                    $saveCart = $cart->save();

                    if ($saveCart == true) {
                        return redirect()->route('cart.index')->with('success', 'Berhasil Menambahkan Cart');
                    } else {
                        return redirect()->route('cart.index')->with('error', 'Gagal Menambahkan Cart');
                    }
                } else {
                    return redirect()->route('cart.index')->with('warning', 'Stock Tidak Cukup');
                }
            }
        } else {


            if ($request->qty == null) {

                $cart = Cart::where('products_id', '=', $request->products_id)->get();

                if ($produkcek->stock >= 1 + $cart[0]->qty) {


                    $cart[0]->products_id = $request->products_id;
                    $cart[0]->qty = $cart[0]->qty + 1;
                    $saveCart = $cart[0]->save();

                    if ($saveCart == true) {
                        return redirect()->route('cart.index')->with('success', 'Berhasil Menambahkan Cart');
                    } else {
                        return redirect()->route('cart.index')->with('error', 'Gagal Menambahkan Cart');
                    }
                } else {
                    return redirect()->route('cart.index')->with('warning', 'Maksimal Quantity');
                }
            } else {

                $cart = Cart::where('products_id', '=', $request->products_id)->get();

                if ($produkcek->stock >= $cart[0]->qty + $request->qty) {
                    $cart[0]->products_id = $request->products_id;
                    $cart[0]->qty = $cart[0]->qty + $request->qty;
                    $saveCart = $cart[0]->save();

                    if ($saveCart == true) {
                        return redirect()->route('cart.index')->with('success', 'Berhasil Menambahkan Cart');
                    } else {
                        return redirect()->route('cart.index')->with('error', 'Gagal Menambahkan Cart');
                    }
                } else {
                    return redirect()->route('cart.index')->with('warning', 'Maksimal Quantity');
                }
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cart $cart)
    {
        if ($request->type == 'increment') {

            $cart->qty = $cart->qty + 1;
            $saveCart = $cart->save();

            if ($saveCart == true) {
                return redirect()->route('cart.index')->with('success', 'Berhasil Menambahkan Quantity Cart');
            } else {
                return redirect()->route('cart.index')->with('error', 'Gagal Menambahkan Cart');
            }
        } else {
            if ($cart->qty == 1) {
                return redirect()->route('cart.index')->with('warning', 'Tidak Dapat Mengurangi Quantity Cart');
            } else {
                $cart->qty = $cart->qty - 1;
                $saveCart = $cart->save();

                if ($saveCart == true) {
                    return redirect()->route('cart.index')->with('success', 'Berhasil Mengurangi Quantity Cart');
                } else {
                    return redirect()->route('cart.index')->with('error', 'Gagal Menambahkan Cart');
                }
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cart $cart)
    {
        $destroy = $cart->delete();

        if ($destroy == true) {
            return redirect()->route('cart.index')->with('success', 'Cart Berhasil DiHapus');
        } else {
            return redirect()->route('cart.index')->with('error', 'Cart Gagal Dihapus Ada Kesalahan Pada Sistem');
        }
    }
}
