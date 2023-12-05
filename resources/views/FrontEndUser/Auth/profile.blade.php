@extends('FrontEndUser.Layout.master_layoute')
@section('title', 'Profile')
@section('content')

<div class="section profile">
    <div class="header-profile d-flex gap-5 align-items-center">
        <div class="col-lg-3 col-sm-12">
            <div class="image-profile">
                @if($profile->image === null)
                <img src="{{ asset('assets/images/faces/5.jpg') }}" alt="" class="img-fluid img-user">
                @else
                <img src="{{ asset('assets/images/Profile_User/'.$profile->image) }}" alt="" class="img-fluid img-user">
                @endif
            </div>
        </div>
        <div class="col-lg-9 col-sm-12">
            <div class="data-user">
                <label for="" class="mb-2">{{ $profile->name }}</label>
                <div class="cl-grey mb-2">{{ $profile->no_hp }}</div>
                <div class="cl-grey mb-2">{{ $profile->email }}</div>
                <div class="cl-grey mb-2">{{ $profile->alamat }}</div>
            </div>
        </div>


    </div>
    <div class="pannel-profile pt-5 border-bottom">
        <div class="list-pannel d-flex gap-3 mb-3 mt-3">
            <div class="btn btn-dark box-pannel" order="1" target="panel1">Update Data</div>
            <div class="btn btn-dark box-pannel" order="2" target="panel2">History Order</div>
            <a href="{{ route('logout-user') }}"><div class="btn btn-dark">Logout</div></a>
        </div>
    </div>
    <div class="tab-panel">
        {{-- profile --}}
        <div class="panel mt-4" data-panel="panel1" panel-order="1" style="display: block;">
            <h4 class="cl-dark">Update Data Profile</h4>
            <form class="form" action="{{ route('updateProfile', $profile->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="first-name-column">Name</label>
                            <input type="text" id="first-name-column"
                                class="form-control @error('name') is-invalid @enderror" placeholder="Youre Name"
                                name="name" value="{{ $profile->name }}">
                            @error('name')
                            <small class="invalid-feedback">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="last-name-column">Email</label>
                            <input type="email" id="last-name-column"
                                class="form-control @error('email') is-invalid @enderror" placeholder="Email"
                                name="email" value="{{ $profile->email }}">
                            @error('email')
                            <small class="invalid-feedback">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="last-name-column">Phone</label>
                            <input type="number" id="last-name-column"
                                class="form-control @error('no_hp') is-invalid @enderror" placeholder="Youre phone"
                                name="no_hp" value="{{ $profile->no_hp }}">
                            @error('no_hp')
                            <small class="invalid-feedback">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="last-name-column">Addres</label>
                            <textarea type="text" id="last-name-column"
                                class="form-control @error('alamat') is-invalid @enderror" placeholder="Address"
                                name="alamat">{{ $profile->alamat }}</textarea>
                            @error('alamat')
                            <small class="invalid-feedback">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="last-name-column">Image Profile</label>
                            <input type="file" id="last-name-column"
                                class="form-control @error('image') is-invalid @enderror" placeholder="Youre Profile Image"
                                name="image" value="{{ $profile->image }}">
                            @error('image')
                            <small class="invalid-feedback">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="col-12 d-flex justify-content-end mt-3">
                        <button type="submit" class="btn btn-dark me-1 mb-1">Update Profile</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="panel mt-4" data-panel="panel2" panel-order="2">
            <h4 class="cl-dark">History Order</h4>
            <div class="content-history d-flex flex-grow gap-3">
                @foreach ($order as $ord)
                <div class="card p-3">
                    <div class="body-card">
                        <div class="dt-orde d-flex gap-3">
                            <label for="">Kode Order</label>
                            <div class="text-dt">: {{ $ord->kode_order }}</div>
                        </div>
                        <div class="dt-orde d-flex gap-3">
                            <label for="">Total Order</label>
                            <div class="text-dt">: Rp. {{number_format( $ord->total, 0, ',','.')}}</div>
                        </div>
                    </div>
                    <div class="footer text-end mt-4">
                        <div class="btn btn-dark text-end" data-bs-toggle="modal" data-bs-target="#staticBackdrop-{{ $ord->id }}">Detail</div>
                    </div>
                </div>
                <div class="modal fade" id="staticBackdrop-{{ $ord->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog w-75">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Detail Order</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
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
                                        @foreach ($ord->details as $detail)
                                            <tr>
                                                <td>
                                                    <div class="product-detail">
                                                        <p class="cl-dark">{{ $detail->product->nama }}</p>
                                                        <div class="img-product" style="width: 30%">
                                                            <img src="{{ asset('assets/images/product/'.$detail->product->image) }}" alt="" class=" rounded-3 img-fluid">
                                                        </div>
                                                        <div class="varian">
                                                            <div class="var d-flex gap-3">
                                                                <label for="">Color</label>
                                                                <div class="var-product">: {{ $detail->variasiWarna->warna }}</div>
                                                            </div>
                                                            <div class="var d-flex gap-3">
                                                                <label for="">Size</label>
                                                                <div class="var-product">: {{ $detail->variasiUkuran->ukuran }}</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>{{ $detail->qty }}</td>
                                                <td>Rp. {{ number_format ($detail->harga_product, 0,',', '.') }}</td>
                                                <td>Rp. {{ number_format($detail->total_item, 0, ',', '.' )}}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach

            </div>
        </div>
    </div>
</div>
@stop
@section('script')
<script>
    $(()=>{
        $('.box-pannel').on('click', function(e) {
            var target = $(this).attr('target');
            $('.box-pannel').removeClass('active');
            $(this).addClass('active');

            $('.panel').hide();
            console.log();
            $(`.panel[data-panel="${target}"]`).show();
        });
    })
</script>
@stop
