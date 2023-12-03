@extends('FrontEndUser.Layout.master_layoute')
@section('title', 'Detail Cart')
@section('content')
<div class="section">
    <div class="content-detail-cart py-5">
        <div class="row">
            <div class="col-lg-8 col-md-12 col-sm-12">
                <div class="label-header-section cl-dark d-flex align-items-center justify-content-between p-2 mb-3">
                    <h2 class="cl-dark">Your Cart</h2>
                </div>
                <div class="data-cart">
                    <table class="table">
                        <thead class="text-center">
                            <tr>
                                <th scope="col">Product</th>
                                <th scope="col">Qty</th>
                                <th scope="col">Price</th>
                                <th scope="col">Total</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($carts as $k => $cart )
                            <tr class="item-product">
                                <td>
                                    <div class="data-product" xid="{{ $cart['id'] }}">
                                        <p class="text-name">
                                            {{ $cart['nama'] }}
                                        </p>
                                        <div class="image-pro-cart" style="width: 133px">
                                            <img src="{{ asset('assets/images/product/'.$cart['image']) }}" alt=""
                                                class="img-fluid">
                                        </div>
                                        <div class="detail-varian-product">
                                            <div class="varian d-flex gap-3" xid-color="{{ $cart['id_warna']}}">
                                                <div class="label-varian">Color</div>
                                                <div class="data-varian">: {{ $cart['warna'] }}</div>
                                            </div>
                                            <div class="varian d-flex gap-3" xid-size="{{ $cart['id_ukuran'] }}">
                                                <div class="label-varian">Size</div>
                                                <div class="data-varian">: {{ $cart['ukuran'] }}</div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="data-cart">
                                        <div class="qty-controll" id="qty">
                                            {{--  <div id="quantity-decrease" class="btn cl-dark bold">-</div>  --}}
                                            <input type="text" class="qty-input text-center" id="quantity-input"
                                                value="{{ $cart['qty'] }}" readonly style="width:20%; border:none;">
                                            {{--  <div id="quantity-increase" class="btn cl-dark bold">+</div>  --}}
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="data-cart">
                                        <p>Rp.{{ number_format( $cart['harga'], 0, ',','.') }}</p>
                                    </div>
                                </td>
                                <td>
                                    <div class="data-cart">
                                        @php
                                        $total = 0;
                                        $total = $cart['qty'] * $cart['harga']
                                        @endphp
                                        <p>Rp. {{ number_format($total,0,',','.') }}</p>
                                    </div>
                                </td>
                                <td>
                                    <div class="data-cart text-center">
                                        <div class="delete-cart" data-id="{{ $k }}" xid="{{ $cart['id'] }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="black"
                                                class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                                <path
                                                    d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5" />
                                            </svg>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach



                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-lg-4 col-md-12 col-sm-12 pt-5 mt-5">
                <div class="cart border">
                    <div class="content-cart card-body">
                        <div class="total d-flex justify-content-between">
                            <div class="label-total-cart">Total Item </div>
                            <div class="label-total-cart"> @if(Session::has('cart'))
                                {{ count(Session::get('cart')) }}
                                @else
                                0
                                @endif Item</div>
                        </div>
                        <div class="total d-flex justify-content-between">
                            <div class="label-total-cart">Sub Total </div>
                            <div class="label-total-cart subtotal" data="{{ $subtotal }}"> Rp. {{ number_format($subtotal,0,',','.') }}</div>
                        </div>
                        <hr>
                        <div class="total d-flex justify-content-between">
                            <div class="label-total-cart">Total</div>
                            <div class="label-total-cart total-order" data="{{ $subtotal }}"> Rp. {{ number_format($subtotal,0,',','.') }}</div>
                        </div>
                        <div class="btn btn-dark cekout mt-3 w-100">Cekout</div>

                    </div>
                </div>
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

    $(()=>{
        $('.delete-cart').on('click', function(e){
            var id = $(this).attr('data-id');

            var $elmentcart = $(this).parents('.item-product');

            var konfirmasi = confirm('Are you sure you want to remove from cart?');

            if(konfirmasi){
                deleteFromCart(id, $elmentcart);
            }
        });


        $('.cekout').on('click', function(){
            CekOut();
        })
    });





    function deleteFromCart(id, $elm){
        var postData = {
            _token : "{{ csrf_token() }}",
            id : id,
        }

        $.post('{{ route('delete-itm-cart') }}', postData).done(function(data){
            if(data.success === 0 ){
                alert(data.message);
            }else{
                $(this).attr('data-notify',data['count']);
                $elm.remove();
                location.reload();
            }
        }).fail(function(data){
            console.log('error',data);
        });
    }

    function CekOut(){
        var subtotal = $('.subtotal').attr('data');
        var Total = $('.total-order').attr('data');

        var postDataDetail = {
            _token: "{{ csrf_token() }}",
            subtotal: subtotal,
            total : Total,
        };
        console.log(postDataDetail);
        var url = "{{ route('cekout') }}";
            $.post(url,postDataDetail).done(function(data){
                    console.log(data);
                    alert('Your order is being processed');
                    location.reload();
            }).fail(function(err){
                    console.log(err);
                    alert('Order Faild');
        })
    }
</script>
@stop
