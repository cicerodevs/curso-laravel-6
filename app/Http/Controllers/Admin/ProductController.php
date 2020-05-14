<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StoreUpdateProductRequest;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;


class ProductController extends Controller
{

    protected $request;
    private $repository;

    public function __construct(Request $request, Product $product)
    {
        $this->request = $request;
        $this->repository = $product;

    }

    public function index()
    {
        $products = Product::latest()->paginate();

        return view('admin.pages.products.index', [
            'products' => $products,
        ]);
    }

    public function create()
    {
        return view('admin.pages.products.create');
    }

    public function store(StoreUpdateProductRequest $request)
    {
        $data = $request->only('name', 'description', 'price','image');

        if ($request->hasFile('image') && $request->image->isValid()) {
            $imagePath = $request->image->store('products');

            $data['image'] = $imagePath;
        }

        $this->repository->create($data);

        return redirect()->route('products.index');
    }

    public function show($id)
    {
        // $product = Product::where('id', $id)->first();
        if (!$product = $this->repository->find($id))
            return redirect()->back();

        return view('admin.pages.products.show', [
            'product' => $product
        ]);
    }

    public function edit($id)
    {
        if (!$product = $this->repository->find($id))
            return redirect()->back();

        return view('admin.pages.products.edit', compact('product'));
    }

    public function update(StoreUpdateProductRequest $request, $id)
    {
        if (!$product = $this->repository->find($id))
            return redirect()->back();

        $data = $request->all();

        if ($request->hasFile('image') && $request->image->isValid()) {

            if ($product->image && Storage::exists($product->image)) {
                Storage::delete($product->image);
            }

            $imagePath = $request->image->store('products');
            $data['image'] = $imagePath;
        }

        $product->update($data);

        return redirect()->route('products.index');
    }

    public function destroy($id)
    {
        $product = $this->repository->where('id', $id)->first();
        if (!$product)
            return redirect()->back();

        if ($product->image && Storage::exists($product->image)) {
            Storage::delete($product->image);
        }

        $product->delete();

        return redirect()->route('products.index');
    }

}