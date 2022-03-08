<?= $this->extend('adman/layout/layout') ?>
<?= $this->section('content') ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-9">
                    <h1 class="m-0">Rekap Transaksi Semua Kasir</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <table id="allTransaksi" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Kasir</th>
                                <th>Total Penjualan</th>
                                <th>Total Pendapatan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($totalAllPerkasir as $data) :
                            ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $data->nama ?></td>
                                    <td><?= $data->jumlah ?> (makanan & minuman)</td>
                                    <td>Rp. <?= number_format($data->totalPendapatan) ?></td>
                                    <td>
                                        <button class="btn btn-primary" data-toggle="modal" data-target="#detail<?= $data->no_trx ?>"><i class="fa fa-info-circle"></i> </button>
                                    </td>
                                </tr>

                                <!-- Modal -->
                                <div class="modal fade" id="detail<?= $data->no_trx ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="detailLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="detailLabel">Detail Penjualan -- <?= $data->nama ?></h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row text-bold">
                                                    <div class="col-md-1 text-center">No</div>
                                                    <div class="col-md-5">Nama Menu</div>
                                                    <div class="col-md-3 text-center">Jenis Menu</div>
                                                    <div class="col-md-2 text-center">Jumlah Terjual</div>
                                                </div>
                                                <?php
                                                $no = 1;
                                                foreach ($detailPerkasir as $det) {
                                                    if ($det->id_user == $data->id_user) {
                                                ?>
                                                        <div class="row">
                                                            <div class="col-md-1 text-center"><?= $no++ ?>.</div>
                                                            <div class="col-md-5"><?= $det->nama ?></div>
                                                            <div class="col-md-3 text-center"><?= $det->jenis ?></div>
                                                            <div class="col-md-2 text-center"><?= $det->jumlah ?></div>
                                                        </div>
                                                <?php
                                                    }
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Total</th>
                                <td colspan="4" class="text-bold">Rp. <?= number_format($total) ?></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>

<?= $this->endSection() ?>