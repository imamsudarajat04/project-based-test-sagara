<?php

namespace App\Http\Controllers\Transactions;

use App\Models\User;
use App\Models\Products;
use App\Models\Services;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use RealRashid\SweetAlert\Facades\Alert;
use App\Repositories\TransactionsRepository;
use Illuminate\Support\Facades\Auth;

class TransactionsController extends Controller
{
    /**
     * The repository instance.
     */
    protected $transactionsRepository;

    /**
     * Constructor to bind repository to this controller
     */
    public function __construct(TransactionsRepository $transactionsRepository)
    {
        $this->transactionsRepository = $transactionsRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Check if request is ajax
        if(request()->ajax()) {
            $query = $this->transactionsRepository->index();

            return DataTables::of($query)
                ->addColumn('action', function ($model) {
                    return view('pages.transactions.column.action', compact('model'));
                })
                ->editColumn('total', function ($model) {
                    return 'Rp. '.number_format($model->total, 0, ',', '.');
                })
                ->editColumn('status', function ($model) {
                    if ($model->status == 'pending') {
                        return '<span class="badge badge-pill badge-warning">Pending</span>';
                    } elseif ($model->status == 'completed') {
                        return '<span class="badge badge-pill badge-success">Success</span>';
                    } else {
                        return '<span class="badge badge-pill badge-danger">Failed</span>';
                    }
                })
                ->addColumn('services', function ($model) {
                    return $model->services->name;
                })
                ->addColumn('products', function ($model) {
                    return $model->products->name;
                })
                ->addColumn('users', function ($model) {
                    return $model->users->name;
                })
                ->rawColumns(['action', 'total', 'status', 'services', 'products', 'users'])
                ->addIndexColumn()
                ->make();
        }
        return view('pages.transactions.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Get all products
        $products = Products::all();

        // Get all services
        $services = Services::all();

        // Get all users
        $users = User::all();

        // Return the view
        return view('pages.transactions.create', compact('products', 'services', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'total' => 'required',
            'status' => 'required',
            'service_id' => 'required',
            'product_id' => 'required',
            'user_id' => 'required', // Add this line
            'customer_name' => 'required',
            'quantity' => 'required',
        ], [
            'service_id.required' => 'The services field is required.',
            'product_id.required' => 'The products field is required.',
            'customer_name.required' => 'The customer name field is required.',
            'quantity.required' => 'The quantity field is required.',
            'total.required' => 'The total field is required.',
            'status.required' => 'The status field is required.',
        ]);

        // Create the transaction

        $this->transactionsRepository->store($validate);

        // Alert message
        Alert::success('Success', 'Transaction created');
        return redirect()->route('transactions.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Get the transaction
        $transaction = $this->transactionsRepository->edit($id);

        // Get all products
        $products = Products::all();

        // Get all services
        $services = Services::all();

        // View the edit form
        return view('pages.transactions.edit', compact('transaction', 'products', 'services'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate the request
        $validate = $request->validate([
            'total' => 'required',
            'status' => 'required',
            'service_id' => 'required',
            'product_id' => 'required',
            'customer_name' => 'required',
            'quantity' => 'required',
        ], [
            'service_id.required' => 'The services field is required.',
            'product_id.required' => 'The products field is required.',
            'customer_name.required' => 'The customer name field is required.',
            'quantity.required' => 'The quantity field is required.',
            'total.required' => 'The total field is required.',
            'status.required' => 'The status field is required.',
        ]);

        // Update the transaction
        $this->transactionsRepository->update($validate, $id);

        // Alert message
        Alert::success('Success', 'Transaction updated');
        return redirect()->route('transactions.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Delete the transaction
        $this->transactionsRepository->destroy($id);
    }
}
