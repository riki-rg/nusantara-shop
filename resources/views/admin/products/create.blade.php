@extends('layouts.app')

@section('title', 'Tambah Produk')

@section('content')
    <h1 class="text-2xl font-bold mb-6">📦 Produk Baru</h1>

    <form method="POST" action="{{ route('admin.products.store') }}" class="bg-white rounded-lg shadow-sm border p-6 space-y-4 max-w-2xl">
        @csrf
        @include('admin.products._form')
        <button class="px-6 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700">Simpan</button>
    </form>
@endsection
