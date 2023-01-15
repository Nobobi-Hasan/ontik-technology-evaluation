<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
  

    public function index(Request $request)
    {
        $categories = Category::select(['id', 'title'])->get();
        $subcategories = Subcategory::select(['id', 'title'])->get();

        $my_query=Product::query();
        foreach ($request->query() as $key=>$value)
        {
            if($key == 'subcategory_id' && $value !=- 1)
                $my_query->where($key,$value);

            if($key == 'category_id' && $value !=- 1)
            $my_query->with(['subcategory'])
                ->whereHas('subcategory',function($q) use ($key,$value) {
                    $q->where($key,$value);
                });

            if($key == 'price_l' && $value != null)
                $my_query->where('price','>=',$value);

            if($key == 'price_h' && $value != null)
                $my_query->where('price','<=',$value);
        }

        
        $products= $my_query->get();


        return view('home', compact('products', 'subcategories', 'categories'));
    }

}
