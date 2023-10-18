<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\productServiceRequest;
use App\Models\CategoryItem;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class ProductController extends Controller
{
    public function create($id)
    {
        if (Gate::denies('products.index')) {
            abort(403);
        };
        $categoryItem = CategoryItem::with('subcategories')->find($id);

        return view('dashboard.products.create', compact('categoryItem'));
    }

    public function store(ProductRequest $request)
    {
        if ($request->file('subProductImage')) {
            $filename = request('subProductImage')->getClientOriginalName();
            request()->file('subProductImage')->move(public_path() . '/assets/uploads/laundries/products', $filename);
        }
        Product::create($request->validated() + [
            'user_id' => Auth::user()->id,
            'image' => $filename
        ]);
        return redirect()->route('CategoryItems.show', $request->category_item_id);
    }


    public function  destroy($id)
    {
        $product = Product::with(['productService', 'productImages'])->find($id);

        $product->delete();
        return redirect()->back();
    }


    public function view($id)
    {
        $product = Product::find($id);
        return  view('dashboard.products.view', compact('product'));
    }


    public function edit($id)
    {

        $product = Product::with(['productService', 'productImages','subcategoryTrashed'])->find($id);
        return  view('dashboard.products.edit', compact('product'));
    }

    public function update(Request $request)
    {
//
//        $this->validate(
//            $request,
//            [
//                'name_ar'          => 'required|',
//                'name_en'          => 'required|',
//                'name_franco'          => 'required|',
//                'desc_ar'          => 'required',
//                'desc_en'          => 'required',
//                'urgentWash'          => 'required',
//
//            ],
//            [
//                'name_ar.regex' => 'حروف فقط',
//                'required' => 'هذا الحقل الزامى'
//            ]
//        );
        $product = Product::find($request->id);
        if (!empty($request->file('subProductImage'))) {
            $filename = request('subProductImage')->getClientOriginalName();
            request()->file('subProductImage')->move(public_path() . '/assets/uploads/laundries/products', $filename);
            $product->update([
                'image' => $filename
            ]);
        } else {
            $product->update([
                'name_ar' => $request->name_ar,
                'name_en' => $request->name_en,
                'name_franco' => $request->name_franco,
                'desc_ar' => $request->desc_ar,
                'desc_en' => $request->desc_en,
                'urgentWash' => $request->urgentWash??'0',
            ]);
        }
//        Product::where('id', $request->id)->update($request->except(['_token', '$request->id']));
        return redirect()->route('CategoryItems.show', $request->category_item_id);
    }
    public function addService($id)
    {
        $product = Product::find($id);
        return view('dashboard.products.addService', compact('product'));
    }
    public function createProductService(productServiceRequest $request)
    {

        $service = ProductService::create($request->all() + [
            'subcategory_id' => $request->subcategory_id,
            'product_id' => $request->product_id,

        ]);
        if ($service) {
            return redirect()->route('product.productServices', $request->product_id)->with('success', 'تم اضافه الخدمه');
        } else {
            return back()->with('failed', 'Failed! product not created');
        }
    }

    public function productServices($id)
    {
        $product = Product::with(['productService', 'subcategoryTrashed'])->find($id);

        return view('dashboard.products.productServices', compact('product'));
    }

    public function deleteService($id)
    {
        productService::find($id)->delete();
        return redirect()->back();
    }
    public function editService($id)
    {
        $service = productService::with('subCategory')->find($id);

        return view('dashboard.products.editService', compact('service'));
    }
    public function updateService(productServiceRequest $request, $id)
    {
        productService::where('id', $id)->update($request->except(['_token', 'service_id']));
        return redirect()->route('product.productServices', $request->product_id)->with('success', 'تم التعديل');
    }

    public function deleteProductService($id)
    {
        ProductService::find($id)->delete();
        return  redirect()->back()->with('error', 'تم الحذف');
    }
}
