<?= $this->extend('adman/layout/layout') ?>
<?= $this->section('content') ?>

<?php if (session()->get('role') == 'admin') : ?>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Log Pegawai</h1>
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
            <table id="table" class="table table-bordered table-hover" style="width:100%">
              <thead>
                <tr>
                  <th width="28px">No</th>
                  <th>Nama</th>
                  <th>Role</th>
                  <th>Login</th>
                  <th>Logout</th>
                </tr>
              </thead>
              <tbody></tbody>
              <tfoot>
                <tr>
                  <th>No</th>
                  <th>Nama</th>
                  <th>Role</th>
                  <th>Login</th>
                  <th>Logout</th>
                </tr>
              </tfoot>
            </table>
          </div>
        </div>
      </div>
    </section>
  </div>
<?php else : ?>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <p>
          Kelakukan anda <span class="text-bold"><?= session()->get('nama') ?></span> untuk mencoba masuk ke halaman Administrator telah terdeteksi, log aktifitas anda telah
          tercatat dan Administrator dapat seluruh melihat aktifitas anda.
          Maka, berpikirlah sebelum bertindak..!
        </p>
      </div>
    </div>
  </div>
<?php endif ?>

<?= $this->include('adman/layout/dt/mLog') ?>

<?= $this->endSection() ?>