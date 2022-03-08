<?php

namespace App\Controllers;

use App\Models\MenuModel;
use App\Models\PretransModel;
use App\Models\TransaksiModel;
use App\Libraries\Datatables;

class Kasir extends BaseController
{
    private $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        if (empty(session()->get('logged_in'))) {
            return redirect()->to(base_url());
        }
        // Mendapatkan semua menu makanan
        $menu = new MenuModel();
        $menus = $menu->findAll();

        // Mendapatkan Latest ID from db Pretransaksi
        $keran = new PretransModel();
        if ($keran->lastIdKeranjang() >= 1) {
            $maxId = $keran->lastIdKeranjang();
        } else {
            $maxId = 1;
        }
        $idPretrans = $maxId;

        // Mendapatkan Latest No Trx from db Transaksi
        $tran = new TransaksiModel();
        if ($tran->lastIdTransaksi() >= 1) {
            $maxIdTran = $tran->lastIdTransaksi() + 1;
        } else {
            $maxIdTran = 1;
        }
        $idTran = $maxIdTran;

        $data = [
            "title" => "Coffee Jiwa",
            "menus" => $menus,
            "idPre" => $idPretrans,
            "idTran" => $idTran
        ];
        return view('kasir/index', $data);
    }

    public function keranjang($kdTran)
    {
        $an = new PretransModel();
        $keranjang = $an->valueKeranjang($kdTran);

        // SUM Total * Banyak Item
        $totalBayar = $an->totalBayarKeranjang($kdTran);

        $data = [
            "title" => "Keranjang",
            "totalBayar" => $totalBayar,
            "keranjang" => $keranjang
        ];

        return view('kasir/keranjang', $data);
    }

    public function masukanKeranjang()
    {
        // Mendapatkan data dari form pemesanan
        $kdTran = $this->request->getPost('idTran');
        $idMenu = $this->request->getPost('id_menu');
        $jumlah = $this->request->getPost('qty');
        $total = $this->request->getPost('totalHarga');

        // Menyimpan data kedalam db pre_transaksi
        $an = new PretransModel();
        $an->saveToCart($kdTran, $idMenu, $jumlah, $total);

        if ($an) {
            return redirect()->to(base_url('/keranjang/' . $kdTran));
        }
    }

    public function deleteMenu($id)
    {
        $keranjang = new PretransModel();
        $keranjang->deleteItem($id);

        return redirect()->back();
    }

    public function checkout($noTrx)
    {
        $db = new PretransModel();
        $tBayar = $db->totalBayar($noTrx);
        $tItem = $db->totalItem($noTrx);
        $tgl = date('Y/m/d');
        $idKasir = session()->get('id_user');

        // Simpan ke db Transaksi
        $transaksi = new TransaksiModel();
        $transaksi->saveTransaksi($idKasir, $tgl, $tItem, $tBayar);

        if ($transaksi) {
            return redirect()->to(base_url('/kasir/struk'));
        }
    }

    public function riwayatKasir($id)
    {
        $transaksi = new TransaksiModel();
        $total = $transaksi->totalTransaksiById($id);
        $data = [
            "title" => "Keranjang",
            'total' => $total
        ];

        return view('kasir/riwayat', $data);
    }

    public function dtRiwayat()
    {
        $id_kasir = session()->get('id_user');
        $datatables = new Datatables;
        $datatables->table('transaksi')->select('tgl, qty, total')->where(['id_user' => $id_kasir]);
        echo $datatables->draw();
    }

    public function struk()
    {
        $tr = new TransaksiModel();
        $an = new PretransModel();
        $keranjang = $tr->struk(27);
        $totalBayar = $an->totalBayarKeranjang(27);
        $data = [
            "title" => "detail-transaksi",
            "totalBayar" => $totalBayar,
            "keranjang" => $keranjang
        ];

        return view('kasir/struk', $data);
    }

    public function cetakStruk()
    {
        $dompdf = new \Dompdf\Dompdf();
        $tr = new TransaksiModel();
        $an = new PretransModel();
        $keranjang = $tr->struk(27);
        $totalBayar = $an->totalBayarKeranjang(27);
        $data = [
            "title" => "detail-transaksi",
            "totalBayar" => $totalBayar,
            "keranjang" => $keranjang
        ];
        $dompdf->loadHtml(view('kasir/layout/pdf/struk', $data));
        $options = $dompdf->getOptions();
        $options->setDefaultFont('Courier');
        $dompdf->setPaper('A5', 'portrait');
        $dompdf->render();
        $dompdf->stream();
    }
}