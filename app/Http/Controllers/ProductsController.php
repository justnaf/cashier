<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Carbon\Carbon;
use Illuminate\Support\Facades\File; 
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Products::get();
        return view('products.index',['data'=> $data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required','string','max:255'],
            'stock' => ['numeric'],
            'cost' => ['numeric'],
            'price' => ['numeric'],
            'pic' => ['file','mimes:png,jpg','max:1000'],
        ]);

        if ($request->hasFile('pic')) {
            $file = $request->file('pic');
            $fileName = Carbon::now(). " ".$request->name .'.'.$file->getClientOriginalExtension();
            $path = $file->move('product_pic',$fileName);

            $products = new Products();
            $products->name = $request->name;
            $products->stock = $request->stock;
            $products->cost = $request->cost;
            $products->price = $request->price;
            $products->pic_path = $path;
            $saveProduct = $products->save();

            if ($saveProduct == true) {
                return redirect()->route('products.index')->with('success','Berhasil Menambahkan Produk');
            }
            else{
                return redirect()->route('products.index')->with('error','Gagal Menambahkan Produk');
            }
        }
        else
        {
            $products = new Products();
            $products->name = $request->name;
            $products->stock = $request->stock;
            $products->cost = $request->cost;
            $products->price = $request->price;
            $saveProduct = $products->save();

            if ($saveProduct == true) {
                return redirect()->route('products.index')->with('success','Berhasil Menambahkan Produk');
            }
            else{
                return redirect()->route('products.index')->with('error','Gagal Menambahkan Produk');
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Products $products)
    {
       
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Products $product)
    {
        return view('products.edit',['data'=>$product]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Products $product)
    {
        $request->validate([
            'name' => ['required','string','max:255'],
            'stock' => ['numeric'],
            'cost' => ['numeric'],
            'price' => ['numeric'],
            'pic' => ['file','mimes:png,jpg','max:1000'],
        ]);
        
        if ($request->hasFile('pic')) {
            if ($product->pic_path == true) {

                File::delete($product->pic_path);
    
                $file = $request->file('pic');
                $fileName = Carbon::now(). " ".$request->name .'.'.$file->getClientOriginalExtension();
                $path = $file->move('product_pic',$fileName);
    
                $product->name = $request->name;
                $product->stock = $request->stock;
                $product->cost = $request->cost;
                $product->price = $request->price;
                $product->pic_path = $path;
                $saveProduct = $product->save();

                if ($saveProduct == true) {
                    return redirect()->route('products.index')->with('success','Berhasil Mengupdate Produk');
                }
                else{
                    return redirect()->route('products.index')->with('error','Gagal Mengupdate Produk');
                }
            }
            else{

                $file = $request->file('pic');
                $fileName = Carbon::now(). " ".$request->name .'.'.$file->getClientOriginalExtension();
                $path = $file->move('product_pic',$fileName);
    
                $product->name = $request->name;
                $product->stock = $request->stock;
                $product->cost = $request->cost;
                $product->price = $request->price;
                $product->pic_path = $path;
                $saveProduct = $product->save();

                if ($saveProduct == true) {
                    return redirect()->route('products.index')->with('success','Berhasil mengupdate Produk');
                }
                else{
                    return redirect()->route('products.index')->with('error','Gagal Mengupdate Produk');
                }

            }
        }
        else {
            $product->name = $request->name;
            $product->stock = $request->stock;
            $product->cost = $request->cost;
            $product->price = $request->price;
            $saveProduct = $product->save();

            if ($saveProduct == true) {
                return redirect()->route('products.index')->with('success','Berhasil mengupdate Produk');
            }
            else{
                return redirect()->route('products.index')->with('error','Gagal Mengupdate Produk');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Products $product)
    {
        $destroy = $product->delete();

        if ($destroy == true) {
            return redirect()->route('products.index')->with('success','Produk Berhasil DiHapus');
        }
        else
        {
            return redirect()->route('products.index')->with('error','Produk Gagal Dihapus Ada Kesalahan Pada Sistem');
        }
    }
}
