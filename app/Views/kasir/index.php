<?= $this->extend('kasir/layout/layout') ?>
<?= $this->section('content') ?>

<div id="kasir">
  <div class="d-flex justify-content-center align-items-center mt-5">
    <div class="card w-50">
      <div class="card-body">
        <div class="text-center text-light mb-4">
          <h3 class="fw-bold"><i class="fa fa-book"></i> MENU PEMESANAN</h3>
        </div>
        <form action="/kasir/masukanKeranjang" id="tTransaksi" method="POST" onchange="inputted()">
          <div class="row">
            <input type="text" name="idTran" class="form-control" value="<?= $idTran ?>" hidden>
            <input type="text" name="idPre" class="form-control" value="<?= $idPre ?>" hidden>
            <div class="col-md-9">
              <div class="mb-3 text-light">
                <label for="menu" class="form-label">Pilih Menu</label>
                <select type="text" id="menu" name="menu" class="form-select">
                  <option value="0"> -- Pilih Menu -- </option>
                  <?php foreach ($menus as $menu) : ?>
                    <option value="<?= $menu->id_menu . ',' . $menu->harga ?>"><?= $menu->nama ?> - Rp. <?= number_format($menu->harga) ?></option>
                  <?php endforeach ?>
                </select>
              </div>
            </div>
            <div class="col-md-3">
              <div class="mb-3 text-light">
                <label for="qty" class="form-label">Jumlah</label>
                <input type="number" id="qty" name="qty" class="form-control" min="1" value="1">
              </div>
            </div>
          </div>
          <input type="text" id="id_menu" name="id_menu" class="form-control" hidden>
          <div class="mb-3 text-light">
            <label for="total" class="form-label">Total Harga</label>
            <input type="text" id="total" name="total" class="form-control" readonly>
            <input type="text" id="totalHarga" name="totalHarga" class="form-control" hidden>
          </div>
          <div class="mb-3 mt-2 text-end">
            <button type="submit" class="btn btn-warning">
              <i class="fa fa-shopping-cart"></i> Masukan ke keranjang
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
</div>

<script>
  let menu = document.getElementById('menu');
  let idMenu = document.getElementById('id_menu');
  let totalHarga = document.getElementById('totalHarga');
  let tHarga = document.getElementById('total');

  function inputted() {
    let vSelected = menu.options[menu.selectedIndex].value;
    let id = vSelected.slice(0, vSelected.indexOf(","));
    let harga = vSelected.split(',').pop();
    let qty = document.getElementById('qty').value;
    let total = harga * qty;
    totalHarga.value = total;
    idMenu.value = id;
    tHarga.value = "Rp. " + total;
  }
</script>

<?= $this->endSection() ?>