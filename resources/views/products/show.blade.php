<x-layout>
    <x-slot name="title">
        Detail Obat
    </x-slot>

    <x-slot name="pageTitle">
        <div class="d-flex justify-content-between align-items-center">
            <h3>Detail Obat</h3>
            <a href="{{ url('admin/products') }}" class="btn btn-outline-primary">Kembali ke Daftar Produk</a>
        </div>
    </x-slot>

    {{-- <x-slot name="css">
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
    </x-slot> --}}

    <div class="card mt-3">
        <div class="card-body">
            <form action="" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-4">
                        <img src="https://pixnio.com/free-images/2020/04/22/2020-04-22-12-52-22-1200x800.jpg"
                            class="card-img-top img-fluid" alt="singleminded">
                        <div class="d-grid">
                            <button class="btn btn-primary mt-3">
                                PESAN
                            </button>
                        </div>
                    </div>
                    <div class="col-8">
                        <div class="form-group">
                            <label for="name">Nama</label>
                            <h4>Ermethasone</h4>
                        </div>
                        <div class="form-group">
                            <label for="price">Harga</label>
                            <h4>Rp 200.000</h4>
                        </div>
                        <div class="form-group">
                            <label for="type">Jenis Packaging Obat</label>
                            <h4>Box</h4>
                        </div>
                        <div class="form-group">
                            <p>
                                Lorem, ipsum dolor sit amet consectetur adipisicing elit. Recusandae corrupti architecto
                                commodi aspernatur sapiente? Aspernatur totam ipsum tempora quos nemo! Aperiam,
                                inventore veniam! Officia nisi ad veritatis explicabo ipsa atque?
                            </p>
                            {{-- <label for="summernote">Deskripsi</label>
                            <textarea name="description" id="summernote"></textarea> --}}
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-layout>
