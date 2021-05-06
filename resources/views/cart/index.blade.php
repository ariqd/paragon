<x-layout>
    <x-slot name="title">
        Keranjang
    </x-slot>

    <x-slot name="subtitle">
        Lorem, ipsum dolor sit amet consectetur adipisicing elit. Deserunt et vel unde, quae culpa alias repellendus.
    </x-slot>

    <div class="card">
        <div class="table-responsive">
            <table class="table mb-0">
                <thead class="thead-dark">
                    <tr scope="row">
                        <th scope="col" class="w-auto"></th>
                        <th scope="col" class="w-auto">Nama Obat</th>
                        <th scope="col" class="w-auto">Harga</th>
                        <th scope="col" class="w-auto">Kuantitas</th>
                        <th scope="col" class="w-auto">Subtotal</th>
                        <th scope="col" class="w-auto"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr scope="row">
                        <td class="w-25">
                            <img src="https://pixnio.com/free-images/2020/04/22/2020-04-22-12-52-22-1200x800.jpg"
                                class="w-50 mx-auto d-block" alt="singleminded">
                        </td>
                        <td class="font-weight-bold">Ermethasone</td>
                        <td>Rp 200.000</td>
                        <td>
                            <a href="" class="btn btn-outline-primary btn-sm">-</a>
                            10
                            <a href="" class="btn btn-outline-primary btn-sm">+</a>
                        </td>
                        <td>Rp 2.000.000</td>
                        <td class="text-center">
                            <a href="#" class="btn btn-light">
                                <i class="bi bi-trash"></i>
                            </a>
                        </td>
                    </tr>
                    <tr scope="row">
                        <td class="w-25">
                            <img src="https://pixnio.com/free-images/2020/04/22/2020-04-22-12-52-22-1200x800.jpg"
                                class="w-50 mx-auto d-block" alt="singleminded">
                        </td>
                        <td class="font-weight-bold">Panadol</td>
                        <td>Rp 200.000</td>
                        <td>
                            <a href="" class="btn btn-outline-primary btn-sm">-</a>
                            10
                            <a href="" class="btn btn-outline-primary btn-sm">+</a>
                        </td>
                        <td>Rp 2.000.000</td>
                        <td class="text-center">
                            <a href="#" class="btn btn-light">
                                <i class="bi bi-trash"></i>
                            </a>
                        </td>
                    </tr>
                    <tr scope="row">
                        <td class="w-25">
                            <img src="https://pixnio.com/free-images/2020/04/22/2020-04-22-12-52-22-1200x800.jpg"
                                class="w-50 mx-auto d-block" alt="singleminded">
                        </td>
                        <td class="font-weight-bold">OBH Combi</td>
                        <td>Rp 200.000</td>
                        <td>
                            <a href="" class="btn btn-outline-primary btn-sm">-</a>
                            10
                            <a href="" class="btn btn-outline-primary btn-sm">+</a>
                        </td>
                        <td>Rp 2.000.000</td>
                        <td class="text-center">
                            <a href="#" class="btn btn-light">
                                <i class="bi bi-trash"></i>
                            </a>
                        </td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr scope="row">
                        <td colspan="4" class="text-end">
                            <strong>Total:</strong>
                        </td>
                        <td>Rp 6.000.000</td>
                        <td class="d-grid">
                            <a href="" class="btn btn-primary">Checkout</a>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</x-layout>
