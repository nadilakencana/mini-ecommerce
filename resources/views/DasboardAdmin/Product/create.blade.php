@extends('DasboardAdmin.LayouteMaster.masterLayout')
@section('content')
<section id="multiple-column-form">
    <div class="row match-height">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">New Product</h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <form class="form" action="{{ route('product.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="first-name-column">Product Name</label>
                                        <input type="text" id="first-name-column" class="form-control @error('nama') is-invalid @enderror" placeholder="product name" name="nama">
                                        @error('nama')
                                            <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="last-name-column">Slug</label>
                                        <input type="text" id="last-name-column" class="form-control @error('slug') is-invalid @enderror" placeholder="slug-product" name="slug">
                                        @error('slug')
                                            <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="last-name-column">Product Category</label>
                                        <select  id="last-name-column" class="form-control @error('id_kategori') is-invalid @enderror"  name="id_kategori">
                                            <option value="">--Select Product Category--</option>
                                            @foreach ($kategori as $kat )
                                                <option value="{{ $kat->id }}">{{ $kat->nama }}</option>
                                            @endforeach
                                        </select>
                                        @error('id_kategori')
                                            <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="last-name-column">Price</label>
                                        <input type="text" id="last-name-column" class="form-control @error('harga') is-invalid @enderror" placeholder="product price" name="harga">
                                        @error('harga')
                                            <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="last-name-column">Deskripsi</label>
                                        <textarea type="text" id="last-name-column" class="form-control @error('deskripsi') is-invalid @enderror" placeholder="deskripsi" name="deskripsi"></textarea>
                                        @error('deskripsi')
                                            <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="last-name-column">Image Product</label>
                                        <input type="file" id="last-name-column" class="form-control @error('image') is-invalid @enderror" placeholder="image product" name="image">
                                        @error('image')
                                            <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group color">
                                        <div class="lebel d-flex align-items-center mb-4 gap-3">
                                            <label for="last-name-column mr-3">Product Color</label>
                                            <div class="btn btn-primary color">+ Add Color</div>
                                        </div>
                                        <div class="varian-warna-product mb-3">


                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group size">
                                        <div class="lebel d-flex align-items-center mb-4 gap-3">
                                            <label for="last-name-column mr-3">Product Size</label>
                                            <div class="btn btn-primary size">+ Add Size</div>
                                        </div>
                                        <div class="varian-size-product mb-3">


                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('script')
<script>
    $(()=>{
        var idxColor = 0;
        var idxSize = 0;

        $('.btn.color').on('click', function(){
            idxColor++;
            addColor(idxColor);

        });

        $('.btn.size').on('click', function(){
            idxSize++;
            addSize(idxSize);
        });

        $('body').on('click', '.itm-color', function(){
            var id = $(this).attr('xid');
            removeColor(id);
        });

        $('body').on('click', '.itm-size', function(){
            var id = $(this).attr('xid');
            removeSize(id);
        });

        function addColor(xid){
            var $form = $('.card-body .form');
            var $target = $form.find('.varian-warna-product');

            $target.append(
                `<div class="item-color" xid="${xid}">`+
                    `<div class="btn btn-danger itm-color" xid="${xid}"><i class="bi bi-trash"></i></div>`+
                    `<input type="text" class="form-control @error('color') is-invalid @enderror" name="color[${xid}][warna]" xid="${xid}">`+
                    '@error("color")'+
                        '<small class="invalid-feedback">{{ $message }}</small>'+
                    '@enderror'+
                '</div>'
            );
        }

        function addSize(xid){
            var $form = $('.card-body .form');
            var $target = $form.find('.varian-size-product');

            $target.append(
                `<div class="item-size" xid="${xid}">`+
                    `<div class="btn btn-danger itm-size" xid="${xid}"><i class="bi bi-trash"></i></div>`+
                    `<input type="text" class="form-control @error('size') is-invalid @enderror" name="size[${xid}][ukuran]" xid="${xid}">`+
                    '@error("size")'+
                        '<small class="invalid-feedback">{{ $message }}</small>'+
                    '@enderror'+
                '</div>'
            );
        }


        function removeColor(idx){
            var $form = $('.card-body .form');
            var $target = $form.find('.varian-warna-product');
            $target.find(`.item-color[xid="${idx}"]`).remove();
        }

        function removeSize(idx){
            var $form = $('.card-body .form');
            var $target = $form.find('.varian-size-product');
            $target.find(`.item-size[xid="${idx}"]`).remove();
        }

    });
</script>


@stop
