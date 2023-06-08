@extends('layouts.main')

@section('content')
    <div class="card mt-3 col-lg-6 ">
        <div class="card-header">
            <button type="button" class="btn btn-sm btn-warning" onclick="window.location='{{ url('products') }}'">
                Back to data
            </button>
        </div>
        <div class="card-body">
            <form action="{{ url('products/'.$id) }}" method="post">
                @csrf
                {{-- hhtp scopping --}}
                @method('PUT')
                <div class="row mb-3">
                    <label for="code_product" class="col-sm-2 col-form-label">Code Products</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control-plaintext " id="code_product" name="code_product" value="{{ $code_product }}" readonly>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="name" class="col-sm-2 col-form-label">Products Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ $name }}">
                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="price" class="col-sm-2 col-form-label">Price</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control @error('price') is-invalid @enderror" id="price" name="price" value="{{ $price }}">
                        @error('price')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="quantity" class="col-sm-2 col-form-label">Quantity</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control @error('quantity') is-invalid @enderror" id="quantity" name="quantity" value="{{ $quantity }}">
                        @error('quantity')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <button type="submit" class="btn btn-sm btn-success">Update</button>
            </form>
        </div>
    </div>
@endsection
