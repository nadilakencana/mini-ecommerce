@extends('DasboardAdmin.LayouteMaster.masterLayout')
@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Data Order</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Data Order
                        <li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">

            <div class="card-header d-flex justify-content-between">
                <p>Data Order</p>

            </div>
            <div class="card-body">
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>
                                Kode Order
                            </th>
                            <th>Customer Name</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $no = 1;
                        @endphp

                        @foreach ($order as $orders )
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $orders->kode_order }}</td>
                            <td>{{ $orders->user->name }}</td>
                            <td>RP. {{number_format( $orders->total, 0, ',','.')}}</td>
                            <td>{{ $orders->status }}</td>
                            <td>
                                <div class="d-flex">
                                    <button class="btn btn-success mx-2" data-bs-toggle="modal"
                                        data-bs-target="#staticBackdrop-{{ $orders->id }}">Detail</button>
                                    <a href="{{ route('delete_order', encrypt($orders->id)) }}"
                                        class="btn btn-danger mx-2">Delete</a>
                                    <a href="{{ route('Invoice', encrypt($orders->id)) }}"
                                        class="btn btn-primary mx-2">Invoice</a>



                                    <div class="modal fade" id="staticBackdrop-{{ $orders->id }}"
                                        data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                        aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog" style="width: 718px;max-width: 800px;">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Detail Order
                                                    </h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="content-order" data-id="{{ $orders->id }}">
                                                        <div class="row detail-customer">
                                                            <div class="col-md-6">
                                                                <div class="data-customer d-flex gap-2">
                                                                    <lebel class="lebel" style="width: 50%">Customer
                                                                        Name
                                                                    </lebel>
                                                                    <div class="data">: {{ $orders->user->name }}</div>
                                                                </div>
                                                                <div class="data-customer d-flex gap-2">
                                                                    <lebel class="lebel" style="width: 50%">Phone Number
                                                                    </lebel>
                                                                    <div class="data">: {{ $orders->user->no_hp }}</div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="data-customer d-flex gap-2">
                                                                    <lebel class="lebel" style="width: 50%">Alamat
                                                                    </lebel>
                                                                    <div class="data">: {{ $orders->user->alamat }}
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>

                                                        <table class="table w-100">
                                                            <thead>
                                                                <tr>
                                                                    <th>Product</th>
                                                                    <th>Qty</th>
                                                                    <th>Price</th>
                                                                    <th>Total</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($orders->details as $itm)
                                                                <tr>
                                                                    <td>
                                                                        <div class="product-spk">
                                                                            <lebel class="name">{{ $itm->product->nama
                                                                                }}
                                                                            </lebel>
                                                                            <div class="spesifikasi">
                                                                                <div class="spk-product d-flex gap-2">
                                                                                    <small for="">Uk</small>
                                                                                    <small>: {{
                                                                                        $itm->variasiUkuran->ukuran
                                                                                        }}</small>
                                                                                </div>
                                                                                <div class="spk-product d-flex gap-2">
                                                                                    <small for="">Color</small>
                                                                                    <small>: {{
                                                                                        $itm->variasiWarna->warna
                                                                                        }}</small>
                                                                                </div>

                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td>{{ $itm->qty }}</td>
                                                                    <td>Rp. {{number_format( $itm->harga_product, 0,
                                                                        ',','.')}}</td>
                                                                    <td>Rp. {{number_format( $itm->total_item, 0,
                                                                        ',','.')}}
                                                                    </td>
                                                                </tr>
                                                                @endforeach

                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">
                                                            Close
                                                        </button>
                                                        @if ($orders->status == 'OnProses')
                                                        <div class="btn btn-primary ml-1 accept"
                                                            data-id="{{ $orders->id }}" data-bs-dismiss="modal">
                                                            <i class="bx bx-check d-block d-sm-none"></i>
                                                            <span class="d-none d-sm-block ">Accept Order</span>
                                                        </div>
                                                        @elseif($orders->status == 'Order Accept')
                                                        <div class="btn btn-success ml-1 finish"
                                                            data-id="{{ $orders->id }}" data-bs-dismiss="modal">
                                                            <i class="bx bx-check d-block d-sm-none"></i>
                                                            <span class="d-none d-sm-block">Finish</span>
                                                        </div>
                                                        @endif

                                                    </div>
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
@section('script')
<script>
    $(()=>{


        $('.accept').on('click', function(){
            var id = $(this).attr('data-id');
            UpdateStatus(id, 'accept')
        });

        $('.finish').on('click', function(){
            var id = $(this).attr('data-id');
            UpdateStatus(id, 'finish')
        });



        function UpdateStatus(id, type){

            var url ="{{ route('AcceptOrder', '') }}"+ '/'+ id;

            if(type == 'finish'){
                 var url ="{{ route('Finish', '') }}"+ '/'+ id;
            }

            $.ajax({

                url : url,
                method: 'POST',
                type: 'json',
                data:{
                    _token : "{{ csrf_token() }}"
                },

                success: function(data){
                    console.log(data);
                    location.reload();
                }

            }).fail(function(data){

                console.log(data);

            })
        }
    })
</script>
@stop
