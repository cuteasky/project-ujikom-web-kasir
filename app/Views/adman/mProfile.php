<?= $this->extend('adman/layout/layout') ?>
<?= $this->section('content') ?>

<?php if (session()->get('role') == 'admin') : ?>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">App Setting</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <h1 class="m-0">Account Setting</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-6">
            <div class="card shadow">
              <div class="card-body">
                <form action="/update-setting" method="POST">
                  <label for="nameApp">App Name</label>
                  <input type="text" name="nameApp" id="nameApp" class="form-control" value="<?= $app_name ?>">
                  <div class="text-right mt-3">
                    <button type="submit" class="btn btn-primary text-bold">UPDATE NOW</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="card shadow">
              <div class="card-body">
                <form action="/update-profile" method="POST">
                  <label for="admName">Administrator Name</label>
                  <input type="text" name="admName" id="admName" class="form-control" value="<?= $adm_acc->nama ?>">
                  <label for="username" class="mt-2">Administrator Username</label>
                  <input type="text" name="username" id="username" class="form-control" value="<?= $adm_acc->username ?>">
                  <label for="password" class="mt-2">Administrator Password</label>
                  <input type="password" name="password" id="password" class="form-control" placeholder="Enter a new password">
                  <div class="text-right mt-3">
                    <button type="submit" class="btn btn-primary text-bold">UPDATE NOW</button>
                  </div>
                </form>
              </div>
            </div>
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

<?= $this->include('adman/layout/dt/mMenu') ?>

<?= $this->endSection() ?>