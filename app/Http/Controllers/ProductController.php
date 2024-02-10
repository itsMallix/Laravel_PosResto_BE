<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Product;


class ProductController extends Controller
{
    // index
    public function index(){
        //get all product
        $products = Product::paginate(10);
        return view('pages.products.index', compact('products'));
    }
    //create
    public function create(){
        //get all categories
        $categories = DB::table('categories')->get();
        return view('pages.products.create', compact('categories'));
    }

    //store
    public function store(Request $request){
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
        ]);
    }

    //show
    public function show($id){
        return view('pages.product.show');
    }

    //edit
    public function edit($id){
        return view('pages.product.edit');
    }

    //update
    public function update(Request $request, $id){
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
        ]);
    }

    //destroy
    public function destroy($id){

        return redirect()->route('products.index')->with('success', 'Product deleted successfully');
    }
}
