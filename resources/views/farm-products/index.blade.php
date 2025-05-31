@extends('layouts.app')

@section('header')
    <h2 class="">
        Farm Products
    </h2>
    <p>
        Add and manage your farm products
    </p>
@endsection
@section('styles')
    {{-- <link rel="stylesheet" href="{{ asset('assets/css/product.css') }}?{{ time() }}" /> --}}
    <style>
        .product-page {
            /* display: flex;
                                                          flex-wrap: wrap;
                                                          gap: 28px; */
            /* width: 100%; */
            max-width: 800px;
            padding: 12px;
            margin: auto;
        }

        /* Product Section */
        .product-section {
            max-width: 800px;
            padding: 12px;
            margin: auto;
            background-color: #fefefe;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }



        .product-list {
            display: grid;
            grid-template-columns: 1fr;
            gap: 20px;
        }

        .product-card {
            display: flex;
            gap: 20px;
            background-color: #3e8e41;
            border-radius: 8px;
            overflow: hidden;
            padding: 15px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .product-card img {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border-radius: 6px;
        }

        .product-info {
            flex: 1;
            color: white;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .product-info h3 {
            font-size: 22px;
            margin-bottom: 10px;
        }

        .product-info p {
            font-size: 15px;
            margin-bottom: 6px;
        }

        .actions {
            margin-top: 10px;
        }

        button {
            padding: 8px 14px;
            border: none;
            border-radius: 4px;
            margin-right: 10px;
            cursor: pointer;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }

        .edit-btn {
            padding: 8px 14px;
            border: none;
            border-radius: 4px;
            margin-right: 10px;
            cursor: pointer;
            font-weight: bold;
            transition: background-color 0.3s ease;
            background-color: white;
            color: #4caf50;
        }

        .edit-btn:hover {
            background-color: #e0f2e9;
        }

        .delete-btn {
            padding: 8px 14px;
            border: none;
            border-radius: 4px;
            margin-right: 10px;
            cursor: pointer;
            font-weight: bold;
            transition: background-color 0.3s ease;
            background-color: white;
            background-color: red;
            color: white;
        }

        .delete-btn:hover {
            background-color: #cc0000;
        }

        @media (max-width: 600px) {
            .product-card {
                flex-direction: column;
                align-items: center;
                text-align: center;
            }

            .product-card img {
                width: 100%;
                height: auto;
            }

            .product-info {
                align-items: center;
            }
        }
    </style>
@endsection


@section('content')
    <section class="product-section">
        <h2 style="margin-bottom: 15px;">My Cash Crop Products</h2>

        <div class="product-list">
            @forelse ($products as $product)
                <div class="product-card">
                    <img src="{{ old('product_image') ? asset('product_image/' . old('product_image')) : asset('product_images/' . $product->product_image) }}"
                        alt="{{ $product->name }}" />

                    <div class="product-info">
                        <h3>{{ $product->name }}</h3>

                        <p>
                            Price: ₦{{ number_format($product->unit_price) }} /
                            @if (in_array($product->unit_of_measurement, ['kg', 'liter', 'dozen']))
                                {{ $product->unit_of_measurement }}
                            @else
                                64kg per {{ $product->unit_of_measurement }}
                            @endif
                        </p>

                        <p>Available: {{ number_format($product->total_stock) }}
                            {{ $product->unit_of_measurement }}{{ $product->total_stock > 1 ? 's' : '' }}</p>

                        <div class="actions">
                            <a href="{{ route('farm-products.show', $product->id) }}" class="edit-btn"
                                style="text-decoration: none;">View</a>
                            <a href="{{ route('farm-products.edit', $product->id) }}" class="edit-btn"
                                style="text-decoration: none;">Edit</a>

                            <form action="{{ route('farm-products.destroy', $product->id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="delete-btn"
                                    onclick="return confirm('Are you sure you want to delete this product?');">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <p>No products found. Start by adding a new product.</p>
            @endforelse
        </div>

        <!-- Pagination Controls -->
        <div style="margin-top: 20px; text-align: right;">
            {{ $products->links('vendor.pagination.custom') }}
        </div>
    </section>
@endsection
