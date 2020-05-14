@extends('admin.layout.app')

@section('title', "Editar Produto {$product->name}")

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-8">
                <h1>Editar Produto: {{ $product->name }}</h1>
                <form action="{{ route('products.update', $product->id) }}" method="post" enctype="multipart/form-data">
                    @method('PUT')
                    @include('admin.pages.products._partials.form')
                </form>
            </div>
        </div>
    </div>

    
@endsection
