@extends('layouts.main')

@section('content')
    <h3>Data Products</h3>
    <div class="card mt-3">
        <div class="card-header">
            <button type="button" class="btn btn-sm btn-primary" onclick="window.location='{{ url('products/add') }}'">
                <i class="fa-solid fa-square-plus"></i> Add new data
            </button>
        </div>
        <div class="card-body">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <form action="" method="get">
                <div class="row mb-3">
                    <label for="search" class="col-sm-2 col-form-label">Search</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control form-control-sm" id="search" name="search" placeholder="Please type keyword" value="{{ $search }}">
                    </div>
                </div>
            </form>
            <table class="table table-sm table-striped table-bordered">
                <thead>
                    <th>No</th>
                    <th>Products Code</th>
                    <th>Products Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Aksi</th>
                </thead>

                <tbody>
                    @php
                        // untuk menyesuaikan nomor dengan halaman
                        $no = 1 + ($products->currentPage() - 1) * $products->perPage();
                    @endphp
                    @foreach ($products as $product)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td> {{ $product->code_product }}</td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->price }}</td>
                            <td>{{ $product->quantity }}</td>
                            <td>
                                <button onclick="window.location='{{ url('products/' . $product->id) }}'" type="button"
                                    class="btn btn-sm btn-warning" title="Edit data">
                                    <i class=" fas fa-edit"></i>
                                </button>
                                <form style="display:inline" action="{{ url('products/' . $product->id) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" title="Delete Data" class="btn btn-sm btn-danger"
                                        onclick="return confirm('Are You Sure ?')">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{-- pagination --}}
            {{-- {{ $products->links() }} --}}

            {{-- search --}}
            {!! $products->appends( Request::except('page'))->render() !!}
        </div>
    </div>
@endsection
