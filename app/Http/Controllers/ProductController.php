<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Request;
use Inertia\Inertia;
use App\Models\Category;
use App\Models\Product;


class ProductController extends Controller
{

    public function index(){
        return Inertia::render('Products/Index', [
            'products' => Product::query()->when(
                Request::input('search'), function($query, $search){
                    $query->where('name','like', "%{$search}%");
                })->orderBy('category', 'asc')->paginate(10)->withQueryString()->through(fn($product) => [
                'pid' => $product->id,
                'pname' => $product->name,
                'pcategory' => $product->categories->name,
                'pdescription' => strip_tags($product->description)
            ]),
            'filter' => Request::only(['search'])
        ]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return Inertia::render('Products/Create', [
            'categories' => Category::all()->map(fn($category) => [
                'cid' => $category->id,
                'cname' => $category->name
            ])
        ]);
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        //
        $attributes = $request->validate([
            'name' => 'required',
            'category' => 'required',
            'description' => 'required'
        ]);
        $products = Product::create($attributes);
        if($products){
            return redirect('/images/show/'.$products->id);
        }
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
        
        $products = Product::where('id', $id)->get();
        if($products){
            return Inertia::render('Products/Update', [
                'products' => $products->map(fn($product) => [
                    'pid' => $product->id,
                    'pname' => $product->name,
                    'pcategory' => $product->categories->id,
                    'pdescription' => $product->description
                ]),
                'categories' => Category::all()->map(fn($category) => [
                    'cid' => $category->id,
                    'cname' => $category->name
                ])
            ]);
        }else{
            return abort(404);
        }
  
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
