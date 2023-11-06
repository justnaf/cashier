<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Models\Restock;
use Illuminate\Http\Request;

class RestockController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Restock::get();
        return view('restock.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = Products::get();
        return view('restock.create', ['data' => $data]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $restock = new Restock();
        $restock->products_id = $request->products_id;
        $restock->stock = $request->qty;
        $restock->price = $request->price;
        $saveRestock = $restock->save();

        if ($saveRestock == true) {
            $updateProducts = Products::find($request->products_id);
            $updateProducts->stock = $updateProducts->stock + $request->qty;
            $saveUpPro = $updateProducts->save();
            if ($saveUpPro == true) {
                return redirect()->route('restocks.index')->with('success', 'Berhasil Menambahkan Restock');
            }
        } else {
            return redirect()->route('restocks.index')->with('error', 'Gagal Menambahkan Restock');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Restock $restock)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Restock $restock)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Restock $restock)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Restock $restock)
    {
        $updateProducts = Products::find($restock->products_id);
        $updateProducts->stock = $updateProducts->stock - $restock->stock;
        $saveUpPro = $updateProducts->save();

        if ($saveUpPro == true) {
            $destroy = $restock->delete();

            if ($destroy == true) {
                return redirect()->route('restocks.index')->with('success', 'Restock Berhasil DiHapus');
            } else {
                return redirect()->route('restocks.index')->with('warning', 'Restock Gagal Dihapus Ada Kesalahan Pada Sistem');
            }
        } else {
            return redirect()->route('restocks.index')->with('error', 'Restock Gagal Dihapus Ada Kesalahan Pada Sistem');
        }
    }
}
