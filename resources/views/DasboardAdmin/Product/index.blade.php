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
                                        <div  class="btn btn-success mx-2 block detail"
                                        data-bs-toggle="modal" data-bs-target="#default-{{ $pro->id }}">Detail</div>
                                        <a href="{{ route('product.edit', encrypt($pro->id)) }}" class="btn btn-primary mx-2">Edit</a>
                                        
                                        <a href="{{ route('delete-product', encrypt($pro->id)) }}" class="btn btn-danger">Hapus</a>
                                        

                                    </div>
                                    <div class="modal fade text-left" id="default-{{ $pro->id }}" tabindex="-1" role="dialog"
                                        aria-labelledby="myModalLabel1" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-scrollable" role="document">
                                            <div class="modal-content" style="width: 600px">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="myModalLabel1">Detail Product</h5>
                                                    <button type="button" class="close rounded-pill" data-bs-dismiss="modal"
                                                        aria-label="Close">
                                                        <i data-feather="x"></i>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="detail-product">
                                                        <div class="row">
                                                            <div class="data-product d-flex gap-4">
                                                                <label for="" style="width: 50%">Name Product</label>
                                                                <div class="dt-product">: {{ $pro->nama }}</div>
                                                            </div>
                                                            <div class="data-product d-flex gap-4">
                                                                <label for="" style="width: 50%">Category Product</label>
                                                                <div class="dt-product">: {{ $pro->kategori->nama }}</div>
                                                            </div>
                                                            <div class="data-product d-flex gap-4">
                                                                <label for="" style="width: 50%">Price Product</label>
                                                                <div class="dt-product">: Rp. {{number_format( $pro->harga, 0, ',','.')}}</div>
                                                            </div>
                                                            <div class="data-product d-flex gap-4">
                                                                <label for="" style="width: 50%">Color Product</label>
                                                                <div class="dt-product">:
                                                                    <ul>
                                                                        @foreach ($pro->warna as $color )
                                                                            <li>{{ $color->warna }}</li>
                                                                        @endforeach

                                                                    </ul>
                                                                </div>

                                                            </div>
                                                            <div class="data-product d-flex gap-4">
                                                                <label for="" style="width: 50%">Size Product</label>
                                                                <div class="dt-product">:
                                                                    <ul>
                                                                        @foreach ($pro->ukuran as $size )
                                                                            <li>{{ $size->ukuran }}</li>
                                                                        @endforeach

                                                                    </ul>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn" data-bs-dismiss="modal">
                                                        <i class="bx bx-x d-block d-sm-none"></i>
                                                        <span class="d-none d-sm-block">Close</span>
                                                    </button>


                                                </div>
                                            </div>
                                        </div>
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
