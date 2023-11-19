<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice</title>
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">
    <script src="https://code.jquery.com/jquery-3.6.0.js"
        integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

</head>

<body>
    <div class="container">
        <div class="btn btn-danger print-invoice m-4">Print</div>
        <div class="content-invoice p-4 mt-5">
            <div class="row header-invoice mb-3">
                <div class="col-md-6">
                    <div class="brand-commerce">
                        <h3>Mini E-commerce</h3>
                    </div>
                </div>
                <div class="col-md-6 ">
                    <div class="detail-customer d-flex align-content-end flex-column">
                        <div class="data-customer mb-1 d-flex">
                            <label for="" style="width: 50%">Kode Invoice</label>
                            <div class="dt">: {{ $order->kode_order }}</div>
                        </div>
                        <div class="data-customer mb-1 d-flex">
                            <label for="" style="width: 50%">Name</label>
                            <div class="dt">: {{ $order->user->name }}</div>
                        </div>
                        <div class="data-customer mb-1  d-flex">
                            <label for="" style="width: 50%">Phone</label>
                            <div class="dt">: {{ $order->user->no_hp }}</div>
                        </div>
                        <div class="data-customer mb-1  d-flex">
                            <label for="" style="width: 50%">Address</label>
                            <div class="dt">: {{ $order->user->alamat }}</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="detail-order">
                <table style="width: 100%">
                    <thead style="border-bottom: 1px solid black; border-top: 1px solid black;">
                        <tr>
                            <th>Product</th>
                            <th>Qty</th>
                            <th>Price</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($itmOrder as $itm)
                        <tr style="border-bottom: 1px solid rgba(128, 128, 128, 0.596)">
                            <td>
                                <div class="product-spk">
                                    <lebel class="name">{{ $itm->product->nama }}</lebel>
                                    <div class="spesifikasi">
                                        <div class="spk-product d-flex gap-2">
                                            <small for="">Uk</small>
                                            <small>: {{ $itm->variasiUkuran->ukuran }}</small>
                                        </div>
                                        <div class="spk-product d-flex gap-2">
                                            <small for="">Color</small>
                                            <small>: {{ $itm->variasiWarna->warna }}</small>
                                        </div>

                                    </div>
                                </div>
                            </td>
                            <td>{{ $itm->qty }}</td>
                            <td style="text-align: end">Rp. {{number_format( $itm->harga_product, 0, ',','.')}}</td>
                            <td style="text-align: end">Rp. {{number_format( $itm->total_item, 0, ',','.')}}</td>
                        </tr>
                        @endforeach

                    </tbody>

                </table>
                <div class="footer-tabel">
                    .
                </div>
            </div>
        </div>
    </div>

    <script>
            $(()=>{
                $('.print-invoice').on('click', function(){
                    cetakLayoutBill();
                });

                function cetakLayoutBill() {

                    var style = document.createElement('style');
                    style.innerHTML = '@media print { .content-invoice { display: block; } }';
                    document.head.appendChild(style);
                    var target = document.createElement('style');
                    target.innerHTML = '@media print { .print-invoice { display: none; } }';
                    document.head.appendChild(target);

                    window.print();
                }
            })
    </script>
</body>



</html>
