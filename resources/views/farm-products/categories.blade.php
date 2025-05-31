@extends('layouts.app')

@section('header')
    <h2>Manage Categories</h2>
    <p>Create, update, or delete categories here</p>
@endsection

@section('styles')
    <style>
        .category-section {
            max-width: 800px;
            padding: 12px;
            margin: auto;
            background-color: #fefefe;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
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
            background-color: red;
            color: white;
        }

        .delete-btn:hover {
            background-color: #cc0000;
        }

        /* Main color styling */
        .btn-green {
            background-color: #4caf50;
            color: white;
            border: none;
            padding: 8px 16px;
            font-weight: 600;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.25s ease;
        }

        .btn-green:hover {
            background-color: #388e3c;
            color: white;
        }

        .btn-danger {
            background-color: #d32f2f;
            color: white;
            border: none;
            padding: 6px 12px;
            font-weight: 600;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.25s ease;
        }

        .btn-danger:hover {
            background-color: #b71c1c;
        }

        .btn-secondary {
            background-color: #777;
            color: white;
            border: none;
            padding: 8px 16px;
            font-weight: 600;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.25s ease;
        }

        .btn-secondary:hover {
            background-color: #555;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 1rem;
            margin-top: 20px;
        }

        th,
        td {
            padding: 12px 16px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: #4caf50;
            color: white;
            font-weight: 700;
        }

        .actions button {
            margin-right: 8px;
            font-size: 0.9rem;
        }

        .actions form {
            display: inline-block;
        }

        .alert-success {
            max-width: 900px;
            margin: 10px auto;
            padding: 12px 18px;
            background-color: #d0f0d8;
            border: 1px solid #4caf50;
            border-radius: 4px;
            color: #2e7d32;
            font-weight: 600;
        }

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
@endsection

@section('content')
    <section class="category-section">
        <div style="max-width: 900px; margin: 20px auto;">
            <div class="" style="display: flex; align-items: center; justify-content: space-between; gap:4px;">
                <h3>All Categories</h3>
                <button type="button" class="edit-btn"
                    style="background:#388e3c; color:white; padding: 9px 28px; outline:none" id="open-create-modal-btn">
                    + Add New Category
                </button>
            </div>
            <!-- Add Category Button -->

            <div class="table-section">

                <table style="margin-top: 12px;">
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
                                    <div class=""
                                        style="display: flex; align-items: center; justify-content: flex-end; gap:4px;">
                                        <button type="button" class="edit-btn" style="background:#388e3c; color:white;"
                                            data-id="{{ $category->id }}" data-name="{{ $category->name }}"
                                            data-description="{{ $category->description }}">Edit</button>

                                        <form method="POST"
                                            action="{{ route('farm-products-categories.destroy', $category) }}"
                                            style="display:inline;" onsubmit="return confirm('Delete this category?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" style="background:#d32f2f;color:white;">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div style="margin-top: 20px; text-align: right;">
                    {{ $categories->links('vendor.pagination.custom') }}
                </div>
            </div>
            <!-- Categories Table -->

        </div>

        <!-- Create Category Modal -->
        <div class="modal" id="createCategoryModal" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form method="POST" action="{{ route('farm-products-categories.store') }}" class="modal-content"
                    id="create-category-form">
                    @csrf
                    <input type="hidden" name="farmer_id" id="farmer_id" value="{{ Auth::user()->id }}" />
                    <div class="modal-header">
                        <h5 class="modal-title">Add New Category</h5>
                        <button type="button" class="btn-close" aria-label="Close" id="create-modal-close">&times;</button>
                    </div>
                    <div class="modal-body">
                        <label for="create-name">Category Name <span style="color:red;">*</span></label>
                        <input type="text" id="create-name" name="name" placeholder="Enter category name" required>

                        <label for="create-description" style="margin-top: 12px;">Description (Optional)</label>
                        <textarea id="create-description" name="description" maxlength="500"
                            placeholder="Brief description (max 500 characters)"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn-secondary" id="create-modal-cancel">Cancel</button>
                        <button type="submit" class="btn-green">Add Category</button>
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

                        <label for="update-name">Category Name <span style="color:red;">*</span></label>
                        <input type="text" id="update-name" name="name" required>

                        <label for="update-description" style="margin-top: 12px;">Description (Optional)</label>
                        <textarea id="update-description" name="description" maxlength="500"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn-secondary" id="update-modal-cancel">Cancel</button>
                        <button type="submit" class="btn-green">Update Category</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
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
                    const id = button.getAttribute('data-id');
                    const name = button.getAttribute('data-name');
                    const description = button.getAttribute('data-description') || '';

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
