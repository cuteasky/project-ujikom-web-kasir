<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Tambah Menu</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="/simpan-menu" method="POST">
          <div class="mb-3">
            <label for="nama">Nama Makanan / Minuman</label>
            <input type="text" id="nama" name="nama" class="form-control" required>
          </div>
          <div class="mb-3">
            <label for="jenis">Jenis</label>
            <select name="jenis" id="jenis" class="form-control" required>
              <option value="">-- Pilih Jenis --</option>
              <option value="makanan">Makanan</option>
              <option value="minuman">Minuman</option>
            </select>
          </div>
          <div class="mb-3">
            <label for="harga">Harga</label>
            <input type="number" id="harga" name="harga" class="form-control" required>
          </div>
          <div class="mb-3 text-right">
            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan Menu</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.all.min.js"></script>

<?php if (!empty(session()->getFlashdata('sukses'))) : ?>
  <script>
    var toastMixin = Swal.mixin({
      toast: true,
      icon: 'success',
      title: 'General Title',
      animation: false,
      position: 'top',
      showConfirmButton: false,
      timer: 3000,
      timerProgressBar: true,
      didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
      }
    });

    toastMixin.fire({
      animation: true,
      title: 'Menu berhasil ditambahkan'
    });
  </script>
<?php endif ?>

<?php if (!empty(session()->getFlashdata('edited'))) : ?>
  <script>
    var toastMixin = Swal.mixin({
      toast: true,
      icon: 'success',
      title: 'General Title',
      animation: false,
      position: 'top',
      showConfirmButton: false,
      timer: 3000,
      timerProgressBar: true,
      didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
      }
    });

    toastMixin.fire({
      animation: true,
      title: 'Menu berhasil diperbarui'
    });
  </script>
<?php endif ?>

<?php if (!empty(session()->getFlashdata('deleted'))) : ?>
  <script>
    var toastMixin = Swal.mixin({
      toast: true,
      icon: 'success',
      title: 'General Title',
      animation: false,
      position: 'top',
      showConfirmButton: false,
      timer: 3000,
      timerProgressBar: true,
      didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
      }
    });

    toastMixin.fire({
      animation: true,
      title: 'Menu berhasil dihapus'
    });
  </script>
<?php endif ?>

<!-- DataTables -->
<script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
<script>
  $('#table').DataTable({
    processing: true,
    serverSide: true,
    pageLength: 5,
    lengthMenu: [5, 10],
    ajax: {
      url: '<?= site_url('/adman/dtMenu') ?>',
      type: 'post'
    },
    columns: [
      // This will generate number
      {
        data: null,
        sortable: false,
        render: function(data, type, row, meta) {
          return meta.row + meta.settings._iDisplayStart + 1;
        }
      },
      {
        data: 'nama',
        name: 'nama'
      },
      {
        data: 'jenis',
        name: 'jenis'
      },
      {
        data: 'harga',
        render: $.fn.dataTable.render.number(',', '.', 0, 'Rp. ')
      },
      // Create action's button
      {
        data: null,
        sortable: false,
        render: function(data, type, row) {
          return `
            <div class="text-center">
            <button class="btn btn-info mr-1" data-toggle="modal" data-target="#detail-${row.id_menu}"><i class="fa fa-edit"></i></button>
            <a class="btn btn-danger" href="/hapus-menu/${row.id_menu}"><i class="fa fa-trash"></i></a>
            </div>

            <div class="modal fade" id="detail-${row.id_menu}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Edit Menu - ${row.nama}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <form action="/sunting-menu/${row.id_menu}" method="POST">
                      <div class="mb-3">
                        <label for="nama">Nama Makanan / Minuman</label>
                        <input type="text" id="nama" name="nama" value="${row.nama}" class="form-control" required>
                      </div>
                      <div class="mb-3">
                        <label for="jenis">Jenis</label>
                        <select name="jenis" id="jenis" class="form-control" required>
                          <option value="makanan" ${row.jenis == 'makanan' ? 'selected' : ''}>Makanan</option>
                          <option value="minuman" ${row.jenis == 'minuman' ? 'selected' : ''}>Minuman</option>
                        </select>
                      </div>
                      <div class="mb-3">
                        <label for="harga">Harga</label>
                        <input type="number" id="harga" name="harga" value="${row.harga}" class="form-control" required>
                      </div>
                      <div class="mb-3 text-right">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Perbarui</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
          </div>
          `;
        }
      }
    ]
  });
</script>