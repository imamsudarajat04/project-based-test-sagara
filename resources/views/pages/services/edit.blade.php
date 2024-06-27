@extends('layouts.DashboardLayout')

@section('title', 'Edit Service')

@section('services', 'active')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit service</h1>
        <a href="{!! route('services.index') !!}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-caret-left"></i> Back</a>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="card shadow mb-4">

                <!-- Card Body -->
                <div class="card-body">
                    <form action="{!! route('services.update', $service->id) !!}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <div class="row">
                                <label class="col-12 control-label">Name Service</label>
                                <div class="col-12">
                                    <input type="text" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" placeholder="Insert Name Service.." value="{{ old('name', $service->name) }}">

                                    @error('name')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label class="col-12 control-label">Base Price</label>
                                <div class="col-12">
                                    <input type="number" class="form-control {{ $errors->has('base_price') ? ' is-invalid' : '' }}" name="base_price" placeholder="Insert Base Price.." value="{{ old('base_price', $service->base_price) }}">

                                    @error('base_price')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label class="col-12 control-label">Selling Price</label>
                                <div class="col-12">
                                    <input type="number" class="form-control {{ $errors->has('selling_price') ? ' is-invalid' : '' }}" name="selling_price" placeholder="Insert Selling Price.." value="{{ old('selling_price', $service->selling_price) }}">

                                    @error('selling_price')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label class="col-12 control-label">Description</label>
                                <div class="col-12">
                                    <textarea name="description" class="form-control {{ $errors->has('description') ? ' is-invalid' : '' }}" cols="30" rows="5" placeholder="Insert Description..">{{ old('description', $service->description) }}</textarea>

                                    @error('description')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="row">
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary btn-block"><i class="fas fa-edit"></i> Edit Service</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection