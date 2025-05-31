<?php

namespace App\Http\Controllers;

use App\Models\FarmProduct;
use App\Models\FarmProductCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class FarmProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        return view("farm-products.index")->with([
            'products' => FarmProduct::where('farmer_id', $request->user()->id)->orderBy('name')->paginate(1)
        ]);
    }

    public function all_categories(Request $request): View
    {
        return view("farm-products.categories")->with([
            'categories' => FarmProductCategory::where('farmer_id', $request->user()->id)->orderBy('name')->paginate(10)
        ]);
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        return view("farm-products.create")->with([
            'categories' => FarmProductCategory::where('farmer_id', $request->user()->id)->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function create_category(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'farmer_id' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
        ]);

        // Update other fields
        $category = FarmProductCategory::create($validated);
        return redirect()->back()->with('success', 'Product Category created successfully!');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'farmer_id' => 'required|string|max:255',
            'category_id' => 'required|exists:farm_product_categories,id',
            'description' => 'nullable|string|max:255',
            'unit_of_measurement' => 'required|string|max:255',
            'unit_price' => 'required|string|max:20',
            'selling_price' => 'nullable|string|max:255',
            'total_stock' => 'nullable|string|max:255',
            'tags' => 'nullable|string|max:100',
            'status' => 'required|string|max:100',
            'product_image' => 'nullable|image|mimes:jpeg,png,jpg,avif|max:2048',
        ]);



        // Handle file upload
        if ($request->hasFile('product_image')) {
            $image = $request->file('product_image');
            $filename = time() . '_' . $image->getClientOriginalName();
            $path = $image->storeAs('/', $filename, 'product_images');

            $validated['product_image'] = $path;
        }

        // Update other fields
        $product = FarmProduct::create($validated);
        return redirect()->route('farm-products.show', $product)->with('success', 'Product created successfully!');
    }


    /**
     * Display the specified resource.
     */
    public function show(Request $request, FarmProduct $farmProduct): View
    {
        return view("farm-products.view")->with([
            'categories' => FarmProductCategory::where('farmer_id', $request->user()->id)->get(),
            'product' => $farmProduct,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, FarmProduct $farmProduct)
    {
        return view("farm-products.update")->with([
            'categories' => FarmProductCategory::where('farmer_id', $request->user()->id)->get(),
            'product' => $farmProduct,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FarmProduct $farmProduct)
    {

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'farmer_id' => 'required|string|max:255',
            'category_id' => 'required|exists:farm_product_categories,id',
            'description' => 'nullable|string|max:255',
            'unit_of_measurement' => 'required|string|max:255',
            'unit_price' => 'required|string|max:20',
            'selling_price' => 'nullable|string|max:255',
            'total_stock' => 'nullable|string|max:255',
            'tags' => 'nullable|string|max:100',
            'status' => 'required|string|max:100',
            'product_image' => 'nullable|image|mimes:jpeg,png,jpg,avif|max:2048',
        ]);

        // Handle file upload
        if ($request->hasFile('product_image')) {
            $image = $request->file('product_image');
            $filename = time() . '_' . $image->getClientOriginalName();
            $path = $image->storeAs('/', $filename, 'product_images');

            // Optional: delete old image
            if ($farmProduct->product_image && Storage::disk('product_images')->exists($farmProduct->product_image)) {
                Storage::disk('product_images')->delete($farmProduct->product_image);
            }

            $validated['product_image'] = $path;
        }



        // Update other fields
        $farmProduct->fill($validated);
        $farmProduct->save();
        return redirect()->back()->with('success', 'Product updated successfully!');
    }
    public function update_category(Request $request, FarmProductCategory $category): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
        ]);

        // Update other fields
        $category->update($validated);
        return redirect()->back()->with('success', 'Product Category updated successfully!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FarmProduct $farmProduct)
    {
        $farmProduct->delete();
        return redirect()->route('farm-products.index')->with('success', 'Product deleted successfully!');
    }

    public function destroy_category(FarmProductCategory $category)
    {
        $category->delete();
        return redirect()->route('farm-products.index')->with('success', 'Category deleted successfully!');
    }
}
