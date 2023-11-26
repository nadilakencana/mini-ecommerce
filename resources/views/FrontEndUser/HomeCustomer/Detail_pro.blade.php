@extends('FrontEndUser.Layout.master_layoute')
@section('title', 'Product Detail')
@section('content')
<div class="section detail-product mb-5">
    <div class="label-header-section cl-dark d-flex align-items-center justify-content-between p-2 mb-3">
        {{--  <h3 class="cl-dark">{{ $pro_detail->nama }}</h3>  --}}
    </div>
    <div class="row">
        <div class="col-lg-6 col-md-12 d-flex align-items-center justify-content-center">
            <div class="image-pro">
                <img src="{{ asset('assets/images/product/'.$pro_detail->image) }}" alt="" class="img-itm-pro img-fluid">
            </div>
        </div>
        <div class="col-lg-6 col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="cl-dark mb-3">{{ $pro_detail->nama }}</h4>
                    <h3 class="cl-dark mb-3"> Rp. {{number_format( $pro_detail->harga, 0, ',','.')}}</h3>
                    <div class="varian-warna d-flex gap-3 mb-3 align-items-center">
                        <label for="">Product Color:</label>
                        @foreach ($warna as $color)
                            <button class="btn btn-outline-dark color" onclick="btnActiveColor(this, 'color')">{{ $color->warna }}</button>
                        @endforeach

                    </div>
                    <div class="varian-size d-flex gap-3 mb-3 align-items-center">
                        <label for="">Product Size:</label>
                        @foreach ($ukuran as $size)
                            <button class="btn btn-outline-dark size" onclick="btnActiveColor(this, 'size')">{{ $size->ukuran }}</button>
                        @endforeach

                    </div>
                    <div class="detail mt-5 mb-3">
                        <p class=".cl-grey">{{ $pro_detail->deskripsi }}</p>
                    </div>
                    <div class="footer-card d-flex justify-content-between">
                        <div class="qty-controll" id="qty">
                            <button id="quantity-decrease" class="btn btn-dark">-</button>
                                <input type="text" class="qty-input text-center"  id="quantity-input" value="1" readonly style="width:30%">
                            <button id="quantity-increase" class="btn btn-dark">+</button>
                        </div>
                       @auth
                        <div class="cekout-btn">
                            <div class="btn btn-dark" style="width: 250px">Order Now</div>
                        </div>
                        @else
                        <a href="{{ route('login-user') }}">
                            <div class="login">
                                <div class="btn btn-dark" style="width: 250px">Order Now</div>
                            </div>
                        </a>

                       @endauth

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="section pt-5 mt-5">
    <div class="row ">
        <div class="col-lg-12">
            <div class="label-header-section bg-dark d-flex align-items-center justify-content-between p-2 mb-3">
               <div class="">Top Product</div>
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
@section('script')
<script>
    document.addEventListener('DOMContentLoaded', function () {
      var quantityInput = document.getElementById('quantity-input');
      var decreaseButton = document.getElementById('quantity-decrease');
      var increaseButton = document.getElementById('quantity-increase');

      decreaseButton.addEventListener('click', function () {
        var currentValue = parseInt(quantityInput.value, 10);
        if (currentValue > 1) {
          quantityInput.value = currentValue - 1;
        }
      });

      increaseButton.addEventListener('click', function () {
        var currentValue = parseInt(quantityInput.value, 10);
        quantityInput.value = currentValue + 1;
      });
    });


    function btnActiveColor(button, type) {

        button.classList.toggle('active');

        if(type === 'color'){
            var buttons = document.querySelectorAll('.varian-warna .color');
        }else{
            var buttons = document.querySelectorAll('.varian-size .size');
        }
        for (var i = 0; i < buttons.length; i++) {
            if (buttons[i] !== button) {
                buttons[i].classList.remove('active');
            }
        }
    }



  </script>
@stop
