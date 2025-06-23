@extends('layouts.app')

@section('header')
    <div class="create-product-header">
        <div class="header-navigation">
            <a href="{{ route('farm-products.index') }}" class="back-btn">
                <i class="fas fa-arrow-left"></i>
                Back to Products
            </a>
            <div class="breadcrumb">
                <span>Products</span>
                <i class="fas fa-chevron-right"></i>
                <span>Create New Product</span>
            </div>
        </div>
        <div class="header-content">
            <h2 class="page-title">
                <i class="fas fa-plus-circle"></i>
                Create New Farm Product
            </h2>
            <p class="page-subtitle" style="color: white">Add your farm produce to reach more customers</p>
        </div>
    </div>
@endsection

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .create-product-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 20px;
        }

        .create-product-header {
            background: linear-gradient(135deg, #2E7D32 0%, #4CAF50 100%);
            color: white;
            padding: 30px;
            border-radius: 0px;
            margin-bottom: 30px;
            box-shadow: 0 8px 32px rgba(46, 125, 50, 0.3);
        }

        .header-navigation {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .back-btn {
            color: white;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 8px 16px;
            border-radius: 8px;
            background: rgba(255, 255, 255, 0.1);
            transition: all 0.3s ease;
        }

        .back-btn:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateX(-3px);
        }

        .breadcrumb {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 0.9rem;
            opacity: 0.8;
        }

        .header-content {
            text-align: center;
        }

        .page-title {
            font-size: 2.2rem;
            font-weight: 700;
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 15px;
        }

        .page-subtitle {
            font-size: 1.1rem;
            opacity: 0.9;
            font-weight: 300;
        }

        /* Form Container */
        .form-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 300px;
            gap: 40px;
            align-items: start;
        }

        .form-section {
            display: flex;
            flex-direction: column;
            gap: 25px;
        }

        .section-title {
            font-size: 1.3rem;
            font-weight: 600;
            color: #2E7D32;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .form-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .form-label {
            font-weight: 600;
            color: #2E7D32;
            font-size: 0.95rem;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .required {
            color: #f44336;
        }

        .form-input,
        .form-select,
        .form-textarea {
            padding: 14px 16px;
            border: 2px solid rgba(76, 175, 80, 0.2);
            border-radius: 12px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: white;
            font-family: inherit;
        }

        .form-input:focus,
        .form-select:focus,
        .form-textarea:focus {
            outline: none;
            border-color: #4CAF50;
            box-shadow: 0 0 0 3px rgba(76, 175, 80, 0.1);
        }

        .form-input:hover,
        .form-select:hover,
        .form-textarea:hover {
            border-color: rgba(76, 175, 80, 0.4);
        }

        .form-textarea {
            resize: vertical;
            min-height: 120px;
        }

        /* Image Upload Section */
        .image-upload-section {
            background: rgba(76, 175, 80, 0.05);
            border-radius: 16px;
            padding: 30px;
            text-align: center;
            border: 2px dashed rgba(76, 175, 80, 0.3);
            transition: all 0.3s ease;
            position: sticky;
            top: 120px;
        }

        .image-upload-section:hover {
            border-color: #4CAF50;
            background: rgba(76, 175, 80, 0.1);
        }

        .image-preview-wrapper {
            width: 200px;
            height: 200px;
            border-radius: 16px;
            overflow: hidden;
            margin: 0 auto 20px;
            background: rgba(255, 255, 255, 0.8);
            display: flex;
            align-items: center;
            justify-content: center;
            border: 2px solid rgba(76, 175, 80, 0.2);
            transition: all 0.3s ease;
        }

        .image-preview-wrapper:hover {
            border-color: #4CAF50;
            box-shadow: 0 4px 12px rgba(76, 175, 80, 0.2);
        }

        .preview-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: none;
        }

        .preview-placeholder {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 10px;
            color: #4CAF50;
        }

        .preview-placeholder i {
            font-size: 3rem;
            opacity: 0.5;
        }

        .upload-btn {
            background: linear-gradient(135deg, #4CAF50, #81C784);
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 12px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 8px;
            margin: 0 auto;
        }

        .upload-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(76, 175, 80, 0.3);
        }

        .upload-info {
            margin-top: 15px;
            font-size: 0.85rem;
            color: #666;
            line-height: 1.4;
        }

        /* Pricing Section */
        .pricing-section {
            background: rgba(76, 175, 80, 0.05);
            border-radius: 12px;
            padding: 20px;
            border-left: 4px solid #4CAF50;
        }

        .pricing-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 15px;
        }

        .price-input-group {
            position: relative;
        }

        .currency-symbol {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: #4CAF50;
            font-weight: 600;
            font-size: 1.1rem;
        }

        .price-input {
            padding-left: 40px;
        }

        /* Action Buttons */
        .form-actions {
            display: flex;
            gap: 15px;
            justify-content: center;
            margin-top: 30px;
            padding-top: 30px;
            border-top: 2px solid rgba(76, 175, 80, 0.1);
        }

        .btn {
            padding: 14px 32px;
            border: none;
            border-radius: 12px;
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
        }

        .btn-primary {
            background: linear-gradient(135deg, #4CAF50, #81C784);
            color: white;
        }

        .btn-secondary {
            background: rgba(76, 175, 80, 0.1);
            color: #2E7D32;
            border: 2px solid rgba(76, 175, 80, 0.3);
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .btn:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none;
        }

        /* Validation Styles */
        .form-input.error,
        .form-select.error,
        .form-textarea.error {
            border-color: #f44336;
            background: rgba(244, 67, 54, 0.05);
        }

        .error-message {
            color: #f44336;
            font-size: 0.85rem;
            margin-top: 4px;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        /* Success Message */
        .success-message {
            background: rgba(76, 175, 80, 0.1);
            color: #2E7D32;
            padding: 15px 20px;
            border-radius: 12px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
            border-left: 4px solid #4CAF50;
        }

        /* Loading State */
        .loading {
            position: relative;
            opacity: 0.7;
        }

        .loading::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 20px;
            height: 20px;
            margin: -10px 0 0 -10px;
            border: 2px solid #4CAF50;
            border-top: 2px solid transparent;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        /* Responsive Design */
        @media (max-width: 1024px) {
            .form-grid {
                grid-template-columns: 1fr;
                gap: 30px;
            }

            .image-upload-section {
                position: static;
            }
        }

        @media (max-width: 768px) {
            .create-product-container {
                padding: 15px;
            }

            .create-product-header {
                padding: 20px;
            }

            .page-title {
                font-size: 1.8rem;
                flex-direction: column;
                gap: 10px;
            }

            .form-container {
                padding: 25px;
            }

            .form-row {
                grid-template-columns: 1fr;
            }

            .pricing-grid {
                grid-template-columns: 1fr;
            }

            .form-actions {
                flex-direction: column;
                align-items: stretch;
            }

            .btn {
                justify-content: center;
            }
        }

        @media (max-width: 480px) {
            .header-navigation {
                flex-direction: column;
                gap: 10px;
                align-items: flex-start;
            }

            .breadcrumb {
                order: -1;
            }

            .image-preview-wrapper {
                width: 150px;
                height: 150px;
            }
        }

        /* Animation Classes */
        .fade-in {
            animation: fadeIn 0.6s ease;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Tooltip */
        .tooltip {
            position: relative;
            cursor: help;
        }

        .tooltip::after {
            content: attr(data-tooltip);
            position: absolute;
            bottom: 125%;
            left: 50%;
            transform: translateX(-50%);
            background: #2E7D32;
            color: white;
            padding: 8px 12px;
            border-radius: 6px;
            font-size: 0.8rem;
            white-space: nowrap;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.3s;
            z-index: 1000;
        }


        .tooltip:hover::after {
            opacity: 1;
            visibility: visible;
        }

        /* Helper Text */
        .helper-text {
            font-size: 0.85rem;
            color: #666;
            margin-top: 4px;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        /* Progress Indicator */
        .progress-indicator {
            display: flex;
            justify-content: center;
            margin-bottom: 30px;
        }

        .progress-step {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: rgba(76, 175, 80, 0.2);
            color: #4CAF50;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            position: relative;
        }

        .progress-step.active {
            background: #4CAF50;
            color: white;
        }

        .progress-step::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 100%;
            width: 60px;
            height: 2px;
            background: rgba(76, 175, 80, 0.2);
            transform: translateY(-50%);
        }

        .progress-step:last-child::after {
            display: none;
        }

        .progress-step.completed::after {
            background: #4CAF50;
        }
    </style>
    <style>
        /* Additional animation styles */
        @keyframes slideInRight {
            from {
                transform: translateX(100%);
                opacity: 0;
            }

            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        /* Improved button styles */
        .btn-sm {
            padding: 8px 16px;
            font-size: 0.85rem;
        }

        .btn-info {
            background: linear-gradient(135deg, #2196F3, #64B5F6);
            color: white;
        }

        /* Enhanced form validation styles */
        .form-input:valid,
        .form-select:valid,
        .form-textarea:valid {
            border-color: rgba(76, 175, 80, 0.5);
        }

        .form-input:invalid:not(:focus),
        .form-select:invalid:not(:focus),
        .form-textarea:invalid:not(:focus) {
            border-color: rgba(244, 67, 54, 0.3);
        }

        /* Progress step animations */
        .progress-step {
            transition: all 0.3s ease;
        }

        .progress-step.completed {
            background: #4CAF50;
            color: white;
            transform: scale(1.1);
        }

        .progress-step.active {
            background: #4CAF50;
            color: white;
            box-shadow: 0 4px 12px rgba(76, 175, 80, 0.3);
        }

        /* Smart suggestions */
        .price-suggestion {
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            background: white;
            border: 2px solid #4CAF50;
            border-radius: 8px;
            padding: 10px;
            margin-top: 4px;
            font-size: 0.9rem;
            color: #2E7D32;
            box-shadow: 0 4px 12px rgba(76, 175, 80, 0.2);
            z-index: 10;
        }

        /* Drag and drop styles */
        .image-upload-section.drag-over {
            border-color: #4CAF50 !important;
            background: rgba(76, 175, 80, 0.15) !important;
            transform: scale(1.02);
        }
    </style>
@endsection

@section('content')
    <div class="create-product-container">
        @if (session('success'))
            <div class="success-message fade-in">
                <i class="fas fa-check-circle"></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        @if ($errors->any())
            <div class="error-message fade-in"
                style="background: rgba(244, 67, 54, 0.1); color: #c62828; padding: 15px 20px; border-radius: 12px; margin-bottom: 20px; border-left: 4px solid #f44336;">
                <i class="fas fa-exclamation-triangle"></i>
                <div>
                    <strong>Please fix the following errors:</strong>
                    <ul style="margin: 8px 0 0 20px;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        <!-- Progress Indicator -->
        <div class="progress-indicator">
            <div class="progress-step active" data-tooltip="Product Details">
                <i class="fas fa-info-circle"></i>
            </div>
            <div class="progress-step" data-tooltip="Pricing & Stock">
                <i class="fas fa-dollar-sign"></i>
            </div>
            <div class="progress-step" data-tooltip="Images & Media">
                <i class="fas fa-camera"></i>
            </div>
            <div class="progress-step" data-tooltip="Review & Publish">
                <i class="fas fa-check"></i>
            </div>
        </div>

        <div class="form-container fade-in">
            <form id="productForm" method="POST" action="{{ route('farm-products.store') }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="farmer_id" value="{{ Auth::user()->id }}" />
                <input type="hidden" name="status" value="published" />
                <div class="form-grid">
                    <!-- Left Section - Form Fields -->
                    <div class="form-section">
                        <!-- Basic Information -->
                        <div>
                            <h3 class="section-title">
                                <i class="fas fa-info-circle"></i>
                                Basic Information
                            </h3>

                            <div class="form-group">
                                <label for="name" class="form-label">
                                    <i class="fas fa-tag"></i>
                                    Product Name
                                    <span class="required">*</span>
                                </label>
                                <input type="text" id="name" name="name"
                                    class="form-input {{ $errors->has('name') ? 'error' : '' }}" value="{{ old('name') }}"
                                    placeholder="e.g., Fresh Organic Tomatoes" required />
                                @if ($errors->has('name'))
                                    <div class="error-message">
                                        <i class="fas fa-exclamation-circle"></i>
                                        {{ $errors->first('name') }}
                                    </div>
                                @endif
                                <div class="helper-text">
                                    <i class="fas fa-lightbulb"></i>
                                    Choose a descriptive name that buyers will easily recognize
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label for="category_id" class="form-label">
                                        <i class="fas fa-list"></i>
                                        Category
                                        <span class="required">*</span>
                                    </label>
                                    <select id="category_id" name="category_id"
                                        class="form-select {{ $errors->has('category_id') ? 'error' : '' }}" required>
                                        <option value="">Select a category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"
                                                {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('category_id'))
                                        <div class="error-message">
                                            <i class="fas fa-exclamation-circle"></i>
                                            {{ $errors->first('category_id') }}
                                        </div>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="unit_of_measurement" class="form-label">
                                        <i class="fas fa-balance-scale"></i>
                                        Unit of Measurement
                                        <span class="required">*</span>
                                    </label>
                                    <select id="unit_of_measurement" name="unit_of_measurement"
                                        class="form-select {{ $errors->has('unit_of_measurement') ? 'error' : '' }}"
                                        required>
                                        <option value="">Select a unit</option>
                                        <option value="kg" {{ old('unit_of_measurement') == 'kg' ? 'selected' : '' }}>
                                            Kilogram (kg)</option>
                                        <option value="bag" {{ old('unit_of_measurement') == 'bag' ? 'selected' : '' }}>
                                            Bag</option>
                                        <option value="liter"
                                            {{ old('unit_of_measurement') == 'liter' ? 'selected' : '' }}>Liter</option>
                                        <option value="dozen"
                                            {{ old('unit_of_measurement') == 'dozen' ? 'selected' : '' }}>Dozen</option>
                                        <option value="piece"
                                            {{ old('unit_of_measurement') == 'piece' ? 'selected' : '' }}>Piece</option>
                                        <option value="bundle"
                                            {{ old('unit_of_measurement') == 'bundle' ? 'selected' : '' }}>Bundle</option>
                                    </select>
                                    @if ($errors->has('unit_of_measurement'))
                                        <div class="error-message">
                                            <i class="fas fa-exclamation-circle"></i>
                                            {{ $errors->first('unit_of_measurement') }}
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="description" class="form-label">
                                    <i class="fas fa-align-left"></i>
                                    Product Description
                                    <span class="required">*</span>
                                </label>
                                <textarea id="description" name="description" class="form-textarea {{ $errors->has('description') ? 'error' : '' }}"
                                    placeholder="Describe your product in detail - quality, freshness, farming methods, etc." required>{{ old('description') }}</textarea>
                                @if ($errors->has('description'))
                                    <div class="error-message">
                                        <i class="fas fa-exclamation-circle"></i>
                                        {{ $errors->first('description') }}
                                    </div>
                                @endif
                                <div class="helper-text">
                                    <i class="fas fa-info-circle"></i>
                                    Include details about quality, freshness, and farming methods
                                </div>
                            </div>
                        </div>

                        <!-- Pricing & Stock -->
                        <div class="pricing-section">
                            <h3 class="section-title">
                                <i class="fas fa-money-bill-wave"></i>
                                Pricing & Stock Information
                            </h3>

                            <div class="pricing-grid">
                                <div class="form-group">
                                    <label for="unit_price" class="form-label">
                                        <i class="fas fa-tag"></i>
                                        Cost Price (₦)
                                        <span class="required">*</span>
                                        <i class="fas fa-question-circle tooltip"
                                            data-tooltip="Your actual cost per unit"></i>
                                    </label>
                                    <div class="price-input-group">
                                        <span class="currency-symbol">₦</span>
                                        <input type="number" id="unit_price" name="unit_price"
                                            class="form-input price-input {{ $errors->has('unit_price') ? 'error' : '' }}"
                                            value="{{ old('unit_price') }}" placeholder="0.00" step="0.01"
                                            min="0" required />
                                    </div>
                                    @if ($errors->has('unit_price'))
                                        <div class="error-message">
                                            <i class="fas fa-exclamation-circle"></i>
                                            {{ $errors->first('unit_price') }}
                                        </div>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="selling_price" class="form-label">
                                        <i class="fas fa-dollar-sign"></i>
                                        Selling Price (₦)
                                        <i class="fas fa-question-circle tooltip"
                                            data-tooltip="Price you'll charge customers"></i>
                                    </label>
                                    <div class="price-input-group">
                                        <span class="currency-symbol">₦</span>
                                        <input type="number" id="selling_price" name="selling_price"
                                            class="form-input price-input {{ $errors->has('selling_price') ? 'error' : '' }}"
                                            value="{{ old('selling_price') }}" placeholder="0.00" step="0.01"
                                            min="0" />
                                    </div>
                                    @if ($errors->has('selling_price'))
                                        <div class="error-message">
                                            <i class="fas fa-exclamation-circle"></i>
                                            {{ $errors->first('selling_price') }}
                                        </div>
                                    @endif
                                    <div class="helper-text">
                                        <i class="fas fa-info-circle"></i>
                                        Leave empty to use cost price as selling price
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="total_stock" class="form-label">
                                        <i class="fas fa-boxes"></i>
                                        Available Stock
                                        <span class="required">*</span>
                                    </label>
                                    <input type="number" id="total_stock" name="total_stock"
                                        class="form-input {{ $errors->has('total_stock') ? 'error' : '' }}"
                                        value="{{ old('total_stock') }}" placeholder="0" min="0" required />
                                    @if ($errors->has('total_stock'))
                                        <div class="error-message">
                                            <i class="fas fa-exclamation-circle"></i>
                                            {{ $errors->first('total_stock') }}
                                        </div>
                                    @endif
                                    <div class="helper-text">
                                        <i class="fas fa-warehouse"></i>
                                        <span id="stock-unit">Number of units available for sale</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Profit Margin Calculator -->
                            <div id="profit-calculator"
                                style="margin-top: 20px; padding: 15px; background: rgba(76, 175, 80, 0.1); border-radius: 8px; display: none;">
                                <h4 style="color: #2E7D32; margin-bottom: 10px;">
                                    <i class="fas fa-calculator"></i>
                                    Profit Analysis
                                </h4>
                                <div
                                    style="display: grid; grid-template-columns: repeat(auto-fit, minmax(120px, 1fr)); gap: 15px; font-size: 0.9rem;">
                                    <div>
                                        <span style="color: #666;">Profit per unit:</span>
                                        <div style="font-weight: 600; color: #4CAF50;" id="profit-per-unit">₦0.00</div>
                                    </div>
                                    <div>
                                        <span style="color: #666;">Profit margin:</span>
                                        <div style="font-weight: 600; color: #4CAF50;" id="profit-margin">0%</div>
                                    </div>
                                    <div>
                                        <span style="color: #666;">Total potential profit:</span>
                                        <div style="font-weight: 600; color: #4CAF50;" id="total-profit">₦0.00</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Optional Fields -->
                        <div>
                            <h3 class="section-title">
                                <i class="fas fa-cog"></i>
                                Additional Options
                            </h3>

                            <div class="form-group">
                                <label for="tags" class="form-label">
                                    <i class="fas fa-tags"></i>
                                    Tags
                                    <i class="fas fa-question-circle tooltip"
                                        data-tooltip="Add keywords to help customers find your product"></i>
                                </label>
                                <input type="text" id="tags" name="tags"
                                    class="form-input {{ $errors->has('tags') ? 'error' : '' }}"
                                    value="{{ old('tags') }}" placeholder="organic, fresh, local, pesticide-free" />
                                @if ($errors->has('tags'))
                                    <div class="error-message">
                                        <i class="fas fa-exclamation-circle"></i>
                                        {{ $errors->first('tags') }}
                                    </div>
                                @endif
                                <div class="helper-text">
                                    <i class="fas fa-lightbulb"></i>
                                    Separate tags with commas (e.g., organic, fresh, local)
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right Section - Image Upload -->
                    <div class="image-upload-section">
                        <h3 class="section-title" style="margin-bottom: 20px;">
                            <i class="fas fa-camera"></i>
                            Product Image
                        </h3>

                        <div class="image-preview-wrapper">
                            <img id="preview-image" src="" alt="Preview" class="preview-image" />
                            <div class="preview-placeholder" id="preview-placeholder">
                                <i class="fas fa-image"></i>
                                <span>Click to upload image</span>
                            </div>
                        </div>

                        <input type="file" id="product_image" name="product_image" accept="image/*"
                            style="display: none;" />

                        <button type="button" onclick="document.getElementById('product_image').click()"
                            class="upload-btn">
                            <i class="fas fa-upload"></i>
                            Choose Image
                        </button>

                        <div class="upload-info">
                            <i class="fas fa-info-circle"></i>
                            <strong>Image Guidelines:</strong><br>
                            • Maximum size: 2MB<br>
                            • Formats: JPG, PNG, AVIF<br>
                            • Recommended: 800x600px<br>
                            • High-quality product photos sell better
                        </div>

                        @if ($errors->has('product_image'))
                            <div class="error-message" style="margin-top: 10px;">
                                <i class="fas fa-exclamation-circle"></i>
                                {{ $errors->first('product_image') }}
                            </div>
                        @endif

                        <!-- Image Enhancement Tools -->
                        <div id="image-tools" style="margin-top: 20px; display: none;">
                            <div style="display: flex; gap: 10px; justify-content: center;">
                                <button type="button" class="btn btn-secondary btn-sm" onclick="rotateImage()">
                                    <i class="fas fa-redo"></i>
                                    Rotate
                                </button>
                                <button type="button" class="btn btn-secondary btn-sm" onclick="removeImage()">
                                    <i class="fas fa-trash"></i>
                                    Remove
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="form-actions">
                    <button type="button" class="btn btn-secondary" onclick="saveDraft()">
                        <i class="fas fa-save"></i>
                        Save as Draft
                    </button>
                    <button type="submit" name="status" value="published" class="btn btn-primary" id="publish-btn">
                        <i class="fas fa-rocket"></i>
                        Publish Product
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Confirmation Modal -->
    <div class="modal" id="confirmModal"
        style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 1000; align-items: center; justify-content: center;">
        <div style="background: white; border-radius: 16px; padding: 30px; max-width: 400px; text-align: center;">
            <i class="fas fa-check-circle" style="font-size: 3rem; color: #4CAF50; margin-bottom: 20px;"></i>
            <h3 style="color: #2E7D32; margin-bottom: 15px;">Product Created Successfully!</h3>
            <p style="color: #666; margin-bottom: 25px;">Your product has been added to your farm catalog.</p>
            <div style="display: flex; gap: 10px; justify-content: center;">
                <button class="btn btn-secondary" onclick="createAnother()">
                    <i class="fas fa-plus"></i>
                    Add Another
                </button>
                <button class="btn btn-primary" onclick="viewProduct()">
                    <i class="fas fa-eye"></i>
                    View Product
                </button>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        // Global variables
        let rotationAngle = 0;
        let currentProductId = null;

        // Initialize page
        document.addEventListener('DOMContentLoaded', function() {
            initializeForm();
            updateStockUnit();
            calculateProfit();
        });

        // Initialize form functionality
        function initializeForm() {
            // Image upload handling
            const imageInput = document.getElementById('product_image');
            const previewImage = document.getElementById('preview-image');
            const previewPlaceholder = document.getElementById('preview-placeholder');
            const imageTools = document.getElementById('image-tools');

            imageInput.addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    // Validate file size
                    if (file.size > 2 * 1024 * 1024) { // 2MB
                        showNotification('Image size must be less than 2MB', 'error');
                        return;
                    }

                    // Validate file type
                    const allowedTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/avif'];
                    if (!allowedTypes.includes(file.type)) {
                        showNotification('Please select a valid image format (JPG, PNG, AVIF)', 'error');
                        return;
                    }

                    const reader = new FileReader();
                    reader.onload = function(e) {
                        previewImage.src = e.target.result;
                        previewImage.style.display = 'block';
                        previewPlaceholder.style.display = 'none';
                        imageTools.style.display = 'block';

                        // Animate the image appearance
                        previewImage.style.opacity = '0';
                        previewImage.style.transform = 'scale(0.8)';
                        setTimeout(() => {
                            previewImage.style.transition = 'all 0.3s ease';
                            previewImage.style.opacity = '1';
                            previewImage.style.transform = 'scale(1)';
                        }, 50);
                    };
                    reader.readAsDataURL(file);
                }
            });

            // Unit of measurement change handler
            document.getElementById('unit_of_measurement').addEventListener('change', updateStockUnit);

            // Price calculation handlers
            document.getElementById('unit_price').addEventListener('input', calculateProfit);
            document.getElementById('selling_price').addEventListener('input', calculateProfit);
            document.getElementById('total_stock').addEventListener('input', calculateProfit);

            // Form validation
            document.getElementById('productForm').addEventListener('submit', function(e) {
                if (!validateForm()) {
                    e.preventDefault();
                }
            });
        }

        // Update stock unit label
        function updateStockUnit() {
            const unitSelect = document.getElementById('unit_of_measurement');
            const stockUnit = document.getElementById('stock-unit');
            const selectedUnit = unitSelect.options[unitSelect.selectedIndex].text;

            if (selectedUnit && selectedUnit !== 'Select a unit') {
                stockUnit.textContent = `Number of ${selectedUnit.toLowerCase()}s available for sale`;
            } else {
                stockUnit.textContent = 'Number of units available for sale';
            }
        }

        // Calculate profit margins
        function calculateProfit() {
            const costPrice = parseFloat(document.getElementById('unit_price').value) || 0;
            const sellingPrice = parseFloat(document.getElementById('selling_price').value) || costPrice;
            const totalStock = parseFloat(document.getElementById('total_stock').value) || 0;

            const profitPerUnit = sellingPrice - costPrice;
            const profitMargin = sellingPrice > 0 ? (profitPerUnit / sellingPrice * 100) : 0;
            const totalProfit = profitPerUnit * totalStock;

            // Update display
            document.getElementById('profit-per-unit').textContent = `₦${profitPerUnit.toFixed(2)}`;
            document.getElementById('profit-margin').textContent = `${profitMargin.toFixed(1)}%`;
            document.getElementById('total-profit').textContent = `₦${totalProfit.toFixed(2)}`;

            // Show/hide calculator
            const calculator = document.getElementById('profit-calculator');
            if (costPrice > 0 || sellingPrice > 0) {
                calculator.style.display = 'block';
            } else {
                calculator.style.display = 'none';
            }

            // Color coding for profit margin
            const marginElement = document.getElementById('profit-margin');
            if (profitMargin < 10) {
                marginElement.style.color = '#f44336'; // Red for low margin
            } else if (profitMargin < 20) {
                marginElement.style.color = '#ff9800'; // Orange for medium margin
            } else {
                marginElement.style.color = '#4CAF50'; // Green for good margin
            }
        }

        // Image manipulation functions
        function rotateImage() {
            const previewImage = document.getElementById('preview-image');
            rotationAngle += 90;
            previewImage.style.transform = `rotate(${rotationAngle}deg)`;
        }

        function removeImage() {
            const imageInput = document.getElementById('product_image');
            const previewImage = document.getElementById('preview-image');
            const previewPlaceholder = document.getElementById('preview-placeholder');
            const imageTools = document.getElementById('image-tools');

            imageInput.value = '';
            previewImage.src = '';
            previewImage.style.display = 'none';
            previewPlaceholder.style.display = 'flex';
            imageTools.style.display = 'none';
            rotationAngle = 0;
        }

        // Form validation
        function validateForm() {
            let isValid = true;
            const requiredFields = ['name', 'category_id', 'unit_of_measurement', 'unit_price', 'total_stock',
                'description'
            ];

            requiredFields.forEach(fieldName => {
                const field = document.getElementById(fieldName);
                const value = field.value.trim();

                // Remove previous error styling
                field.classList.remove('error');
                const existingError = field.parentNode.querySelector('.error-message');
                if (existingError && !existingError.hasAttribute('data-server-error')) {
                    existingError.remove();
                }

                // Validate field
                if (!value) {
                    field.classList.add('error');
                    showFieldError(field, 'This field is required');
                    isValid = false;
                } else {
                    // Additional validations
                    if (fieldName === 'unit_price' || fieldName === 'selling_price') {
                        if (parseFloat(value) < 0) {
                            field.classList.add('error');
                            showFieldError(field, 'Price cannot be negative');
                            isValid = false;
                        }
                    }
                    if (fieldName === 'total_stock') {
                        if (parseInt(value) < 0) {
                            field.classList.add('error');
                            showFieldError(field, 'Stock cannot be negative');
                            isValid = false;
                        }
                    }
                }
            });

            return isValid;
        }

        // Show field-specific error
        function showFieldError(field, message) {
            const errorDiv = document.createElement('div');
            errorDiv.className = 'error-message';
            errorDiv.innerHTML = `<i class="fas fa-exclamation-circle"></i> ${message}`;
            field.parentNode.appendChild(errorDiv);
        }

        // Save as draft
        function saveDraft() {
            const form = document.getElementById('productForm');
            const statusInput = document.createElement('input');
            statusInput.type = 'hidden';
            statusInput.name = 'status';
            statusInput.value = 'draft';
            form.appendChild(statusInput);
            form.submit();
        }

        // Modal functions
        function showConfirmModal(productId) {
            currentProductId = productId;
            document.getElementById('confirmModal').style.display = 'flex';
        }

        function createAnother() {
            window.location.href = '{{ route('farm-products.create') }}';
        }

        function viewProduct() {
            if (currentProductId) {
                window.location.href = `/farm-products/${currentProductId}`;
            }
        }

        // Notification system
        function showNotification(message, type = 'info') {
            const notification = document.createElement('div');
            notification.className = `notification notification-${type}`;
            notification.style.cssText = `
                position: fixed;
                top: 20px;
                right: 20px;
                background: white;
                border-radius: 12px;
                box-shadow: 0 8px 32px rgba(0, 0, 0, 0.15);
                z-index: 1100;
                animation: slideInRight 0.3s ease;
                max-width: 400px;
                min-width: 300px;
                border-left: 4px solid ${type === 'success' ? '#4CAF50' : type === 'error' ? '#f44336' : '#2196F3'};
            `;

            notification.innerHTML = `
                <div style="padding: 15px 20px; display: flex; align-items: center; gap: 12px;">
                    <i class="fas fa-${type === 'success' ? 'check-circle' : type === 'error' ? 'exclamation-circle' : 'info-circle'}" 
                       style="color: ${type === 'success' ? '#4CAF50' : type === 'error' ? '#f44336' : '#2196F3'}"></i>
                    <span>${message}</span>
                    <button onclick="this.parentElement.parentElement.remove()" 
                                                        style="background: none; border: none; color: #666; cursor: pointer; margin-left: auto; padding: 5px;">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            `;

            document.body.appendChild(notification);

            // Auto remove after 5 seconds
            setTimeout(() => {
                if (notification.parentElement) {
                    notification.remove();
                }
            }, 5000);
        }

        // Form submission with loading state
        document.getElementById('productForm').addEventListener('submit', function() {
            const submitBtn = document.getElementById('publish-btn');
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Publishing...';
            submitBtn.disabled = true;
            submitBtn.classList.add('loading');
        });

        // Auto-save draft every 30 seconds
        let autoSaveInterval;

        function startAutoSave() {
            autoSaveInterval = setInterval(() => {
                const formData = new FormData(document.getElementById('productForm'));
                formData.set('status', 'draft');
                formData.set('auto_save', 'true');

                fetch('{{ route('farm-products.store') }}', {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                                'content')
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            showNotification('Draft saved automatically', 'success');
                        }
                    })
                    .catch(error => {
                        console.log('Auto-save failed:', error);
                    });
            }, 30000);
        }

        // Keyboard shortcuts
        document.addEventListener('keydown', function(e) {
            // Ctrl+S to save draft
            if ((e.ctrlKey || e.metaKey) && e.key === 's') {
                e.preventDefault();
                saveDraft();
            }

            // Ctrl+Enter to publish
            if ((e.ctrlKey || e.metaKey) && e.key === 'Enter') {
                e.preventDefault();
                document.getElementById('productForm').submit();
            }
        });

        // Image drag and drop
        function initializeDragAndDrop() {
            const uploadSection = document.querySelector('.image-upload-section');
            const imageInput = document.getElementById('product_image');

            uploadSection.addEventListener('dragover', function(e) {
                e.preventDefault();
                uploadSection.style.borderColor = '#4CAF50';
                uploadSection.style.background = 'rgba(76, 175, 80, 0.15)';
            });

            uploadSection.addEventListener('dragleave', function(e) {
                e.preventDefault();
                uploadSection.style.borderColor = 'rgba(76, 175, 80, 0.3)';
                uploadSection.style.background = 'rgba(76, 175, 80, 0.05)';
            });

            uploadSection.addEventListener('drop', function(e) {
                e.preventDefault();
                uploadSection.style.borderColor = 'rgba(76, 175, 80, 0.3)';
                uploadSection.style.background = 'rgba(76, 175, 80, 0.05)';

                const files = e.dataTransfer.files;
                if (files.length > 0) {
                    imageInput.files = files;
                    imageInput.dispatchEvent(new Event('change'));
                }
            });
        }

        // Initialize drag and drop on page load
        document.addEventListener('DOMContentLoaded', initializeDragAndDrop);

        // Smart price suggestions
        function suggestPrice() {
            const category = document.getElementById('category_id').value;
            const costPrice = parseFloat(document.getElementById('unit_price').value) || 0;

            if (category && costPrice > 0) {
                // This would typically come from your database
                const markupSuggestions = {
                    '1': 1.3, // 30% markup for vegetables
                    '2': 1.5, // 50% markup for fruits
                    '3': 1.2, // 20% markup for grains
                    'default': 1.25 // 25% default markup
                };

                const markup = markupSuggestions[category] || markupSuggestions['default'];
                const suggestedPrice = costPrice * markup;

                const sellingPriceInput = document.getElementById('selling_price');
                if (!sellingPriceInput.value) {
                    sellingPriceInput.value = suggestedPrice.toFixed(2);
                    calculateProfit();

                    showNotification(
                        `Suggested selling price: ₦${suggestedPrice.toFixed(2)} (${((markup - 1) * 100).toFixed(0)}% markup)`,
                        'info');
                }
            }
        }

        // Add event listener for category change to suggest prices
        document.getElementById('category_id').addEventListener('change', suggestPrice);
        document.getElementById('unit_price').addEventListener('blur', suggestPrice);

        // Progress indicator update
        function updateProgress() {
            const steps = document.querySelectorAll('.progress-step');
            let currentStep = 0;

            // Check which fields are completed
            const basicFields = ['name', 'category_id', 'unit_of_measurement', 'description'];
            const pricingFields = ['unit_price', 'total_stock'];
            const imageField = 'product_image';

            // Step 1: Basic info
            if (basicFields.every(field => document.getElementById(field).value.trim())) {
                steps[0].classList.add('completed');
                currentStep = 1;
            }

            // Step 2: Pricing
            if (currentStep >= 1 && pricingFields.every(field => document.getElementById(field).value.trim())) {
                steps[1].classList.add('completed');
                currentStep = 2;
            }

            // Step 3: Image
            if (currentStep >= 2 && document.getElementById(imageField).files.length > 0) {
                steps[2].classList.add('completed');
                currentStep = 3;
            }

            // Update active step
            steps.forEach((step, index) => {
                if (index === currentStep) {
                    step.classList.add('active');
                } else if (index < currentStep) {
                    step.classList.remove('active');
                    step.classList.add('completed');
                } else {
                    step.classList.remove('active', 'completed');
                }
            });
        }

        // Add event listeners to update progress
        document.querySelectorAll('input, select, textarea').forEach(element => {
            element.addEventListener('input', updateProgress);
            element.addEventListener('change', updateProgress);
        });

        // Initialize progress on page load
        document.addEventListener('DOMContentLoaded', updateProgress);
    </script>
@endsection
