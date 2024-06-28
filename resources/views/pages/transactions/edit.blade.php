@extends('layouts.DashboardLayout')

@section('title', 'Create Transaction')

@section('transactions', 'active')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit transaction</h1>
        <a href="{!! route('transactions.index') !!}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-caret-left"></i> Back</a>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="card shadow mb-4">

                <!-- Card Body -->
                <div class="card-body">
                    <form action="{!! route('transactions.update', $transaction->id) !!}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="user_id" value="{!! Auth()->user()->id !!}">
                        <div class="form-group">
                            <div class="row">
                                <label class="col-12 control-label">Product Name</label>
                                <div class="col-12">
                                    <select name="product_id" class="form-control {{ $errors->has('product_id') ? ' is-invalid' : '' }}">
                                        @foreach ($products as $product)
                                            <option value="{{ $product->id }}" {!! $transaction->product_id == $product->id ? 'selected' : '' !!}>{{ $product->name }}</option>
                                        @endforeach
                                    </select>

                                    @error('product_id')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label class="col-12 control-label">Service Name</label>
                                <div class="col-12">
                                    <select name="service_id" class="form-control {{ $errors->has('service_id') ? ' is-invalid' : '' }}">
                                        @foreach ($services as $service)
                                            <option value="{{ $service->id }}" {!! $transaction->service_id == $service->id ? 'selected' : '' !!}>{{ $service->name }}</option>
                                        @endforeach
                                    </select>

                                    @error('service_id')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label class="col-12 control-label">Costumer Name</label>
                                <div class="col-12">
                                    <input type="text" class="form-control {{ $errors->has('customer_name') ? ' is-invalid' : '' }}" name="customer_name" placeholder="Insert Customer Name.." value="{{ old('customer_name', $transaction->customer_name) }}">

                                    @error('customer_name')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label class="col-12 control-label">Quantity</label>
                                <div class="col-12">
                                    <input type="number" class="form-control {{ $errors->has('quantity') ? ' is-invalid' : '' }}" name="quantity" placeholder="Insert Quantity.." value="{{ old('quantity', $transaction->quantity) }}">

                                    @error('quantity')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label class="col-12 control-label">Total</label>
                                <div class="col-12">
                                    <input type="number" class="form-control {{ $errors->has('total') ? ' is-invalid' : '' }}" name="total" placeholder="Insert Total.." value="{{ old('total', $transaction->total) }}">

                                    @error('total')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label class="col-12 control-label">Status</label>
                                <div class="col-12">
                                    <select name="status" class="form-control {{ $errors->has('status') ? ' is-invalid' : '' }}">
                                        <option value="pending" {!! $transaction->status == 'pending' ? 'selected' : '' !!}>Pending</option>
                                        <option value="completed" {!! $transaction->status == 'completed' ? 'selected' : '' !!}>Completed</option>
                                        <option value="cancelled" {!! $transaction->status == 'cancelled' ? 'selected' : '' !!}>Cancelled</option>
                                    </select>

                                    @error('status')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="row">
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary btn-block"><i class="fas fa-edit"></i> Edit Transaction</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection