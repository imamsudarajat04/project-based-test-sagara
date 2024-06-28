<?php

namespace App\Http\Controllers\Import;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ImportLog;
use Illuminate\Support\Facades\Storage;

class ImportLogController extends Controller
{
    public function index()
    {
        $logs = ImportLog::all();
        return view('pages.import.logs.index', compact('logs'));
    }

    public function show(ImportLog $log)
    {
        return view('pages.import.logs.show', compact('log'));
    }

    public function download(ImportLog $log)
    {
        return Storage::download($log->file_path);
    }

    public function downloadFailed(ImportLog $log)
    {
        return Storage::download($log->failed_file_path);
    }
}
