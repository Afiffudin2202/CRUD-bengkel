<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductsRequest;
use App\Http\Requests\UpdateProductsRequest;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // searching data
        $search = $request->query('search');
        if (!empty($search)) {
           $dataProducts = Products::where('products.code_product', 'like', '%'. $search .'%')
           ->orWhere('products.name', 'like', '%'. $search .'%')
           ->paginate(10)->onEachSide(2)->fragment('prdct');
        } else {
            $dataProducts = Products::paginate(10)->onEachSide(2)->fragment('prdct');
        }
        
        
        return view('products.data',[
            'products' => $dataProducts,
            'search' =>$search
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
     
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductsRequest $request)
    {
        // validasi data di ambil dari folder request
        $validated = $request->validated();

        // save data 
        $products = new Products;
        $products->code_product = $request->code_product;
        $products->name = $request->name;
        $products->price = $request->price;
        $products->quantity = $request->quantity;
        $products->save();

        // menyimpan dengan session with message
        return redirect('products')->with('status', 'Data has been added');
    }

    /**
     * Display the specified resource.
     */
    public function show(Products $products, $id)
    {
        //edit products
        $data = $products->find($id);
        return view('products.formedit')->with([
            'id' => $data->id,
            'code_product' => $data->code_product,
            'name' => $data->name,
            'price' => $data->price,
            'quantity' => $data->quantity
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Products $products)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductsRequest $request, Products $products, $id)
    {
         // save data 
        $data = $products->find($id);
        $data->code_product = $request->code_product;
        $data->name = $request->name;
        $data->price = $request->price;
        $data->quantity = $request->quantity;
        $data->save();

        // menyimpan dengan session with message
        return redirect('products')->with('status', 'Data has been edited');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Products $products, $id)
    {
        $data = $products->find($id);
        $data->delete();

           // menyimpan dengan session with message
        return redirect('products')->with('status', 'Data has been deleted');
    }
}
