<?php

namespace App\Http\Controllers\Admin\Shop;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();

        $product_categories = ProductCategory::all();

        return view('admin.shop.products', compact('products', 'product_categories'));
    }
    public function show($id){
        $product = Product::find($id);

        return view('admin.shop.productDetail', compact('product'));
    }

    public function upload(Request $request, $productId) {

        // dd($request);
        $validatedData = $request->validate([
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Example: Image type and size validation
        ], [
            'images.*.image' => 'The file must be an image.',
            'images.*.mimes' => 'Only jpeg, png, jpg, and gif images are allowed.',
            'images.*.max' => 'The image may not be greater than 2MB.',
        ]);


        if($request->hasFile('images')) {
            foreach($request->file('images') as $image) {
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('images/products'), $imageName);

                // Store image paths in the product_images table
                $product_image = new ProductImage;
                $product_image->product_id = $productId;
                $product_image->image_path = 'images/products/' . $imageName;

                $product_image->save();

            }
            return back()->with('success', 'Product updated successfully');
        } else {
            return back()->with('error', 'No image was updated');
        }
    }

    public function deleteImage($id){

        $image = ProductImage::find($id);

        $deleted = $image->delete();

        if ($deleted) {
            // Remove the image from the filesystem
            $filePath = public_path($image->image_path);
            if (file_exists($filePath)) {
                unlink($filePath);
            }

            return response()->json(['message' => 'Image deleted successfully']);
        } else {
            return response()->json(['error' => 'Unable to delete the image'], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:products',
            'short_desc' => 'required|string',
            'long_desc' => 'required|string',
            'price' => 'required|integer',
            'discount_price' => 'integer|nullable',
            'main_image' => 'required',
        ]);


        if ($validator->fails()) {
            return back()
                ->withInput() // Send back the old input
                ->with('errors', $validator->messages()->all()); // Send back the validation errors
        }

        //Checks and validated file
        $main_image = $request->file('main_image');

        if (!empty($main_image)) {
            $extension = $main_image->getClientOriginalExtension(); // Get file extension
            $main_image_name = Str::slug($request->name) . "." . $extension;
        } else {
            $main_image_name = null; // No file provided
        }


        // Create a new Product instance and set its attributes
        $product = new Product();
        $product->uuid = Str::uuid();
        $product->product_category_id = $request->input('product_category_id');
        $product->name = $request->input('name');
        $product->slug = Str::slug($request->name);
        $product->short_desc = $request->input('short_desc');
        $product->long_desc = $request->input('long_desc');
        $product->price = $request->input('price');
        $product->discount_price = $request->input('discount_price');
        $product->main_image = $main_image_name;

        // Save the product to the database
        $saved = $product->save();


        if ($saved && $main_image) {
            $main_image->move(public_path('images/products'), $main_image_name);
        }

        return back()->with('success', 'Product has been created successfully');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Find the product by its ID
        $product = Product::find($id);

        if (!$product) {
            return back()
                ->with('error', 'Product not found');
        }

        // Validate the request data for updating
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:products,name,' . $id,
            'short_desc' => 'required|string',
            'long_desc' => 'required|string',
            'price' => 'required|integer',
            'discount_price' => 'integer|nullable',
        ]);

        if ($validator->fails()) {
            return back()
                ->withInput()
                ->with('errors', $validator->messages()->all());
        }

        // Process the main_image update if a new file is provided
        $main_image_name = $product->main_image;

        $main_image = $request->file('main_image');
        if (!empty($main_image)) {
            $extension = $main_image->getClientOriginalExtension();
            $main_image_name = Str::slug($request->name) . "." . $extension;
        }

        // Update the product attributes
        $product->name = $request->input('name');
        $product->short_desc = $request->input('short_desc');
        $product->long_desc = $request->input('long_desc');
        $product->price = $request->input('price');
        $product->discount_price = $request->input('discount_price');
        $product->main_image = $main_image_name;

        // Save the updated product
        $saved = $product->save();

        if ($saved && $main_image) {
            $main_image->move(public_path('images/products'), $main_image_name);
        }

        return back()->with('success', 'Product updated successfully');
    }


    public function softDelete(Request $request, $id)
    {
        // Find the product by its ID
        $product = Product::find($id);

        if (!$product) {
            return back()
                ->with('error', 'Product not found');
        }

        // Soft delete the product
        $product->delete();

        return back()->with('success', 'Product sent to recycle bin successfully');
    }

    public function restore(Request $request, $id)
    {
        // Find the soft-deleted product by its ID
        $product = Product::onlyTrashed()->find($id);

        if (!$product) {
            return back()
                ->with('error', 'not found in the recycle bin');
        }

        // Restore the soft-deleted product
        $product->restore();

        return back()->with('success', 'Product restored successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        // Find the soft-deleted product by its ID
        $product = Product::onlyTrashed()->find($id);

        if (!$product) {
            return back()
                ->with('error', 'Soft-deleted product not found');
        }

        // Permanently delete the soft-deleted product
        $product->forceDelete();

        return back()->with('success', 'Product permanently deleted successfully');
    }
}
