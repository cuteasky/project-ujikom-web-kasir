<?= $this->extend('adman/layout/layout') ?>
<?= $this->section('content') ?>

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Log Kasir</h1>
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
                <th>Nama Kasir</th>
                <th>Login</th>
                <th>Logout</th>
              </tr>
            </thead>
            <tbody></tbody>
            <tfoot>
              <tr>
                <th>No</th>
                <th>Nama Kasir</th>
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

<?= $this->include('adman/layout/dt/mLogKasir') ?>

<?= $this->endSection() ?>