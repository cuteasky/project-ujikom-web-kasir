<?= $this->extend('adman/layout/layout') ?>
<?= $this->section('content') ?>

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Rekap Transaksi Bulanan</h1>
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
          <form action="/adman/rekapTransaksiBulanan" method="POST" class="mb-3">
            <div class="row d-flex align-items-center">
              <div class="col-md-2">
                <label for="date">Dari Tanggal</label>
                <select name="mth1" class="form-control">
                  <option value="">-- Pilih --</option>
                  <?php foreach ($getDate as $date) : ?>
                    <option value="<?= $date->tgl ?>"><?= $date->tgl ?></option>
                  <?php endforeach ?>
                </select>
              </div>
              <div class="col-md-2">
                <label for="date">Sampai Tanggal</label>
                <select name="mth2" class="form-control">
                  <option value="">-- Pilih --</option>
                  <?php foreach ($getDate as $date) : ?>
                    <option value="<?= $date->tgl ?>"><?= $date->tgl ?></option>
                  <?php endforeach ?>
                </select>
              </div>
              <div class="col-md-2">
                <button type="submit" class="btn btn-primary">Cari</button>
              </div>
            </div>
          </form>

          <table id="allTransaksi" class="table table-bordered">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama Kasir</th>
                <th>Terjual</th>
                <th>Pendapatan</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $no = 1;
              foreach ($mtm as $data) :
              ?>
                <tr>
                  <td><?= $no++ ?></td>
                  <td><?= $data->nama ?></td>
                  <td><?= $data->jumlah ?></td>
                  <td>Rp. <?= number_format($data->totalPendapatan) ?></td>
                </tr>
              <?php endforeach ?>
            </tbody>
            <tfoot>
              <tr>
                <th colspan="3">Total</th>
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