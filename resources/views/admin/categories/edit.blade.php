@extends('layouts.admin')

@section('title', 'Edit Kategori')
@section('page-title', 'Edit Kategori')

@section('content')

<style>
    /* Modern Red Theme Styles */
    :root {
        --primary-red: #dc2626;
        --red-hover: #b91c1c;
        --red-light: #fef2f2;
        --red-border: #fecaca;
        --gray-50: #f9fafb;
        --gray-100: #f3f4f6;
        --gray-200: #e5e7eb;
        --gray-300: #d1d5db;
        --gray-400: #9ca3af;
        --gray-500: #6b7280;
        --gray-600: #4b5563;
        --gray-700: #374151;
        --gray-800: #1f2937;
        --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
        --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1);
        --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1);
    }

    body {
        background-color: #ffffff;
        color: var(--gray-800);
    }

    .page-header {
        background: linear-gradient(135deg, var(--primary-red) 0%, var(--red-hover) 100%);
        padding: 2rem;
        border-radius: 16px;
        margin-bottom: 2rem;
        box-shadow: var(--shadow-lg);
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .page-header h2 {
        color: white;
        font-size: 1.875rem;
        font-weight: 700;
        margin: 0;
        letter-spacing: -0.025em;
    }

    .btn {
        padding: 0.625rem 1.25rem;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.875rem;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        transition: all 0.2s ease;
        border: none;
        cursor: pointer;
        white-space: nowrap;
    }

    .btn-primary {
        background-color: var(--primary-red);
        color: white;
        box-shadow: var(--shadow-sm);
    }

    .btn-primary:hover {
        background-color: var(--red-hover);
        transform: translateY(-1px);
        box-shadow: var(--shadow-md);
    }

    .btn-secondary {
        background-color: white;
        color: var(--primary-red);
        box-shadow: var(--shadow-sm);
        border: 1px solid var(--gray-200);
    }

    .btn-secondary:hover {
        background-color: var(--gray-50);
        transform: translateY(-1px);
        box-shadow: var(--shadow-md);
    }

    .form-container {
        background-color: white;
        padding: 2rem;
        border-radius: 12px;
        box-shadow: var(--shadow-sm);
        border: 1px solid var(--gray-200);
        max-width: 800px;
        margin: 0 auto;
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-group label {
        display: block;
        font-weight: 600;
        font-size: 0.875rem;
        color: var(--gray-700);
        margin-bottom: 0.5rem;
        text-transform: uppercase;
        letter-spacing: 0.025em;
    }

    .required {
        color: var(--primary-red);
        font-weight: 700;
    }

    .form-group input[type="text"],
    .form-group textarea {
        width: 100%;
        padding: 0.75rem 1rem;
        border: 1.5px solid var(--gray-300);
        border-radius: 8px;
        font-size: 0.875rem;
        transition: all 0.2s ease;
        background-color: white;
        color: var(--gray-800);
        font-family: inherit;
    }

    .form-group input[type="text"]:focus,
    .form-group textarea:focus {
        outline: none;
        border-color: var(--primary-red);
        box-shadow: 0 0 0 3px rgba(220, 38, 38, 0.1);
    }

    .form-group textarea {
        resize: vertical;
        min-height: 100px;
    }

    .form-group small {
        display: block;
        margin-top: 0.5rem;
        font-size: 0.813rem;
        color: var(--gray-500);
        font-style: italic;
    }

    .error-message {
        display: block;
        margin-top: 0.5rem;
        font-size: 0.813rem;
        color: var(--primary-red);
        font-weight: 500;
    }

    .form-actions {
        margin-top: 2rem;
        padding-top: 1.5rem;
        border-top: 1px solid var(--gray-200);
        display: flex;
        gap: 0.75rem;
        justify-content: flex-end;
    }

    /* Icon untuk button */
    .btn::before {
        font-size: 1rem;
        line-height: 1;
    }

    .page-header .btn-secondary::before {
        content: '←';
        font-weight: bold;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .page-header {
            flex-direction: column;
            align-items: flex-start;
        }

        .form-container {
            padding: 1.5rem;
        }

        .form-actions {
            flex-direction: column-reverse;
        }

        .btn {
            width: 100%;
            justify-content: center;
        }
    }

    /* Input placeholder styling */
    .form-group input::placeholder,
    .form-group textarea::placeholder {
        color: var(--gray-400);
    }

    /* Focus visible untuk accessibility */
    .btn:focus-visible,
    input:focus-visible,
    textarea:focus-visible {
        outline: 2px solid var(--primary-red);
        outline-offset: 2px;
    }

    /* Edit mode indicator */
    .form-container::before {
        content: '';
        display: block;
        width: 4px;
        height: 100%;
        background: linear-gradient(180deg, var(--primary-red) 0%, var(--red-hover) 100%);
        position: absolute;
        left: 0;
        top: 0;
        border-radius: 12px 0 0 12px;
    }

    .form-container {
        position: relative;
    }
</style>

<div class="page-header">
    <h2>Edit Kategori: {{ $category->name }}</h2>
    <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">Kembali</a>
</div>

<div class="form-container">
    <form method="POST" action="{{ route('admin.categories.update', $category->id) }}">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label for="name">Nama Kategori <span class="required">*</span></label>
            <input type="text" name="name" id="name" value="{{ old('name', $category->name) }}" required placeholder="Contoh: Fiksi, Non-Fiksi, Teknologi">
            @error('name')
                <span class="error-message">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="description">Deskripsi</label>
            <textarea name="description" id="description" rows="4" placeholder="Jelaskan kategori ini (opsional)">{{ old('description', $category->description) }}</textarea>
            <small>Opsional - Jelaskan kategori ini</small>
            @error('description')
                <span class="error-message">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-actions">
            <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">Batal</a>
            <button type="submit" class="btn btn-primary">Update Kategori</button>
        </div>
    </form>
</div>

@endsection