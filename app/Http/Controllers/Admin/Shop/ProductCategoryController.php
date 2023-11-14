<?php

namespace App\Http\Controllers\Admin\Shop;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

use function PHPUnit\Framework\isEmpty;

class ProductCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $productCategories = ProductCategory::all();

        return view('admin.shop.productCategories', compact('productCategories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:product_categories',

        ]);


        if ($validator->fails()) {
            return back()->with('error', 'Something went wrong, try again!!');
        };

        $validatedData = $validator->validated();

        //Checks and validated file
        $file = $request->file('file');

        if (!empty($file)) {
            $extension = $file->getClientOriginalExtension(); // Get file extension
            $filename = Str::slug($request->name) . "." . $extension;
        } else {
            $filename = null; // No file provided
        }

        $extention = $request->file->extension();
        $filename = Str::slug($request->name) . "." . $extention;

        $productCategory = new ProductCategory;
        $productCategory->name = $validatedData['name'];
        $productCategory->slug = Str::slug($request->name);
        $productCategory->desc = $request->desc;
        $productCategory->image = $filename;


        $saved = $productCategory->save();

        if ($saved && $file) {
            $file->move(public_path('images/productCategories'), $filename);
        }

        return back()->with('success', 'Product Category has been created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Find the product category by its ID
        $productCategory = ProductCategory::find($id);

        $products = Product::where('product_category_id', $id)->get();

        if (!$productCategory) {
            // Handle the case where the category is not found, e.g., show an error message or redirect.
            return back()->with('error', 'Category not found');
        }

        // Load a view to display the category details and pass the category variable
        return view('admin.shop.productCategoryDetail', compact('productCategory', 'products'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProductCategory $productCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Find the product category by its ID
        $productCategory = ProductCategory::find($id);

        if (!$productCategory) {
            // Handle the case where the category is not found, e.g., show an error message or redirect.
            return back()->with('error', 'Category not found');
        }

        // Validation for updated data
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:product_categories,name,' . $id,
            'slug' => 'required|string',
            'desc' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->with('error', 'Validation failed, please check your input.');
        }

        // Update the category with the validated data
        $productCategory->name = $request->input('name');
        $productCategory->slug = $request->input('slug');
        $productCategory->desc = $request->input('desc');

        // Update the 'img' attribute if a new file is provided
        if ($request->hasFile('img')) {
            $file = $request->file('img');
            $extension = $file->getClientOriginalExtension();
            $filename = Str::slug($request->name) . "." . $extension;
            $file->move(public_path('images/productCategories'), $filename);
            $productCategory->img = $filename;
        }

        // Save the updated category
        $productCategory->save();

        return back()->with('success', 'Category updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Find the product category by its ID
        $productCategory = ProductCategory::find($id);

        if (!$productCategory) {
            // Handle the case where the category is not found, e.g., show an error message or redirect.
            return back()->with('error', 'Category not found');
        }

        $products = Product::where('product_category_id', $id)->get();

        if ($products) {

            foreach ($products as $product){
                $product->delete();
            }
        }


        // Delete the category
        $productCategory->delete();

        return back()->with('success', 'Category and Category products deleted successfully');
    }
}
