@extends('admin.layout.app')

@section('title', 'Gestão de Produtos')

@section('content')
<div class="container">

    <div class="center mb-4" style="margin-left: 17%;">
        <h1>Exibindo os produtos</h1>
        <a href="{{ route('products.create') }}" class="btn btn-primary">Cadastrar</a>
    </div>

    <div class="row justify-content-center">
        <div class="col-8">
            <form action="{{ route('products.search') }}" method="post" class="form form-inline mb-3">
                @csrf
                <input type="text" name="filter" placeholder="Filtrar:" class="form-control" value="{{ $filters['filter'] ?? '' }}">
                <button type="submit" class="btn btn-secondary">Pesquisar</button>
            </form>

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Imagem</th>
                        <th>Nome</th>
                        <th>Preço</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td>
                                @if ($product->image)
                                    <img width="80" src="{{ url("storage/{$product->image}") }}" alt="{{ $product->name }}" style="max-width: 100px;">
                                @endif
                            </td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->price }}</td>
                            <td>
                                <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning">Editar</a>
                                <a href="{{ route('products.show', $product->id) }}" class="btn btn-info">Detalhes</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            @if (isset($filters))
                {!! $products->appends($filters)->links() !!}
            @else
                {!! $products->links() !!}
            @endif
        </div>
    </div>
</div>
    
@endsection
