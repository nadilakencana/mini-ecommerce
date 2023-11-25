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

                        {{--  @foreach ($order as $orders )
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $orders->kode_order }}</td>
                            <td>{{ $orders->user->name }}</td>
                            <td>RP. {{number_format( $orders->total, 0, ',','.')}}</td>
                            <td>{{ $orders->status }}</td>
                            <td>
                                <div class="d-flex">
                                    <div data-id="{{ encrypt($orders->id) }}" class="btn btn-success mx-2 block detail"
                                        data-bs-toggle="modal" data-bs-target="#default">Detail</div>
                                    <a href="{{ route('delete_order', encrypt($orders->id)) }}" class="btn btn-danger mx-2">Delete</a>
                                    <a href="{{ route('Invoice', encrypt($orders->id)) }}" class="btn btn-primary mx-2">Invoice</a>
                                </div>
                            </td>
                            <div class="modal fade text-left" id="default" tabindex="-1" role="dialog"
                                aria-labelledby="myModalLabel1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-scrollable" role="document">
                                    <div class="modal-content" style="width: 600px">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="myModalLabel1">Detail Order</h5>
                                            <button type="button" class="close rounded-pill" data-bs-dismiss="modal"
                                                aria-label="Close">
                                                <i data-feather="x"></i>
                                            </button>
                                        </div>
                                        <div class="modal-body">

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn" data-bs-dismiss="modal">
                                                <i class="bx bx-x d-block d-sm-none"></i>
                                                <span class="d-none d-sm-block">Close</span>
                                            </button>
                                            @if ($orders->status == 'OnProses')
                                            <div  class="btn btn-primary ml-1 accept" data-id="{{ $orders->id }}"
                                                data-bs-dismiss="modal">
                                                <i class="bx bx-check d-block d-sm-none"></i>
                                                <span class="d-none d-sm-block ">Accept Order</span>
                                            </div>
                                            @elseif($orders->status == 'Order Accept')
                                            <div  class="btn btn-success ml-1 finish" data-id="{{ $orders->id }}"
                                                data-bs-dismiss="modal">
                                                <i class="bx bx-check d-block d-sm-none"></i>
                                                <span class="d-none d-sm-block">Finish</span>
                                            </div>
                                            @endif

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </tr>

                        @endforeach  --}}

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
        $('.btn.detail').on('click', function(){
            var id = $(this).attr('data-id');
            DataDetail(id)
        });

        $('.accept').on('click', function(){
            var id = $(this).attr('data-id');
            UpdateStatus(id, 'accept')
        });

        $('.finish').on('click', function(){
            var id = $(this).attr('data-id');
            UpdateStatus(id, 'finish')
        });

        function DataDetail(id){
            let URL ="{{ route('detail-order', '') }}"+"/"+id;
            $.get(URL,  function(result){
                $(result).appendTo('.modal-content .modal-body');
            }).fail(function(result){
                console.log(result);
            });
        }

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
