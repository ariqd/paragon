<x-layout>
    <x-slot name="title">
        {{ @$edit ? 'Edit' : 'Tambah' }} Produk {{ @$edit ? $product->name : '' }}
    </x-slot>

    <x-slot name="pageTitle">
        <div class="d-flex justify-content-between align-items-center">
            <h3> {{ @$edit ? 'Edit' : 'Tambah' }} Produk {{ @$edit ? $product->name : '' }}</h3>
            <a href="{{ url('admin/products') }}" class="btn btn-outline-primary">Kembali ke Daftar Produk</a>
        </div>
    </x-slot>

    <x-slot name="css">
        <link rel="stylesheet" href="{{ asset('assets/vendors/summernote/summernote-lite.min.css') }}">
    </x-slot>

    <x-slot name="js">
        <script src="{{ asset('assets/vendors/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('assets/vendors/summernote/summernote-lite.min.js') }}"></script>
        <script>
            $(document).ready(function (e) {
                $('#image').change(function(){
                let reader = new FileReader();
                reader.onload = (e) => {
                    $('#preview-image-before-upload').attr('src', e.target.result);
                }

                reader.readAsDataURL(this.files[0]);

                });

                $('#summernote').summernote({
                    tabsize: 2,
                    height: 120,
                })
            });

        </script>
    </x-slot>

    <div class="card mt-3">
        <div class="card-body">
            <form action="{{ @$edit ? route('admin.products.update', $product) : route('admin.products.store') }}"
                method="POST" enctype="multipart/form-data">
                @csrf
                {{ @$edit ? method_field('PUT') : '' }}
                <div class="row">
                    <div class="col-4">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="preview-image-before-upload">
                                        {{@$edit ? 'Update Gambar' : 'Upload Gambar'}}
                                    </label>
                                    <input type="file" name="image" placeholder="Choose image" id="image"
                                        accept="image/*" class="form-control">
                                    @error('image')
                                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12 mb-2">
                                @if (@$edit)
                                <img id="preview-image" src="{{ asset($product->image) }}" alt="preview image"
                                    style="max-height: 250px;">
                                @else
                                <img id="preview-image-before-upload"
                                    src="https://www.riobeauty.co.uk/images/product_image_not_found.gif"
                                    alt="preview image" style="max-height: 250px;">
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-8">
                        <div class="form-group">
                            <label for="name">Nama Obat</label>
                            <input type="text" class="form-control" id="name" placeholder="Nama Obat" name="name"
                                value="{{ @$edit ? @$product->name : old('name')}}">
                        </div>
                        <div class="form-group">
                            <label for="price">Harga</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">Rp</span>
                                <input type="number" class="form-control" name="price" id="price"
                                    placeholder="Harga Obat" aria-label="Harga" aria-describedby="basic-addon1"
                                    value="{{ @$edit ? @$product->price : old('price')}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="type">Jenis Packaging Obat</label>
                            <select id="type" name="type" class="form-select" id="basicSelect">
                                <option value="0" selected disabled>Pilih Jenis Packaging Obat</option>
                                <option value="Box" @if (@$product->type == 'Box') selected @endif>
                                    Box
                                </option>
                                <option value="Botol" @if (@$product->type == 'Botol') selected @endif>Botol</option>
                                <option value="Tube" @if (@$product->type == 'Tube') selected @endif>Tube</option>
                                <option value="Pot" @if (@$product->type == 'Pot') selected @endif>Pot</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="stock">Stok</label>
                            <div class="input-group mb-3">
                                <input type="number" class="form-control" name="stock" id="stock"
                                    placeholder="Jumlah Stok (dalam pcs)" aria-label="Harga"
                                    aria-describedby="basic-addon1"
                                    value="{{ @$edit ? @$product->stock : old('stock') }}">
                                <span class="input-group-text" id="basic-addon1">pcs</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="summernote">Deskripsi</label>
                            <textarea name="description"
                                id="summernote">{!! @$edit ? @$product->description : old('stock') !!}</textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">{{ @$edit ? 'Finish Edit' : 'Simpan' }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-layout>
