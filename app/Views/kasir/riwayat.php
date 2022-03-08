<?= $this->extend('kasir/layout/layout') ?>
<?= $this->section('content') ?>

<div id="kasir">
  <div class="d-flex justify-content-center align-items-center mt-5">
    <div class="card w-75">
      <div class="card-body">
        <div class="text-center text-light mb-4">
          <h3 class="fw-bold"><i class="fa fa-money-bill"></i> RIWAYAT TRANSAKSI</h3>
        </div>
        <div class="table-responsive">
          <table id="table" class="pt-2 table table-light table-bordered table-hover" style="width:100%">
            <thead>
              <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Jumlah Transaksi</th>
                <th>Total Pendapatan</th>
              </tr>
            </thead>
            <tbody class="text-dark"></tbody>
            <tfoot>
              <tr>
                <th colspan="3">Jumlah Keselurahan</th>
                <td class="fw-bold">Rp. <?= number_format($total) ?></td>
              </tr>
            </tfoot>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<?= $this->include('kasir/layout/dt/riwayat') ?>

<?= $this->endSection() ?>