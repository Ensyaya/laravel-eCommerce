<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductCreateRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Models\Category;
use App\Models\Product;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $products = Product::latest();

        if (request()->get('title')) {
            $products = $products->where('title', 'LIKE', "%" . request()->get('title') . "%");
        }

        $products = $products->paginate(10);

        return view('admin/product/products', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin/product/create-product', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductCreateRequest $request)
    {
        if ($request->hasFile('image')) {

            $result = $request->file('image')->storeOnCloudinary('ecom-laravel/products');
            $imagePath = $result->getPath();
            $imageId = $result->getPublicId();
            $request->merge([
                'image' => $imagePath,
                'image_id' => $imageId
            ]);
        }
        if ($request->hasFile('image2')) {

            $result2 = $request->file('image2')->storeOnCloudinary('ecom-laravel/products');
            $imagePath2 = $result2->getPath();
            $imageId2 = $result2->getPublicId();
            $request->merge([
                'image2' => $imagePath2,
                'image_id2' => $imageId2
            ]);
        }
        if ($request->hasFile('image3')) {

            $result3 = $request->file('image3')->storeOnCloudinary('ecom-laravel/products');
            $imagePath3 = $result3->getPath();
            $imageId3 = $result3->getPublicId();
            $request->merge([
                'image3' => $imagePath3,
                'image_id3' => $imageId3
            ]);
        }
        Product::create($request->post());
        return redirect()->route('products.index')->withSuccess('Product successfully created');
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
        $product = Product::findOrFail($id);
        $categories = Category::all();
        return view("admin/product/update-product", compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductUpdateRequest $request, $id)
    {
        $product = Product::findOrFail($id);

        $this->updateImage($request, $product);

        $product->update($request->post());

        return redirect()->route('products.index')->withSuccess('Product successfully updated');
    }

    protected function updateImage(Request $request, $product)
    {
        if ($request->hasFile('image')) {
            if ($product->image_id) {
                $deleted = $product->image_id;
                Cloudinary::destroy($deleted);
            }

            $result = $request->file('image')->storeOnCloudinary('ecom-laravel/products');
            $imagePath = $result->getPath();
            $imageId = $result->getPublicId();
            $request->merge([
                'image' => $imagePath,
                'image_id' => $imageId
            ]);
        }
        if ($request->hasFile('image2')) {
            if ($product->image_id2) {
                $deleted = $product->image_id2;
                Cloudinary::destroy($deleted);
            }

            $result2 = $request->file('image2')->storeOnCloudinary('ecom-laravel/products');
            $imagePath2 = $result2->getPath();
            $imageId2 = $result2->getPublicId();
            $request->merge([
                'image2' => $imagePath2,
                'image_id2' => $imageId2
            ]);
        }
        if ($request->hasFile('image3')) {
            if ($product->image_id3) {
                $deleted = $product->image_id3;
                Cloudinary::destroy($deleted);
            }

            $result3 = $request->file('image3')->storeOnCloudinary('ecom-laravel/products');
            $imagePath3 = $result3->getPath();
            $imageId3 = $result3->getPublicId();
            $request->merge([
                'image3' => $imagePath3,
                'image_id3' => $imageId3
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        if ($product->image_id) {
            $deleted = $product->image_id;
            Cloudinary::destroy($deleted);
        }
        if ($product->image_id2) {
            $deleted = $product->image_id2;
            Cloudinary::destroy($deleted);
        }
        if ($product->image_id3) {
            $deleted = $product->image_id3;
            Cloudinary::destroy($deleted);
        }
        $product->delete($request->post());

        return redirect()->route('products.index')->withSuccess('Product successfully deleted');
    }
}
