<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<!-- DataTables -->
<script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>

<script>
  var table = $('#allTransaksi').DataTable({
    processing: true,
    serverSide: true,
    pageLength: 5,
    lengthMenu: [5, 10],
    ajax: {
      url: '<?= site_url('/adman/dtRekapAll') ?>',
      type: 'post'
    },
    order: [
      [3, "desc"]
    ],
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
        data: 'jumlah',
        name: 'jumlah'
      },
      {
        data: 'tharga',
        render: $.fn.dataTable.render.number(',', '.', 0, 'Rp. ')
      },
    ]
  });
</script>