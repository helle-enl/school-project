@extends('layouts.app')

@section('header')
    <div class="order-edit-header">
        <div class="header-navigation">
            <a href="{{ route('orders.show', $order->id) }}" class="back-btn">
                <i class="fas fa-arrow-left"></i>
                Back to Order Details
            </a>
            <div class="breadcrumb">
                <span>Orders</span>
                <i class="fas fa-chevron-right"></i>
                <span>Edit Order #{{ $order->id }}</span>
            </div>
        </div>
        <div class="order-header-content">
            <div class="order-main-info">
                <div class="info-item">
                    <div class="info-label">Order ID</div>
                    <div class="info-value">#{{ $order->id }}</div>
                    <div class="info-sub">{{ $order->created_at->format('M j, Y g:i A') }}</div>
                </div>
                <div class="info-item">
                    <div class="info-label">Customer</div>
                    <div class="info-value">{{ $order->buyer->first_name }} {{ $order->buyer->last_name }}</div>
                    <div class="info-sub">{{ $order->buyer->email }}</div>
                </div>
                <div class="info-item">
                    <div class="info-label">Product</div>
                    <div class="info-value">{{ $order->product->name }}</div>
                    <div class="info-sub">₦{{ number_format($order->product->selling_price, 2) }}</div>
                </div>
                <div class="info-item">
                    <div class="info-label">Current Status</div>
                    <div class="info-value">
                        <span class="status-badge status-{{ strtolower($order->status) }}">
                            {{ ucfirst($order->status) }}
                        </span>
                    </div>
                </div>
            </div>
            <div class="header-actions">
                <form action="{{ route('orders.destroy', $order->id) }}" method="POST" onsubmit="return confirmDelete()">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash"></i>
                        Delete Order
                    </button>
                </form>
            </div>
        </div>

    </div>
