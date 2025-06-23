@extends('layouts.app')

@section('header')
    <h2>Update Farm Product</h2>
    <p>Edit your product details below</p>
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/product.css') }}?{{ time() }}" />
@endsection


@section('content')
    <section class="product-form-section" style="margin: auto; max-width: 875px;">

        {{-- Validation Errors --}}
        @if ($errors->any())
            <div class="alert alert-error"
                style="
                max-width: 900px; 
                margin: 10px auto 30px;
                padding: 12px 18px; 
                border-radius: 4px; 
                font-weight: 600;
                color: #b71c1c;
                background-color: #f8d7da;
                border: 1px solid #f5c6cb;
            ">
                <strong>There were some problems with your input:</strong>
                <ul style="margin-top: 8px; padding-left: 20px; list-style-type: disc;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form class="product-form" method="POST" action="{{ route('farm-products.update', $product->id) }}"
            enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            <input type="hidden" name="farmer_id" id="farmer_id" value="{{ Auth::user()->id }}" />

            <div style="display: flex; justify-content: space-between; gap: 32px;">
                <!-- Left Section (Form) -->
                <div style="flex: 1;">
                    <!-- Product Name -->
                    <div class="form-group" style="margin-top:20px;">
                        <label for="name">Product Name</label>
                        <input type="text" id="name" name="name" value="{{ old('name', $product->name) }}"
                            placeholder="e.g., Cocoa" required />
                    </div>

                    <!-- Category -->
                    <div class="form-group" style="margin-top:20px;">
                        <label for="category_id">Category</label>
                        <select id="category_id" name="category_id" required>
                            <option value="">Select a category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Unit of Measurement -->
                    <div class="form-group" style="margin-top:20px;">
                        <label for="unit_of_measurement">Unit of Measurement</label>
                        <select id="unit_of_measurement" name="unit_of_measurement" required>
                            <option value="">Select a unit</option>
                            <option value="kg"
                                {{ old('unit_of_measurement', $product->unit_of_measurement) == 'kg' ? 'selected' : '' }}>
                                Kilogram (kg)</option>
                            <option value="bag"
                                {{ old('unit_of_measurement', $product->unit_of_measurement) == 'bag' ? 'selected' : '' }}>
                                Bag</option>
                            <option value="liter"
                                {{ old('unit_of_measurement', $product->unit_of_measurement) == 'liter' ? 'selected' : '' }}>
                                Liter</option>
                            <option value="dozen"
                                {{ old('unit_of_measurement', $product->unit_of_measurement) == 'dozen' ? 'selected' : '' }}>
                                Dozen</option>
                        </select>
                    </div>

                    <div style="display: flex; gap:18px; align-items:center; margin-top:20px;">
                        <!-- Unit Price -->
                        <div class="form-group">
                            <label for="unit_price">Price per Unit (₦)</label>
                            <input type="number" id="unit_price" name="unit_price"
                                value="{{ old('unit_price', $product->unit_price) }}" placeholder="e.g., 250000"
                                required />
                        </div>

                        <!-- Selling Price -->
                        <div class="form-group">
                            <label for="selling_price">Selling Price (₦)</label>
                            <input type="number" id="selling_price" name="selling_price"
                                value="{{ old('selling_price', $product->selling_price) }}" placeholder="e.g., 300000" />
                        </div>

                        <!-- Total Stock -->
                        <div class="form-group">
                            <label for="total_stock">Total Units</label>
                            <input type="number" id="total_stock" name="total_stock"
                                value="{{ old('total_stock', $product->total_stock) }}" placeholder="e.g., 10" required />
                        </div>
                    </div>
                </div>

                <!-- Right Section (Image Upload) -->
                <div style="flex-shrink: 0; width: fit-content; text-align: center;">
                    <div class="form-group">
                        <label for="product_image">Product Image</label><br>

                        <div class="image-preview-wrapper"
                            style="border:1px solid #ccc; padding: 6px; border-radius: 4px; max-width: 250px; margin: auto;">
                            <img id="preview-image"
                                src="{{ old('product_image') ? asset('product_image/' . old('product_image')) : asset('product_images/' . $product->product_image) }}"
                                alt="Preview" style="max-width: 100%; height: auto; display: block; margin: 0 auto;" />
                        </div>

                        <!-- Hidden actual file input -->
                        <input type="file" id="product_image" name="product_image" accept="image/*"
                            onchange="previewFile()" style="display: none;" />

                        <!-- Custom button to trigger the file input -->
                        <button type="button" onclick="document.getElementById('product_image').click()" class="upload-btn"
                            style="margin-top: 12px;">
                            Choose Image
                        </button>
                    </div>
                </div>
            </div>

            <!-- Product Description -->
            <div class="form-group" style="margin-top:20px;">
                <label for="description">Product Description</label>
                <textarea id="description" name="description" placeholder="Describe the product" rows="4" required>{{ old('description', $product->description) }}</textarea>
            </div>

            <!-- Buttons -->
            <div style="margin-top: 24px;">
                <button type="submit" name="status" value="published" class="submit-btn">Update Product</button>
                <button type="submit" name="status" value="draft" class="submit-btn">Save as Draft</button>
            </div>
        </form>
    </section>
@endsection

@section('scripts')
    <script>
        function previewFile() {
            const preview = document.getElementById('preview-image');
            const file = document.getElementById('product_image').files[0];
            const reader = new FileReader();

            reader.onloadend = () => {
                preview.src = reader.result;
            };

            if (file) {
                reader.readAsDataURL(file);
            } else {
                // If no new file selected, keep current image (already shown)
            }
        }
    </script>
@endsection
