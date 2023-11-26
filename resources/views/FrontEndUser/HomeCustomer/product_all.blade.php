@extends('FrontEndUser.Layout.master_layoute')
@section('title', 'All Product')
@section('content')
<div class="section">
    <div class="row ">
        <div class="col-md-12">
            <div class="label-header-section cl-dark d-flex align-items-center justify-content-between p-2 mb-3">
               <h2 class="cl-dark">All Product</h2>
            </div>
            <div class="act-btn-category d-flex gap-3 flex-row mb-4">
                @foreach ($kategori as $kat )
                    <a href="{{ route('product_cat', $kat->slug) }}" class="btn btn-dark">{{ $kat->nama }}</a>
                @endforeach
            </div>
            <div class="row product-section px-5">
                @foreach ($product as $pro )
                    <div class="col-lg-4 col-md-6 col-sm-3 mb-2">
                        <div class="card p-2">
                            <div class="card-content">
                                <div class="image-card mb-3">
                                    <img src="{{ asset('assets/images/product/'.$pro->image) }}" alt="" class=" img-fluid img-card">
                                </div>
                                <div class="title-card">
                                <a href="{{ route('detail_product', $pro->slug) }}" class="cl-dark f-w-2">{{ $pro->nama }}</a>
                                </div>
                                <div class="footer-card d-flex  align-items-center justify-content-between mb-3">
                                    <div class="price-product">
                                        Rp.  {{number_format( $pro->harga, 0, ',','.')}}
                                    </div>
                                    <div class="btn action-card">
                                        <a href="{{ route('detail_product', $pro->slug) }}">
                                            <div class="cart-order">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="black" class="bi bi-cart-fill" viewBox="0 0 16 16">
                                                    <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5M5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4m7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4m-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2m7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2"/>
                                                </svg>
                                            </div>
                                        </a>

                                    </div>
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
