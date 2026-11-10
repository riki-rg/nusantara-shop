@extends('layouts.app')

@section('title', 'Edit Produk')

@section('content')
    <h1 class="text-2xl font-bold mb-6">✏️ Edit: {{ $product->name }}</h1>

    <form method="POST" action="{{ route('admin.products.update', $product) }}" class="bg-white rounded-lg shadow-sm border p-6 space-y-4 max-w-2xl">
        @csrf @method('PUT')
        @include('admin.products._form')
        <button class="px-6 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700">Perbarui</button>
    </form>
@endsection
