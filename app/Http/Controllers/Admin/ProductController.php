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
    public function addService($id){
        $product=Product::find($id);
        dd($product);
        return view('dashboard.products.addService',compact('product'));
    }
    public function createService(Request $request){
        ProductService::create([
            'product_id'=>$request->product_id,
            'services'=>$request->services,
            'price'=>$request->price,
        ]);
   return redirect()->route('CategoryItems.show',$request->category_item_id);
    }

    public function productServices($id){
        $product=Product::with('productService')->find($id);
        return view('dashboard.products.productServices',compact('product'));
    }

    public function deleteService($id){
        productService::find($id)->delete();
        return redirect()->back();
    }
    public function editService($id){
        $service=productService::find($id);
        return view('dashboard.products.editService',compact('service'));
    }
    public function updateService(Request $request,$id){

        productService::where('id',$id)->update([
            'id'=>$request->service_id,
            'services'=>$request->services,
            'price'=>$request->price,
        ]);
        return redirect()->route('product.productServices',$request->product_id);

    }
}
