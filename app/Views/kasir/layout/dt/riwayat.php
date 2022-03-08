<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.all.min.js"></script>

<!-- DataTables -->
<script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
<script>
$('#table').DataTable({
    processing: true,
    serverSide: true,
    pageLength: 5,
    lengthMenu: [5, 10],
    ajax: {
        url: '<?= site_url('/kasir/dtRiwayat') ?>',
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
            data: 'tgl',
            name: 'tgl'
        },
        {
            data: 'qty',
            name: 'qty'
        },
        {
            data: 'total',
            render: $.fn.dataTable.render.number(',', '.', 0, 'Rp. ')
        }
    ]
});
</script>