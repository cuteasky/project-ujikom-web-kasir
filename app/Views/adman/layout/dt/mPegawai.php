<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Tambah Pegawai</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="/simpan-pegawai" method="POST">
          <div class="mb-3">
            <label for="nama">Nama Lengkap</label>
            <input type="text" id="nama" name="nama" class="form-control" required>
          </div>
          <div class="mb-3">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" class="form-control" required>
          </div>
          <div class="mb-3">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" class="form-control" required>
          </div>
          <div class="mb-3">
            <label for="jabatan">Jabatan</label>
            <select name="jabatan" id="jabatan" class="form-control" required>
              <option value="">-- Pilih Jabatan --</option>
              <option value="kasir">Kasir</option>
              <option value="manager">Manager</option>
            </select>
          </div>
          <div class="mb-3 text-right">
            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan Pegawai</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- jQuery -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.all.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<!-- DataTables -->
<script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>

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
      title: 'Pegawai berhasil ditambahkan'
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
      title: 'Pegawai berhasil diperbarui'
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
      title: 'Pegawai berhasil dihapus'
    });
  </script>
<?php endif ?>

<script>
  $('#table').DataTable({
    processing: true,
    serverSide: true,
    pageLength: 5,
    lengthMenu: [5, 10],
    ajax: {
      url: '<?= site_url('/adman/dtPegawai') ?>',
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
        render: function(data, type, row) {
          return `
          <div class="text-center">
            ${row.role == 'kasir' ? `<span class="badge badge-primary">${row.role}</span>` : ''}
            ${row.role == 'manager' ? `<span class="badge badge-success">${row.role}</span>` : ''}
            ${row.role == 'admin' ? `<span class="badge badge-warning">${row.role}</span>` : ''}
          </div>
          `
        }
      },
      // Create action's button
      {
        data: null,
        sortable: false,
        render: function(data, type, row) {
          return `
          <button class="btn btn-info mr-1" data-toggle="modal" data-target="#detail-kasir-${row.id_user}"><i class="fa fa-info-circle"></i> Detail</button>
            <div class="modal fade" id="detail-kasir-${row.id_user}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="staticBackdropLabel">Detail Kasir - ${row.nama}</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form action="/sunting-pegawai/${row.id_user}" method="POST">
                    <div class="mb-3">
                      <label for="nama">Nama Lengkap</label>
                      <input type="text" id="nama" name="nama" value="${row.nama}" class="form-control">
                    </div>

                    ${row.role != 'admin' ? `<div class="mb-3"><label for="jabatan">Jabatan</label><select name="jabatan" id="jabatan" class="form-control" required><option value="kasir" ${row.role == "kasir" ? "selected" : ""}>Kasir</option><option value="manager" ${row.role == "manager" ? "selected" : ""}>Manager</option></select></div>` : ''}
                    <div class="mb-3 text-right">
                      ${row.role != 'admin' ? `<a href="/delete-pegawai/${row.id_user}" class="btn btn-danger mr-1"><i class="fa fa-trash"></i> Hapus</a>` : ''}
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