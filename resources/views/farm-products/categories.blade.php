@extends('layouts.app')

@section('header')
    <div class="category-header">
        <div class="header-navigation">
            <a href="{{ route('farm-products.index') }}" class="back-btn">
                <i class="fas fa-arrow-left"></i>
                Back to Products
            </a>
            <div class="breadcrumb">
                <span>Products</span>
                <i class="fas fa-chevron-right"></i>
                <span>Manage Categories</span>
            </div>
        </div>
        <div class="header-content">
            <h2 class="page-title">
                <i class="fas fa-list-alt"></i>
                Manage Categories
            </h2>
            <p class="page-subtitle" style="color: white">Create, update, or delete categories here</p>
        </div>
    </div>
@endsection

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        /* Modal styles (simple custom modal, no framework) */
        .modal {
            display: none;
            position: fixed;
            z-index: 1050;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.5);
            align-items: center;
            justify-content: center;
        }

        .modal.show {
            display: flex;
        }

        .modal-dialog {
            background: white;
            border-radius: 8px;
            max-width: 500px;
            width: 100%;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.3);
            animation: fadeInModal 0.3s ease;
        }

        @keyframes fadeInModal {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .modal-header {
            padding: 16px 24px;
            background-color: #4caf50;
            color: white;
            font-weight: 600;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .modal-body {
            padding: 24px;
        }

        .modal-footer {
            padding: 16px 24px;
            display: flex;
            justify-content: flex-end;
            gap: 12px;
            border-top: 1px solid #ddd;
            border-bottom-left-radius: 8px;
            border-bottom-right-radius: 8px;
        }

        .btn-close {
            background: transparent;
            border: none;
            font-size: 1.2rem;
            color: white;
            cursor: pointer;
        }

        label {
            display: block;
            font-weight: 600;
            margin-bottom: 6px;
            color: #4caf50;
        }

        input[type="text"],
        textarea {
            width: 100%;
            padding: 8px 10px;
            border: 2px solid #4caf50;
            border-radius: 4px;
            font-size: 1rem;
            box-sizing: border-box;
            resize: vertical;
        }

        textarea {
            min-height: 80px;
        }
    </style>
    <style>
        .category-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 20px;
        }

        .category-header {
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

        /* Main Content */
        .category-main-content {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .category-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .category-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: #2E7D32;
        }

        .btn {
            padding: 12px 24px;
            border: none;
            border-radius: 12px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
        }

        .btn-primary {
            background: linear-gradient(135deg, #4CAF50, #81C784);
            color: white;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        /* Table Styles */
        .category-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 1rem;
        }

        th,
        td {
            padding: 12px 16px;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            text-align: left;
        }

        th {
            background: rgba(76, 175, 80, 0.1);
            color: #2E7D32;
            font-weight: 600;
        }

        .actions {
            display: flex;
            gap: 10px;
        }

        .edit-btn,
        .delete-btn {
            padding: 8px 14px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .edit-btn {
            background: rgba(76, 175, 80, 0.1);
            color: #4CAF50;
        }

        .edit-btn:hover {
            background: rgba(76, 175, 80, 0.2);
        }

        .delete-btn {
            background: rgba(244, 67, 54, 0.1);
            color: #f44336;
        }

        .delete-btn:hover {
            background: rgba(244, 67, 54, 0.2);
        }

        /* Pagination */
        .pagination-wrapper {
            display: flex;
            justify-content: center;
            margin-top: 40px;
        }

        .pagination {
            display: flex;
            gap: 8px;
            align-items: center;
        }

        .page-btn {
            width: 40px;
            height: 40px;
            border: 2px solid rgba(76, 175, 80, 0.2);
            background: white;
            color: #4CAF50;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            font-weight: 600;
        }

        .page-btn:hover,
        .page-btn.active {
            background: #4CAF50;
            color: white;
            border-color: #4CAF50;
        }

        .page-btn:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .category-container {
                padding: 15px;
            }

            .category-header {
                padding: 20px;
            }

            .page-title {
                font-size: 1.8rem;
                flex-direction: column;
                gap: 10px;
            }

            .category-main-content {
                padding: 25px;
            }

            .category-actions {
                flex-direction: column;
                gap: 20px;
            }

            .btn {
                justify-content: center;
            }
        }

        @media (max-width: 480px) {
            .header-navigation {
                flex-direction: column;
                gap: 15px;
                align-items: flex-start;
            }

            .breadcrumb {
                order: -1;
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
    </style>
@endsection

@section('content')
    <div class="category-container">
        <div class="category-main-content fade-in">
            <div class="category-actions">
                <h3 class="category-title">All Categories</h3>
                <button type="button" class="btn btn-primary" id="open-create-modal-btn">
                    <i class="fas fa-plus"></i>
                    Add New Category
                </button>
            </div>

            <table class="category-table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Description</th>
                        <th style="width: 140px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                        <tr data-id="{{ $category->id }}" data-name="{{ $category->name }}"
                            data-description="{{ $category->description }}">
                            <td>{{ $category->name }}</td>
                            <td>{{ $category->description ?? '-' }}</td>
                            <td class="actions">
                                <button type="button" class="edit-btn">
                                    <i class="fas fa-edit"></i>
                                    Edit
                                </button>
                                <form method="POST" action="{{ route('farm-products-categories.destroy', $category) }}"
                                    style="display:inline;" onsubmit="return confirm('Delete this category?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="delete-btn">
                                        <i class="fas fa-trash"></i>
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="pagination-wrapper">
                {{ $categories->links('vendor.pagination.custom') }}
            </div>
        </div>

        <!-- Create Category Modal -->
        <div class="modal" id="createCategoryModal" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form method="POST" action="{{ route('farm-products-categories.store') }}" class="modal-content"
                    id="create-category-form">
                    @csrf
                    <input type="hidden" name="farmer_id" value="{{ Auth::user()->id }}" />
                    <div class="modal-header">
                        <h5 class="modal-title">Add New Category</h5>
                        <button type="button" class="btn-close" aria-label="Close" id="create-modal-close">&times;</button>
                    </div>
                    <div class="modal-body">
                        <label for="create-name">Category Name <span class="required">*</span></label>
                        <input type="text" id="create-name" name="name" placeholder="Enter category name" required>

                        <label for="create-description" style="margin-top: 12px;">Description (Optional)</label>
                        <textarea id="create-description" name="description" maxlength="500"
                            placeholder="Brief description (max 500 characters)"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" id="create-modal-cancel">Cancel</button>
                        <button type="submit" class="btn btn-primary">Add Category</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Update Category Modal -->
        <div class="modal" id="updateCategoryModal" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form method="POST" class="modal-content" id="update-category-form">
                    @csrf
                    @method('PATCH')
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Category</h5>
                        <button type="button" class="btn-close" aria-label="Close" id="update-modal-close">&times;</button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="update-category-id" name="category_id" value="" />

                        <label for="update-name">Category Name <span class="required">*</span></label>
                        <input type="text" id="update-name" name="name" required>

                        <label for="update-description" style="margin-top: 12px;">Description (Optional)</label>
                        <textarea id="update-description" name="description" maxlength="500"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" id="update-modal-cancel">Cancel</button>
                        <button type="submit" class="btn btn-primary">Update Category</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection


@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const createModal = document.getElementById('createCategoryModal');
            const updateModal = document.getElementById('updateCategoryModal');

            // Open Create Modal
            const openCreateBtn = document.getElementById('open-create-modal-btn');
            const createModalClose = document.getElementById('create-modal-close');
            const createModalCancel = document.getElementById('create-modal-cancel');

            openCreateBtn.addEventListener('click', () => {
                createModal.classList.add('show');
                createModal.setAttribute('aria-hidden', 'false');
                document.getElementById('create-category-form').reset();
            });

            const closeCreateModal = () => {
                createModal.classList.remove('show');
                createModal.setAttribute('aria-hidden', 'true');
            };

            createModalClose.addEventListener('click', closeCreateModal);
            createModalCancel.addEventListener('click', closeCreateModal);

            // Open Update Modal
            const updateModalClose = document.getElementById('update-modal-close');
            const updateModalCancel = document.getElementById('update-modal-cancel');
            const updateForm = document.getElementById('update-category-form');

            // When user clicks edit, populate and show update modal
            document.querySelectorAll('.edit-btn').forEach(button => {
                button.addEventListener('click', () => {
                    const id = button.closest('tr').dataset.id;
                    const name = button.closest('tr').dataset.name;
                    const description = button.closest('tr').dataset.description || '';

                    document.getElementById('update-category-id').value = id;
                    document.getElementById('update-name').value = name;
                    document.getElementById('update-description').value = description;

                    // Set form action dynamically
                    updateForm.action = `/farm-products-categories/${id}`;

                    updateModal.classList.add('show');
                    updateModal.setAttribute('aria-hidden', 'false');
                });
            });

            const closeUpdateModal = () => {
                updateModal.classList.remove('show');
                updateModal.setAttribute('aria-hidden', 'true');
            };

            updateModalClose.addEventListener('click', closeUpdateModal);
            updateModalCancel.addEventListener('click', closeUpdateModal);

            // Accessibility: close modals with ESC key
            document.addEventListener('keydown', (e) => {
                if (e.key === "Escape") {
                    if (createModal.classList.contains('show')) closeCreateModal();
                    if (updateModal.classList.contains('show')) closeUpdateModal();
                }
            });

            // Optional: Click outside modal closes it
            window.addEventListener('click', (event) => {
                if (event.target === createModal) closeCreateModal();
                if (event.target === updateModal) closeUpdateModal();
            });
        });
    </script>
@endsection
