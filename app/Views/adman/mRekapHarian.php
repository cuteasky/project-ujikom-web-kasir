<?= $this->extend('adman/layout/layout') ?>
<?= $this->section('content') ?>

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Rekap Transaksi Harian</h1>
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
          <form action="/adman/rekapTransaksiHarian" method="POST" class="mb-3">
            <label for="date">Pilih Tanggal</label>
            <div class="d-flex justify-content-between gap-2">
              <!-- <input type="date" name="date" class="form-control w-50" id="dateNow"> -->
              <select name="date" class="form-control w-50">
                <option value="">-- Pilih Tanggal --</option>
                <?php foreach ($getDate as $date) : ?>
                  <option value="<?= $date->tgl ?>"><?= $date->tgl ?></option>
                <?php endforeach ?>
              </select>
              <button type="submit" class="btn btn-primary">Cari</button>
            </div>
          </form>

          <table id="allTransaksi" class="table table-bordered">
            <thead>
              <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Nama Kasir</th>
                <th>Terjual</th>
                <th>Pendapatan</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $no = 1;
              foreach ($totalPerDate as $data) :
              ?>
                <tr>
                  <td><?= $no++ ?></td>
                  <td><?= $data->tgl ?></td>
                  <td><?= $data->nama ?></td>
                  <td><?= $data->jumlah ?></td>
                  <td>Rp. <?= number_format($data->totalPendapatan) ?></td>
                </tr>
              <?php endforeach ?>
            </tbody>
            <tfoot>
              <tr>
                <th colspan="4">Total</th>
                <td>Rp. <?= number_format($total) ?></td>
              </tr>
            </tfoot>
          </table>
        </div>
      </div>
    </div>
  </section>
</div>

<?= $this->endSection() ?>