<nav class="navbar navbar-expand-lg navbar-dark shadow-lg">
  <div class="container">
    <a class="navbar-brand" href="<?= base_url() ?>/kasir">Berlamour Cafe</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#main_nav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="main_nav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item dropdown">
          <a class="nav-link  dropdown-toggle" href="#" data-bs-toggle="dropdown">
            <div class="d-flex align-items-center gap-1">
              <i class="fa fa-user-circle fs-3"></i> Hi, <?= session()->get('namaShort') ?>!
            </div>
          </a>
          <ul class="dropdown-menu">
            <li>
              <div class="mt-1 text-center">
                <img src="<?= base_url() ?>/img/avatar5.png" class="rounded-circle" width="80" alt="profile">
                <h5 class="mt-1"><?= session()->get('nama') ?></h5>
                <hr style="margin-top: -1px; margin-bottom: 5px;">
              </div>
            </li>
            <li><a class="dropdown-item" href="/kasir/riwayat/<?= session()->get('id_user') ?>"> <i class="far fa-clock"></i> Riwayat </a></li>
            <li><a class="dropdown-item" href="/logout/<?= $_SESSION['id_user'] ?>"> <i class="fa fa-sign-out-alt"></i> Logout </a></li>
          </ul>
        </li>
      </ul>
    </div> <!-- navbar-collapse.// -->
  </div> <!-- container-fluid.// -->
</nav>