@endsection

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        /* Custom styles for the order edit page */
        .order-edit-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 30px 20px;
        }

        .order-edit-header {
            background: linear-gradient(135deg, #2E7D32 0%, #4CAF50 100%);
            color: white;
            padding: 40px;
            border-radius: 0px;
            margin-bottom: 40px;
            box-shadow: 0 15px 50px rgba(46, 125, 50, 0.3);
            position: relative;
            overflow: hidden;
        }

        .order-edit-header::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 100%;
            height: 200%;
            background: linear-gradient(45deg, transparent, rgba(255, 255, 255, 0.1), transparent);
            animation: shimmer 3s infinite;
        }

        @keyframes shimmer {
            0% {
                transform: translateX(-100%) translateY(-100%) rotate(45deg);
            }

            100% {
                transform: translateX(100%) translateY(100%) rotate(45deg);
            }
        }

        .header-navigation {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            position: relative;
            z-index: 2;
        }

        .back-btn {
            color: white;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 12px 20px;
            border-radius: 12px;
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: all 0.3s ease;
            font-weight: 600;
        }

        .back-btn:hover {
            background: rgba(255, 255, 255, 0.25);
            transform: translateX(-5px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .breadcrumb {
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 0.95rem;
            opacity: 0.9;
            background: rgba(255, 255, 255, 0.1);
            padding: 8px 16px;
            border-radius: 20px;
            backdrop-filter: blur(10px);
        }

        .order-header-content {
            display: grid;
            grid-template-columns: 1fr auto;
            gap: 40px;
            align-items: start;
            position: relative;
            z-index: 2;
        }

        .order-main-info {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 25px;
            color: white;
        }

        .info-item {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px);
            padding: 20px;
            border-radius: 15px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: all 0.3s ease;
        }

        .info-item:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateY(-3px);
        }

        .info-label {
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            opacity: 0.8;
            margin-bottom: 8px;
            font-weight: 500;
        }

        .info-value {
            font-size: 1.2rem;
            font-weight: 700;
            line-height: 1.3;
        }

        .info-sub {
            font-size: 0.9rem;
            opacity: 0.8;
            margin-top: 4px;
            font-weight: 400;
        }

        .header-actions {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .btn {
            padding: 15px 25px;
            border: none;
            border-radius: 12px;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            cursor: pointer;
            font-size: 0.95rem;
            white-space: nowrap;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            position: relative;
            overflow: hidden;
        }

        .btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: left 0.5s;
        }

        .btn:hover::before {
            left: 100%;
        }

        .btn-danger {
            background: linear-gradient(135deg, #F44336, #E53935);
            color: white;
            box-shadow: 0 8px 25px rgba(244, 67, 54, 0.3);
        }

        .btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 35px rgba(0, 0, 0, 0.2);
        }

        .btn-danger:hover {
            box-shadow: 0 12px 35px rgba(244, 67, 54, 0.4);
        }

        /* Edit Form Styles */
        .edit-form-section {
            display: grid;
            grid-template-columns: 1fr 350px;
            gap: 40px;
            margin-bottom: 40px;
        }

        .form-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            transition: all 0.4s ease;
            position: relative;
            overflow: hidden;
        }

        .form-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #4CAF50, #2196F3);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .form-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
        }

        .form-card:hover::before {
            opacity: 1;
        }

        .card-title {
            font-size: 1.4rem;
            font-weight: 700;
            color: #2E7D32;
            margin-bottom: 25px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-label {
            display: block;
            font-size: 0.9rem;
            font-weight: 600;
            color: #2E7D32;
            margin-bottom: 8px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .form-control {
            width: 100%;
            padding: 15px 20px;
            border: 2px solid rgba(76, 175, 80, 0.2);
            border-radius: 12px;
            font-size: 1rem;
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            transition: all 0.3s ease;
            box-sizing: border-box;
        }

        .form-control:focus {
            outline: none;
            border-color: #4CAF50;
            box-shadow: 0 0 0 3px rgba(76, 175, 80, 0.1);
            background: white;
        }

        .form-select {
            appearance: none;
            background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6,9 12,15 18,9'%3e%3c/polyline%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right 15px center;
            background-size: 20px;
        }

        .input-group {
            position: relative;
        }

        .input-icon {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #4CAF50;
            font-size: 1.1rem;
        }

        .input-group .form-control {
            padding-left: 50px;
        }

        .quantity-controls {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .quantity-btn {
            width: 40px;
            height: 40px;
            border: 2px solid #4CAF50;
            background: rgba(76, 175, 80, 0.1);
            color: #4CAF50;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            font-weight: 600;
        }

        .quantity-btn:hover {
            background: #4CAF50;
            color: white;
            transform: scale(1.1);
        }

        .quantity-input {
            width: 80px;
            text-align: center;
            font-weight: 600;
            font-size: 1.1rem;
        }

        .summary-card {
            position: sticky;
            top: 20px;
        }

        .summary-content {
            background: linear-gradient(135deg, rgba(76, 175, 80, 0.1), rgba(129, 199, 132, 0.1));
            border: 2px solid rgba(76, 175, 80, 0.2);
            border-radius: 15px;
            padding: 25px;
            margin-bottom: 25px;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 1px solid rgba(76, 175, 80, 0.1);
        }

        .summary-row:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-top: 15px;
            border-top: 2px solid #4CAF50;
            font-weight: 700;
            font-size: 1.1rem;
        }

        .summary-label {
            color: #666;
            font-size: 0.9rem;
        }

        .summary-value {
            color: #2E7D32;
            font-weight: 600;
        }

        .total-value {
            font-size: 1.5rem;
            background: linear-gradient(135deg, #2E7D32, #4CAF50);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .form-actions {
            display: flex;
            gap: 15px;
            justify-content: flex-end;
            padding-top: 20px;
        }

        .btn-primary {
            background: linear-gradient(135deg, #4CAF50, #66BB6A);
            color: white;
            box-shadow: 0 8px 25px rgba(76, 175, 80, 0.3);
        }

        .btn-secondary {
            background: linear-gradient(135deg, #607D8B, #78909C);
            color: white;
            box-shadow: 0 8px 25px rgba(96, 125, 139, 0.3);
        }

        .btn-primary:hover {
            box-shadow: 0 12px 35px rgba(76, 175, 80, 0.4);
        }

        .btn-secondary:hover {
            box-shadow: 0 12px 35px rgba(96, 125, 139, 0.4);
        }

        @media (max-width: 768px) {
            .order-header-content {
                grid-template-columns: 1fr;
                gap: 20px;
            }

            .order-main-info {
                grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
                gap: 15px;
            }

            .edit-form-section {
                grid-template-columns: 1fr;
                gap: 20px;
            }

            .summary-card {
                position: static;
            }

            .form-actions {
                flex-direction: column;
            }
        }

        .status-badge {
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            display: inline-block;
        }

        .status-pending {
            background: linear-gradient(135deg, #FF9800, #FFB74D);
            color: white;
        }

        .status-processing {
            background: linear-gradient(135deg, #2196F3, #64B5F6);
            color: white;
        }

        .status-shipped {
            background: linear-gradient(135deg, #9C27B0, #BA68C8);
            color: white;
        }

        .status-delivered {
            background: linear-gradient(135deg, #3F51B5, #7986CB);
            color: white;
        }

        .status-completed {
            background: linear-gradient(135deg, #4CAF50, #66BB6A);
            color: white;
        }

        .status-cancelled {
            background: linear-gradient(135deg, #F44336, #EF5350);
            color: white;
        }

        .status-preview {
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid rgba(76, 175, 80, 0.2);
        }

        .current-status {
            text-align: center;
        }
    </style>
@endsection

@section('content')
    <div class="order-edit-container">
        <form action="{{ route('orders.update', $order->id) }}" method="POST" id="orderEditForm">
            @csrf
            @method('PUT')

            <div class="edit-form-section">
                <!-- Main Edit Form -->
                <div class="form-card">
                    <h3 class="card-title">
                        <i class="fas fa-edit"></i>
                        Edit Order Details
                    </h3>

                    <!-- Quantity Section -->
                    <div class="form-group">
                        <label for="quantity" class="form-label">
                            <i class="fas fa-cubes"></i>
                            Quantity
                        </label>
                        <div class="quantity-controls">
                            <button type="button" class="quantity-btn" onclick="updateQuantity(-1)">
                                <i class="fas fa-minus"></i>
                            </button>
                            <input type="number" id="quantity" name="quantity" class="form-control quantity-input"
                                value="{{ $order->quantity }}" min="1" max="999" onchange="calculateTotal()">
                            <button type="button" class="quantity-btn" onclick="updateQuantity(1)">
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Status Section -->
                    <div class="form-group">
                        <label for="status" class="form-label">
                            <i class="fas fa-flag"></i>
                            Order Status
                        </label>
                        <div class="input-group">
                            <i class="input-icon fas fa-circle-notch"></i>
                            <select id="status" name="status" class="form-control form-select"
                                onchange="updateStatusPreview()">
                                <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending
                                </option>
                                <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>
                                    Processing</option>
                                <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : '' }}>Shipped
                                </option>
                                <option value="delivered" {{ $order->status == 'delivered' ? 'selected' : '' }}>Delivered
                                </option>
                                {{-- <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed
                                </option> --}}
                                <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled
                                </option>
                            </select>
                        </div>
                    </div>

                    <!-- Customer Notes Section -->
                    <div class="form-group">
                        <label for="notes" class="form-label">
                            <i class="fas fa-sticky-note"></i>
                            Order Notes (Optional)
                        </label>
                        <div class="input-group">
                            <textarea id="notes" name="notes" class="form-control" rows="4"
                                placeholder="Add any special notes or instructions for this order...">{{ old('notes', $order->notes ?? '') }}</textarea>
                        </div>
                    </div>

                    <!-- Shipping Information -->
                    <div class="form-group">
                        <label for="shipping_address" class="form-label">
                            <i class="fas fa-map-marker-alt"></i>
                            Shipping Address
                        </label>
                        <div class="input-group">
                            <i class="input-icon fas fa-home"></i>
                            <textarea id="shipping_address" name="shipping_address" class="form-control" rows="3"
                                placeholder="Enter shipping address...">{{ old('shipping_address', $order->shipping_address ?? '') }}</textarea>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="form-actions">
                        <a href="{{ route('orders.show', $order->id) }}" class="btn btn-secondary">
                            <i class="fas fa-times"></i>
                            Cancel
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i>
                            Update Order
                        </button>
                    </div>
                </div>

                <!-- Order Summary Card -->
                <div class="summary-card">
                    <div class="form-card">
                        <h3 class="card-title">
                            <i class="fas fa-calculator"></i>
                            Order Summary
                        </h3>

                        <div class="summary-content">
                            <div class="summary-row">
                                <span class="summary-label">Product:</span>
                                <span class="summary-value">{{ $order->product->name }}</span>
                            </div>
                            <div class="summary-row">
                                <span class="summary-label">Unit Price:</span>
                                <span class="summary-value"
                                    id="unitPrice">₦{{ number_format($order->product->selling_price, 2) }}</span>
                            </div>
                            <div class="summary-row">
                                <span class="summary-label">Quantity:</span>
                                <span class="summary-value" id="summaryQuantity">{{ $order->quantity }}</span>
                            </div>
                            <div class="summary-row">
                                <span class="summary-label">Subtotal:</span>
                                <span class="summary-value"
                                    id="subtotal">₦{{ number_format($order->total_price, 2) }}</span>
                            </div>
                            <div class="summary-row">
                                <span class="summary-label">Tax & Fees:</span>
                                <span class="summary-value">₦0.00</span>
                            </div>
                            <div class="summary-row">
                                <span class="summary-label">Total Amount:</span>
                                <span class="summary-value total-value"
                                    id="totalAmount">₦{{ number_format($order->total_price, 2) }}</span>
                            </div>
                        </div>

                        <!-- Status Preview -->
                        <div class="status-preview">
                            <h4 style="color: #2E7D32; margin-bottom: 15px; font-size: 1.1rem;">
                                <i class="fas fa-eye"></i>
                                Status Preview
                            </h4>
                            <div class="current-status">
                                <span class="status-badge" id="statusPreview">{{ ucfirst($order->status) }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Actions -->
                    <div class="form-card" style="margin-top: 20px;">
                        <h3 class="card-title">
                            <i class="fas fa-bolt"></i>
                            Quick Actions
                        </h3>

                        <div style="display: flex; flex-direction: column; gap: 10px;">
                            <button type="button" class="btn btn-secondary" onclick="setStatus('processing')"
                                style="font-size: 0.9rem; padding: 10px;">
                                <i class="fas fa-play"></i>
                                Mark as Processing
                            </button>
                            <button type="button" class="btn btn-secondary" onclick="setStatus('delivered')"
                                style="font-size: 0.9rem; padding: 10px;">
                                <i class="fas fa-check"></i>
                                Mark as Delivered
                            </button>
                            <button type="button" class="btn btn-secondary" onclick="duplicateOrder()"
                                style="font-size: 0.9rem; padding: 10px;">
                                <i class="fas fa-copy"></i>
                                Duplicate Order
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
    <script>
        // Order edit functionality
        const unitPrice = {{ $order->product->selling_price }};
        let currentQuantity = {{ $order->quantity }};

        // Calculate total price
        function calculateTotal() {
            const quantity = parseInt(document.getElementById('quantity').value) || 1;
            const total = unitPrice * quantity;

            document.getElementById('summaryQuantity').textContent = quantity;
            document.getElementById('subtotal').textContent = '₦' + total.toLocaleString('en-NG', {
                minimumFractionDigits: 2
            });
            document.getElementById('totalAmount').textContent = '₦' + total.toLocaleString('en-NG', {
                minimumFractionDigits: 2
            });

            currentQuantity = quantity;
        }

        // Update quantity with buttons
        function updateQuantity(change) {
            const quantityInput = document.getElementById('quantity');
            let newQuantity = parseInt(quantityInput.value) + change;

            if (newQuantity < 1) newQuantity = 1;
            if (newQuantity > 999) newQuantity = 999;

            quantityInput.value = newQuantity;
            calculateTotal();
        }

        // Update status preview
        function updateStatusPreview() {
            const statusSelect = document.getElementById('status');
            const statusPreview = document.getElementById('statusPreview');
            const selectedStatus = statusSelect.value;

            statusPreview.textContent = selectedStatus.charAt(0).toUpperCase() + selectedStatus.slice(1);
            statusPreview.className = 'status-badge status-' + selectedStatus;
        }

        // Set status quickly
        function setStatus(status) {
            document.getElementById('status').value = status;
            updateStatusPreview();
        }

        // Confirm delete
        function confirmDelete() {
            return confirm('Are you sure you want to delete this order? This action cannot be undone.');
        }

        // Duplicate order
        function duplicateOrder() {
            if (confirm('Create a duplicate of this order with the same details?')) {
                // Here you would typically make an AJAX request to duplicate the order
                alert('Order duplication feature would be implemented here.');
            }
        }

        // Form validation
        document.getElementById('orderEditForm').addEventListener('submit', function(e) {
            const quantity = parseInt(document.getElementById('quantity').value);

            if (quantity < 1 || quantity > 999) {
                e.preventDefault();
                alert('Please enter a valid quantity between 1 and 999.');
                return;
            }

            // Show loading state
            const submitBtn = document.querySelector('.btn-primary');
            const originalText = submitBtn.innerHTML;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Updating...';
            submitBtn.disabled = true;

            // Re-enable button after 3 seconds in case of error
            setTimeout(() => {
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;
            }, 3000);
        });

        // Auto-save draft functionality
        let autoSaveTimer;

        function autoSaveDraft() {
            clearTimeout(autoSaveTimer);
            autoSaveTimer = setTimeout(() => {
                // Save draft to localStorage
                const formData = {
                    quantity: document.getElementById('quantity').value,
                    status: document.getElementById('status').value,
                    notes: document.getElementById('notes').value,
                    shipping_address: document.getElementById('shipping_address').value
                };
                localStorage.setItem('orderEdit_{{ $order->id }}', JSON.stringify(formData));
            }, 1000);
        }

        // Load draft on page load
        document.addEventListener('DOMContentLoaded', function() {
            const savedDraft = localStorage.getItem('orderEdit_{{ $order->id }}');

            if (savedDraft) {
                const draftData = JSON.parse(savedDraft);

                // Show restore draft option
                const restoreDraft = confirm('Found a saved draft of your changes. Would you like to restore it?');

                if (restoreDraft) {
                    document.getElementById('quantity').value = draftData.quantity || {{ $order->quantity }};
                    document.getElementById('status').value = draftData.status || '{{ $order->status }}';
                    document.getElementById('notes').value = draftData.notes || '';
                    document.getElementById('shipping_address').value = draftData.shipping_address || '';

                    calculateTotal();
                    updateStatusPreview();
                }
            }

            // Add event listeners for auto-save
            ['quantity', 'status', 'notes', 'shipping_address'].forEach(id => {
                const element = document.getElementById(id);
                if (element) {
                    element.addEventListener('input', autoSaveDraft);
                    element.addEventListener('change', autoSaveDraft);
                }
            });

            // Add animation to form cards
            const cards = document.querySelectorAll('.form-card');
            cards.forEach((card, index) => {
                card.style.animationDelay = `${index * 0.1}s`;
                card.classList.add('fade-in');
            });

            // Initialize tooltips for form elements
            initializeTooltips();
        });

        // Initialize tooltips
        function initializeTooltips() {
            const tooltips = [{
                    element: '#quantity',
                    text: 'Enter quantity between 1 and 999'
                },
                {
                    element: '#status',
                    text: 'Select the current order status'
                },
                {
                    element: '#notes',
                    text: 'Add any special instructions or notes'
                }
            ];

            tooltips.forEach(tooltip => {
                const element = document.querySelector(tooltip.element);
                if (element) {
                    element.title = tooltip.text;
                }
            });
        }

        // Clear draft when form is successfully submitted
        function clearDraft() {
            localStorage.removeItem('orderEdit_{{ $order->id }}');
        }

        // Add keyboard shortcuts
        document.addEventListener('keydown', function(e) {
            // Ctrl/Cmd + S to save
            if ((e.ctrlKey || e.metaKey) && e.key === 's') {
                e.preventDefault();
                document.getElementById('orderEditForm').submit();
            }

            // Ctrl/Cmd + Enter to save
            if ((e.ctrlKey || e.metaKey) && e.key === 'Enter') {
                e.preventDefault();
                document.getElementById('orderEditForm').submit();
            }

            // Escape to cancel
            if (e.key === 'Escape') {
                if (confirm('Are you sure you want to cancel editing? Any unsaved changes will be lost.')) {
                    window.location.href = '{{ route('orders.show', $order->id) }}';
                }
            }
        });

        // Add fade-in animation styles
        const style = document.createElement('style');
        style.textContent = `
        .fade-in {
            animation: fadeInUp 0.6s ease forwards;
            opacity: 0;
            transform: translateY(20px);
        }
        @keyframes fadeInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 9999;
        }
        
        .loading-spinner {
            background: white;
            padding: 30px;
            border-radius: 15px;
            text-align: center;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
        }
    `;
        document.head.appendChild(style);

        // Enhanced form validation with real-time feedback
        function validateForm() {
            const quantity = parseInt(document.getElementById('quantity').value);
            const status = document.getElementById('status').value;
            let isValid = true;

            // Clear previous errors
            document.querySelectorAll('.error-message').forEach(el => el.remove());
            document.querySelectorAll('.form-control').forEach(el => el.classList.remove('error'));

            // Validate quantity
            if (quantity < 1 || quantity > 999 || isNaN(quantity)) {
                showFieldError('quantity', 'Quantity must be between 1 and 999');
                isValid = false;
            }

            // Validate status
            const validStatuses = ['pending', 'processing', 'shipped', 'delivered', 'completed', 'cancelled'];
            if (!validStatuses.includes(status)) {
                showFieldError('status', 'Please select a valid status');
                isValid = false;
            }

            return isValid;
        }

        // Show field-specific error
        function showFieldError(fieldId, message) {
            const field = document.getElementById(fieldId);
            field.classList.add('error');

            const errorDiv = document.createElement('div');
            errorDiv.className = 'error-message';
            errorDiv.style.cssText = 'color: #F44336; font-size: 0.85rem; margin-top: 5px; font-weight: 500;';
            errorDiv.textContent = message;

            field.parentNode.appendChild(errorDiv);
        }

        // Add error styles
        const errorStyles = `
        .form-control.error {
            border-color: #F44336 !important;
            box-shadow: 0 0 0 3px rgba(244, 67, 54, 0.1) !important;
        }
    `;

        const errorStyleSheet = document.createElement('style');
        errorStyleSheet.textContent = errorStyles;
        document.head.appendChild(errorStyleSheet);
    </script>
@endsection
