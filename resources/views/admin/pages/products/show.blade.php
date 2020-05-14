@extends('admin.layout.app')

@section('title', "Detalhes do produto {$product->name}")

@section('content')

<h1>Produto {{ $product->name }} <a href="{{ route('products.index') }}"><<</a></h1>

<ul>
    @if ($product->image)
        <img width="80" src="{{ url("storage/{$product->image}") }}" alt="{{ $product->name }}" style="max-width: 100px;">
    @endif
    <li><strong>Nome: </strong>{{ $product->name }}</li>
    <li><strong>Preço: </strong>{{ $product->price }}</li>
    <li><strong>Descrição: </strong>{{ $product->description }}</li>
</ul>

<form action="{{ route('products.destroy', $product->id) }}" method="post">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger">Deletar o produto: {{ $product->name }}</button>
</form>

@endsection
