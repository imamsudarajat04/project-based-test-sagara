<?php

namespace App\Http\Controllers\Tags;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\TagsRepository;
use Yajra\DataTables\Facades\DataTables;
use RealRashid\SweetAlert\Facades\Alert;

class TagsController extends Controller
{
    /*8
     * The repository instance.
     */
    protected $tagsRepository;

    /**
     * Constructor to bind repository to this controller
     */
    public function __construct(TagsRepository $tagsRepository)
    {
        $this->tagsRepository = $tagsRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Check if request is ajax
        if(request()->ajax()) {
            $query = $this->tagsRepository->index();

            return DataTables::of($query)
                ->addColumn('action', function ($model) {
                    return view('pages.tags.column.action', compact('model'));
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make();
        }
        return view('pages.tags.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.tags.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request
        $validate = $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'required|string|max:255'
        ]);

        // Store the tag
        $this->tagsRepository->store($validate);

        // Alert
        Alert::success('Success', 'Tag created successfully');
        return redirect()->route('tags.index');
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
        // Get the tag
        $tag = $this->tagsRepository->edit($id);

        return view('pages.tags.edit', compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate the request
        $validate = $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'required|string|max:255'
        ]);

        // Update the tag
        $this->tagsRepository->update($validate, $id);

        // Alert
        Alert::success('Success', 'Tag updated successfully');
        return redirect()->route('tags.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Delete the tag
        $this->tagsRepository->delete($id);
    }
}
