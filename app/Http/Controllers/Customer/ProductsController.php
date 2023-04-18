<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\CategoryItem;
use App\Models\Product;
use App\Models\ProductService;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $products=Product::where('subcategory_id',$id)->get();
        return view('customers.backEnd.Products.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $categoryItems=CategoryItem::where('subcategory_id',$id)->get();
        return view('customers.backEnd.Products.create',compact('categoryItems'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product= new Product();
        $product['user_id']=$request->user_id;
        $product['subcategory_id']=$request->subcategory_id;
        $product['category_item_id']=$request->category_item_id;
        $product['name_ar']=$request->name_ar;
        $product['name_en']=$request->name_en;
        $product['desc_ar']=$request->desc_ar;
        $product['desc_en']=$request->desc_en;

        if($request->file('image')){
            $filename = request('image')->getClientOriginalName();
            request()->file('image')->move(public_path() . '/images/' , $filename);
            $product['image']= $filename;
        }
        $product->save();
        return  redirect()->route('Customer.Products.index',Auth::user()->subCategory_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product=Product::with('categoryItem')->findOrfail($id);

        return view('customers.backEnd.Products.edit',compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $product=Product::find($id);
        $product->update([
            'name_ar'=>$request->name_ar,
            'name_en'=>$request->name_en,
            'desc_ar'=>$request->desc_ar,
            'desc_en'=>$request->desc_en,
        ]);
        return redirect()->route('Customer.Products.index',Auth::user()->subCategory_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function  destroy($id){
        $product=Product::with(['productService','productImages'])->find($id);
        $product->delete();
        return  redirect()->route('Customer.Products.index',Auth::user()->subCategory_id);
    }

    public function addService($id){
        $product=Product::find($id);
        return view('customers.backEnd.Products.addService',compact('product'));
    }
    public function createService(Request $request){
        ProductService::create([
            'subcategory_id'=>$request->subcategory_id,
            'product_id'=>$request->product_id,
            'services'=>$request->services,
            'price'=>$request->price,
        ]);
        return redirect()->route('Customer.Products.index',Auth::user()->subCategory_id);
    }

    public function productServices($id){
        $product=Product::with('productTrashed')->find($id);
        return view('customers.backEnd.Products.productServices',compact('product'));
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

    public function viewAllServices($id)
    {
        $productService=productService::where('subCategory_id',$id)->get();
        return view('customers.backEnd.services.index',compact('productService'));
    }
}
