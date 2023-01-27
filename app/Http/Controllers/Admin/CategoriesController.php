<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public  function index(){
        $categories=Category::All();
        return view('dashboard.Categories.index',compact('categories'));
    }
}
