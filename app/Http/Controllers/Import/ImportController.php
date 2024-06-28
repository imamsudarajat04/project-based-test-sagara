<?php

namespace App\Http\Controllers\Import;

use App\Models\ImportLog;
use Illuminate\Http\Request;
use App\Jobs\ProcessImportJob;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class ImportController extends Controller
{
    public function index()
    {
        return view('pages.import.import');
    }

    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:csv,txt',
        ]);

        $filePath = $request->file('file')->store('imports');

        $importLog = ImportLog::create([
            'file_path' => $filePath,
            'status' => 'Processing',
        ]);

        ProcessImportJob::dispatch($importLog);

        Alert::success('Success', 'Your file is being processed. You will be notified once it is done.');
        return redirect()->route('import');
    }
}
