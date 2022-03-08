<?= $this->extend('adman/layout/layout') ?>
<?= $this->section('content') ?>

<?php if (session()->get('role') == 'admin') : ?>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Manage Pegawai</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <div class="text-right">
              <button class="btn btn-primary" data-toggle="modal" data-target="#staticBackdrop"><i class="fa fa-user"></i> Tambah Pegawai</button>
            </div>
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
                  <th width="30px">No</th>
                  <th>Nama</th>
                  <th class="text-center">Jabatan</th>
                  <th width="80px">Aksi</th>
                </tr>
              </thead>
              <tbody></tbody>
              <tfoot>
                <tr>
                  <th width="30px">No</th>
                  <th>Nama</th>
                  <th class="text-center">Jabatan</th>
                  <th>Aksi</th>
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

<?= $this->include('adman/layout/dt/mPegawai') ?>

<?= $this->endSection() ?>