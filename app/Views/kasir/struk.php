<?= $this->extend('kasir/layout/layout') ?>
<?= $this->section('content') ?>

<div id="kasir">
    <div class="d-flex justify-content-center align-items-center mt-5">
        <div class="card w-75">
            <div class="card-body">
                <div class="text-center text-light mb-4">
                    <h3 class="fw-bold"><i class="fa fa-edit"></i> STRUK PEMBAYARAN</h3>
                </div>
                <div class="table-responsive">
                    <table class="table text-light">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama Menu</th>
                                <th scope="col">Jenis</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Jumlah</th>
                                <th scope="col">Total Harga</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($keranjang as $menu) :
                            ?>
                            <tr>
                                <td scope="row"><?= $no++ ?></td>
                                <td><?= $menu->nama ?></td>
                                <td><?= $menu->jenis ?></td>
                                <td>Rp. <?= number_format($menu->harga) ?></td>
                                <td><?= $menu->qty ?></td>
                                <td>Rp. <?= number_format($menu->total) ?></td>
                            </tr>
                            <?php endforeach ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Total Bayar</th>
                                <td>Rp. <?= number_format($totalBayar) ?></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <div class="text-end">
                    <a href="/kasir" class="btn btn-tambah me-2">
                        <i class="fa fa-arrow-left"></i> Kembali
                    </a>
                    <a href="/kasir/cetakStruk" class="btn btn-bayar">
                        <i class="fa fa-money-bill"></i> Cetak Struk
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>