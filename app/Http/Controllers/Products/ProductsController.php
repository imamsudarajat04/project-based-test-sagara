<?php

namespace App\Http\Controllers\Products;

use App\Models\Tags;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\ProductsRepository;
use Yajra\DataTables\Facades\DataTables;
use RealRashid\SweetAlert\Facades\Alert;

class ProductsController extends Controller
{
    /**
     * The repository instance.
     */
    protected $productsRepository;

    /**
     * Constructor to bind repository to this controller
     */
    public function __construct(ProductsRepository $productsRepository)
    {
        $this->productsRepository = $productsRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Check if request is ajax
        if(request()->ajax()) {
            $query = $this->productsRepository->index();

            return DataTables::of($query)
                ->addColumn('action', function ($model) {
                    return view('pages.products.column.action', compact('model'));
                })
                ->editColumn('purchasing_price', function ($model) {
                    return 'Rp. '.number_format($model->purchasing_price, 0, ',', '.');
                })
                ->editColumn('selling_price', function ($model) {
                    return 'Rp. '.number_format($model->selling_price, 0, ',', '.');
                })
                ->addColumn('tags', function ($model) {
                    return $model->tags->map(function ($tag) {
                        return '<span class="badge badge-pill badge-primary">' . $tag->name . '</span>';
                    })->implode(' ');
                })
                ->rawColumns(['action', 'purchasing_price', 'selling_price', 'tags'])
                ->addIndexColumn()
                ->make();
        }
        return view('pages.products.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Get all tags
        $tags = Tags::all();

        // Return the view
        return view('pages.products.create', compact('tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request
        $validate = $request->validate([
            'name' => 'required',
            'purchasing_price' => 'required',
            'selling_price' => 'required',
            'quantity' => 'required',
            'description' => 'required',
            'tags' => 'required',
        ], [
            'tags.required' => 'The tags field is required.',
            'name.required' => 'The name field is required.',
            'purchasing_price.required' => 'The purchasing price field is required.',
            'selling_price.required' => 'The selling price field is required.',
            'description.required' => 'The description field is required.',
            'quantity.required' => 'The stock field is required.',
        ]);

        // Store the data
        $this->productsRepository->store($validate);

        // Alert message
        Alert::success('Success', 'Product created');
        return redirect()->route('products.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Get the tags
        $tags = Tags::all();

        // Get the product
        $product = $this->productsRepository->edit($id);

        // Return the view
        return view('pages.products.edit', compact('product', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate the request
        $validate = $request->validate([
            'name' => 'required',
            'purchasing_price' => 'required',
            'selling_price' => 'required',
            'quantity' => 'required',
            'description' => 'required',
            'tags' => 'required',
        ], [
            'tags.required' => 'The tags field is required.',
            'name.required' => 'The name field is required.',
            'purchasing_price.required' => 'The purchasing price field is required.',
            'selling_price.required' => 'The selling price field is required.',
            'description.required' => 'The description field is required.',
            'quantity.required' => 'The stock field is required.',
        ]);

        // Update the data
        $this->productsRepository->update($validate, $id);

        // Alert message
        Alert::success('Success', 'Product updated');
        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Delete the data
        $this->productsRepository->delete($id);
    }
}
