<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="<?= base_url() ?>/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>/css/style.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous" />
  <link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css">
  <title><?= $title ?></title>
</head>

<body>
  <!-- Navbar -->
  <?= $this->include('kasir/layout/pages/navbar') ?>
  <!-- End Navbar -->

  <!-- Content -->
  <div class="container">
    <?= $this->renderSection('content') ?>
  </div>
  <!-- End Content -->

  <!-- Bootstrap Bundle with Popper -->
  <script src="<?= base_url() ?>/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>