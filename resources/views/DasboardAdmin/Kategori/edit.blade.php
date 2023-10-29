@extends('DasboardAdmin.LayouteMaster.masterLayout')
@section('content')
<section id="multiple-column-form">
    <div class="row match-height">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Edit  Kategori</h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <form class="form" action="{{ route('update_kategori',encrypt($kategori->id)) }}" method="post">
                            @csrf
                            @method('put')
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="first-name-column">Category Name</label>
                                        <input type="text" id="first-name-column" class="form-control @error('nama') is-invalid @enderror" placeholder="Nama Kategori" name="nama" value="{{ $kategori->nama }}">
                                        @error('nama')
                                            <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="last-name-column">Slug</label>
                                        <input type="text" id="last-name-column" class="form-control @error('slug') is-invalid @enderror" placeholder="Slug-Name" name="slug" value="{{ $kategori->slug }}">
                                        @error('slug')
                                            <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
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
