<x-layout>
    <x-slot name="title">
        {{ @$edit ? 'Edit' : 'Tambah' }} Produk {{ @$edit && $id }}
    </x-slot>

    <x-slot name="pageTitle">
        <div class="d-flex justify-content-between align-items-center">
            <h3> {{ @$edit ? 'Edit' : 'Tambah' }} Produk {{ @$edit ? $id : '' }}</h3>
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
            <form action="" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-4">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <input type="file" name="image" placeholder="Choose image" id="image"
                                        accept="image/*">
                                    @error('image')
                                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12 mb-2">
                                <img id="preview-image-before-upload"
                                    src="https://www.riobeauty.co.uk/images/product_image_not_found.gif"
                                    alt="preview image" style="max-height: 250px;">
                            </div>
                        </div>
                    </div>
                    <div class="col-8">
                        <div class="form-group">
                            <label for="name">Nama</label>
                            <input type="text" class="form-control" id="name" placeholder="Nama Obat">
                        </div>
                        <div class="form-group">
                            <label for="price">Harga</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">Rp</span>
                                <input type="number" class="form-control" name="price" id="price"
                                    placeholder="Harga Obat" aria-label="Harga" aria-describedby="basic-addon1">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="type">Jenis Packaging Obat</label>
                            <select id="type" name="type" class="form-select" id="basicSelect">
                                <option value="0" selected disabled>Pilih Jenis Packaging Obat</option>
                                <option value="Box">Box</option>
                                <option value="Botol">Botol</option>
                                <option value="Tube">Tube</option>
                                <option value="Pot">Pot</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="summernote">Deskripsi</label>
                            <textarea name="description" id="summernote"></textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-layout>
