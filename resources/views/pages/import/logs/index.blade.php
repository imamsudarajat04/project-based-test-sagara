@extends('layouts.DashboardLayout')

@section('title', 'Import Logs')
@section('importLogs', 'active')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Import Logs</h1>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="card shadow mb-4">

                <!-- Card Body -->
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>File Path</th>
                                <th>Status</th>
                                <th>Rows Success</th>
                                <th>Rows Failed</th>
                                <th>Duration</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($logs as $log)
                            <tr>
                                <td>{{ $log->id }}</td>
                                <td>{{ $log->file_path }}</td>
                                <td>{{ $log->status }}</td>
                                <td>{{ $log->rows_success }}</td>
                                <td>{{ $log->rows_failed }}</td>
                                <td>{{ $log->created_at->diffForHumans($log->updated_at) }}</td>
                                <td>
                                    <a href="{{ route('import.logs.show', $log->id) }}" class="btn btn-info">View</a>
                                    <a href="{{ route('import.logs.download', $log->id) }}" class="btn btn-success">Download</a>
                                    @if($log->failed_file_path)
                                    <a href="{{ route('import.logs.download.failed', $log->id) }}" class="btn btn-warning">Download Failed Rows</a>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection