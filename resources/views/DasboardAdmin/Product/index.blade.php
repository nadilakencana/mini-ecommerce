@extends('DasboardAdmin.LayouteMaster.masterLayout')
@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Data Product</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Data Product</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">

            <div class="card-header d-flex justify-content-between">
                <p>Data Product</p>
               <a href="{{ route('product.create') }}" class="btn btn-success">Create New Data</a>
            </div>
            <div class="card-body">
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>
                                Product
                            </th>
                            <th>Harga</th>
                            <th>Kategori</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = 1;
                        @endphp

                        @foreach ($product as $pro )
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>
                                    <div class="product">
                                        <p class="nama-product">{{ $pro->nama }}</p>
                                        <div class="image-product">
                                            <img class="Image-product" src="{{asset('assets/images/product/'.$pro->image)  }}"/>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    {{ $pro->harga}}
                                </td>
                                <td>
                                    {{ $pro->kategori->nama}}
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <a href="" class="btn btn-success mx-2">Detail</a>
                                        <a href="{{ route('product.edit', encrypt($pro->id)) }}" class="btn btn-primary mx-2">Edit</a>
                                        <form action="{{ route('product.destroy', encrypt($pro->id)) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger">Hapus</button>
                                        </form>

                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </section>
</div>
@endsection
