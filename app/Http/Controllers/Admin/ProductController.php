<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CategoryItem;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function create($id)
    {
        $categoryItem=CategoryItem::find($id);
        return view('dashboard.products.create',compact('categoryItem'));
    }

    public function store(Request $request)
    {
        $product= new Product();
        if($request->file('subProductImage')){
            $filename = request('subProductImage')->getClientOriginalName();
            request()->file('subProductImage')->move(public_path() . '/images/products/sub' , $filename);
            $product['user_id']=Auth::user()->id;
            $product['subcategory_id']=$request->subcategory_id;
            $product['category_item_id']=$request->category_item_id;
            $product['name_ar']=$request->name_ar;
            $product['name_en']=$request->name_en;
            $product['desc_ar']=$request->desc_ar;
            $product['desc_en']=$request->desc_en;
        }
        $product->save();
        ProductService::create([
            'product_id'=>$product['id'],
            'services'=>$request->services,
            'price'=>$request->price,
        ]);

        $productImage=new ProductImage();
        if($request->file('image')){
            $filename = request('image')->getClientOriginalName();
            request()->file('image')->move(public_path() . '/images/' , $filename);
        }
        $productImage['image']= $filename;
        $productImage['product_id']= $product['id'];
        $productImage->save();
        return  redirect()->route('CategoryItems.index',$request->subcategory_id);
    }


    public function  destroy($id){
        $product=Product::with(['productService','productImages'])->find($id);
        $product->delete();
        return redirect()->back();
    }


    public function view($id){
        $product=Product::with(['productService','productImages'])->find($id)->get();
        return  view('dashboard.products.view',compact('product'));
    }


    public function edit($id){
        $product=Product::with(['productService','productImages'])->find($id)->get();
        return  view('dashboard.products.edit',compact('product'));
    }

    public function update(Request $request,$id){

    }
}
