<?php

namespace App\Http\Controllers\Services;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\ServicesRepository;
use Yajra\DataTables\Facades\DataTables;
use RealRashid\SweetAlert\Facades\Alert;

class ServicesController extends Controller
{
    /**
     * The repository instance.
     */
    protected $servicesRepository;

    /**
     * Constructor to bind repository to this controller
     */
    public function __construct(ServicesRepository $servicesRepository)
    {
        $this->servicesRepository = $servicesRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Check if request is ajax
        if(request()->ajax()) {
            $query = $this->servicesRepository->index();

            return DataTables::of($query)
                ->addColumn('action', function ($model) {
                    return view('pages.services.column.action', compact('model'));
                })
                ->editColumn('base_price', function ($model) {
                    return 'Rp. '.number_format($model->base_price, 0, ',', '.');
                })
                ->editColumn('selling_price', function ($model) {
                    return 'Rp. '.number_format($model->selling_price, 0, ',', '.');
                })
                ->rawColumns(['action', 'base_price', 'selling_price'])
                ->addIndexColumn()
                ->make();
        }
        return view('pages.services.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.services.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request
        $validate = $request->validate([
            'name'          => 'required',
            'base_price'    => 'required|numeric',
            'selling_price' => 'required|numeric',
            'description'   => 'required',
        ], [
            'name.required'          => 'The name field is required.',
            'base_price.required'    => 'The base price field is required.',
            'base_price.numeric'     => 'The base price field must be a number.',
            'selling_price.required' => 'The selling price field is required.',
            'selling_price.numeric'  => 'The selling price field must be a number.',
            'description.required'   => 'The description field is required.',
        ]);

        // Store the service
        $this->servicesRepository->store($validate);

        // Alert
        Alert::success('Success', 'Service created successfully');
        return redirect()->route('services.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Find the service
        $service = $this->servicesRepository->edit($id);

        return view('pages.services.edit', compact('service'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate the request
        $validate = $request->validate([
            'name'          => 'required',
            'base_price'    => 'required|numeric',
            'selling_price' => 'required|numeric',
            'description'   => 'required',
        ], [
            'name.required'          => 'The name field is required.',
            'base_price.required'    => 'The base price field is required.',
            'base_price.numeric'     => 'The base price field must be a number.',
            'selling_price.required' => 'The selling price field is required.',
            'selling_price.numeric'  => 'The selling price field must be a number.',
            'description.required'   => 'The description field is required.',
        ]);

        // Update the service
        $this->servicesRepository->update($validate, $id);

        // Alert
        Alert::success('Success', 'Service updated successfully');
        return redirect()->route('services.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Delete the service
        $this->servicesRepository->delete($id);
    }
}
