<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

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

    
    public function create()
    {
        $subcategories = Subcategory::select(['id', 'title'])->get();
        return view('products.create', compact('subcategories'));
    }

    public function store(ProductRequest $request)
    {
        $product = Product::create([
            'title' => $request->title,
            'description' => $request->description,
            'subcategory_id' => $request->subcategory_id,
            'price' => $request->price,
        ]);

        $this->image_upload($request, $product->id);

        Toastr::success('Product created!');
        return back();
    }

    public function image_upload($request, $product_id)
    {
        if($request->hasFile('thumbnail')){

            $photo_location = 'public/uploads/product-image/';
            $uploaded_photo = $request->file('thumbnail');
            $photo_name = $product_id.'.'.$uploaded_photo->getClientOriginalExtension();
            $new_photo_location = $photo_location.$photo_name;
            Image::make($uploaded_photo)->resize(300,300)->save(base_path($new_photo_location));

            $product = Product::find($product_id);
            $product->update([
                'thumbnail' => $photo_name
            ]);
            
        }else{
            return back();
        }
    }


    public function destroy($id)
    {
        $product = Product::find($id);
        if($product->thumbnail != "default_product.jpg"){
            $photo_location = 'uploads/product-image/'.$product->thumbnail;
            unlink($photo_location);

        }
        $product->delete();

        Toastr::success('Data Deleted Successfully!');
        return redirect()->route('home');

    }
}
