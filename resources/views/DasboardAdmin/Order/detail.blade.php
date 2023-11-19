<div class="content-order" data-id="{{ $order->id }}">
    <div class="row detail-customer">
        <div class="col-md-6">
            <div class="data-customer d-flex gap-2">
                <lebel class="lebel" style="width: 50%">Customer Name</lebel>
                <div class="data">: {{ $order->user->name }}</div>
            </div>
            <div class="data-customer d-flex gap-2">
                <lebel class="lebel" style="width: 50%">Phone Number</lebel>
                <div class="data">: {{ $order->user->no_hp }}</div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="data-customer d-flex gap-2">
                <lebel class="lebel" style="width: 50%">Alamat</lebel>
                <div class="data">: {{ $order->user->alamat }}</div>
            </div>
        </div>

    </div>
    <div class="detail-itm-ordr mt-4">
        <table style="width: 100%">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Qty</th>
                    <th>Price</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($itmOrder as $itm)
                <tr>
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
                    <td>Rp. {{number_format( $itm->harga_product, 0, ',','.')}}</td>
                    <td>Rp. {{number_format( $itm->total_item, 0, ',','.')}}</td>
                </tr>
                @endforeach

            </tbody>
        </table>
    </div>
</div>
