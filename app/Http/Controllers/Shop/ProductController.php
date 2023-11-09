<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Models\Product;
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

        return view('admin.shop.products', compact('products'));
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
            'main_image' => 'required|string',
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
        $product->name = $request->input('name');
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
