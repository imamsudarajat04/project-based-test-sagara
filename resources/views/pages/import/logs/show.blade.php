@extends('layouts.DashboardLayout')

@section('title', 'Import')
@section('import', 'active')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Import</h1>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="card shadow mb-4">

                <!-- Card Body -->
                <div class="card-body">
                    <h1>Import Log #{{ $log->id }}</h1>
                    <p>Status: {{ $log->status }}</p>
                    <p>File Path: {{ $log->file_path }}</p>
                    <p>Rows Success: {{ $log->rows_success }}</p>
                    <p>Rows Failed: {{ $log->rows_failed }}</p>
                    <p>Duration: {{ $log->created_at->diffForHumans($log->updated_at) }}</p>
                    <p>Error Log:</p>
                    <pre>{{ $log->error_log }}</pre>
                </div>
            </div>
        </div>
    </div>
@endsection