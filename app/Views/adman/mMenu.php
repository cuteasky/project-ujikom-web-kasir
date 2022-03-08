<?= $this->extend('adman/layout/layout') ?>
<?= $this->section('content') ?>

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Manage Menu</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <div class="text-right">
            <button class="btn btn-primary" data-toggle="modal" data-target="#staticBackdrop"><i class="fa fa-book"></i> Tambah Menu</button>
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
                <th width="28px">No</th>
                <th>Nama</th>
                <th>Jenis</th>
                <th>Harga</th>
                <th width="80px">Aksi</th>
              </tr>
            </thead>
            <tbody></tbody>
            <tfoot>
              <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Jenis</th>
                <th>Harga</th>
                <th>Aksi</th>
              </tr>
            </tfoot>
          </table>
        </div>
      </div>
    </div>
  </section>
</div>

<?= $this->include('adman/layout/dt/mMenu') ?>

<?= $this->endSection() ?>