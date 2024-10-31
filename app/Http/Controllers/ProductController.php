<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;


class ProductController extends Controller
{

    public function index(){
        $products = product::all();
        return view('products.index', ['products' => $products]);
    }

    public function create(){
        return view('products.create');
        }

    public function store(Request $request){
        $data = $request->validate([
            'name' => 'required',
            'qty' => 'required|numeric',
            'price' => 'required|decimal:0,2',
           'description' => 'nullable'
            ]); 
            Product::create($data);
                return redirect(route('products.index'));
            }

            public function edit(product $product){
                return view('products.edit', ['product' => $product]);
            }
    
public function update(Product $product, Request $request){
    $data = $request->validate([
        'name' => 'required',
        'qty' => 'required|numeric',
        'price' => 'required|decimal:0,2',
       'description' => 'nullable'
        ]); 

        $product->update($data);
            return redirect(route('products.index'))->with('success', 'Product Update Successfully');
        
    }


    public function destroy(product $product){
        $product->delete();
    return redirect(route('products.index'))->with('success', 'Product Update Successfully');
    }
}

