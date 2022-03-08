<?php

namespace App\Controllers;

use App\Libraries\Datatables;
use App\Models\MenuModel;
use App\Models\TransaksiModel;
use App\Models\UserModel;

class Adman extends BaseController
{
  private $db;

  public function __construct()
  {
    $this->db = db_connect();
    $this->builder = $this->db;
  }

  public function index()
  {
    $transaksi = new TransaksiModel();
    $user = new UserModel();

    // Total transaksi
    $tTransaksi = $transaksi->totalTransaksi();

    // Total pendapatan
    $tPendapatan = $transaksi->totalPendapatan();

    // Total kasir
    $tKasir = $user->totalKasir();

    // Total manager
    $tManager = $user->totalManager();

    $data = [
      'title' => 'Dashboard',
      'page' => 'dashboard',
      'tTransaksi' => $tTransaksi,
      'tPendapatan' => $tPendapatan,
      'tKasir' => $tKasir,
      'tManager' => $tManager
    ];

    $level = session()->get('role');
    if ($level == "admin" || $level == "manager") {
      return view('adman/index', $data);
    } else {
      return redirect()->back();
    }
  }

  // Manager
  public function manageMenu()
  {
    $data = [
      'title' => 'Manage Menu',
      'page' => 'mMenu'
    ];

    return view('adman/mMenu', $data);
  }

  public function addMenu()
  {
    $menu = new MenuModel();
    $nama = $this->request->getPost('nama');
    $harga = $this->request->getPost('harga');
    $jenis = $this->request->getPost('jenis');
    $menu->insertMenu($nama, $harga, $jenis);

    if ($menu) {
      session()->setFlashdata('sukses', 'Berhasil mengedit menu');
      return redirect()->back();
    }
  }

  public function suntingMenu($id)
  {
    $menu = new MenuModel();
    $nama = $this->request->getPost('nama');
    $jenis = $this->request->getPost('jenis');
    $harga = $this->request->getPost('harga');
    $menu->updateMenu($id, $nama, $jenis, $harga);

    if ($menu) {
      session()->setFlashdata('edited', 'Berhasil mengedit menu');
      return redirect()->back();
    }
  }

  public function deleteMenu($id)
  {
    $menu = new MenuModel();
    $menu->deleteMenu($id);

    if ($menu) {
      session()->setFlashdata('deleted', 'Berhasil menghapus menu');
      return redirect()->back();
    }
  }

  public function mLogKasir()
  {
    $data = [
      'title' => 'Log Kasir',
      'page' => 'mLog'
    ];

    return view('adman/mLogKasir', $data);
  }

  public function rekapTransaksiAllKasir()
  {
    $transaksi = new TransaksiModel();

    // Rekap transaksi per Kasir
    $perkasir = $this->rekapPerkasir();
    $detailPerkasir = $this->detailRekapPerkasir();
    $total = $transaksi->totalPendapatan();

    $data = [
      'title' => 'Rekap Transaksi',
      'page' => 'mRT',
      'totalAllPerkasir' => $perkasir,
      'detailPerkasir' => $detailPerkasir,
      'total' => $total
    ];

    return view('adman/mRekapAllKasir', $data);
  }

  public function rekapTransaksiHarian()
  {
    $transaksi = new TransaksiModel();

    // Get date from db Transaksi
    $getDate = $this->getDate();

    // Rekap perdate
    $tgl = $this->request->getPost('date');
    if ($tgl) {
      $tglNow = $tgl;
    } else {
      $tglNow = '2022-01-29';
    }
    $date = $this->rekapPerDate($tgl);
    $total = $transaksi->totalPendapatanByDate($tglNow);

    $data = [
      'title' => 'Rekap Transaksi',
      'page' => 'mRT',
      'getDate' => $getDate,
      'totalPerDate' => $date,
      'total' => $total
    ];

    return view('adman/mRekapHarian', $data);
  }

  public function rekapTransaksiBulanan()
  {
    $transaksi = new TransaksiModel();

    // Get date from db Transaksi
    $getDate = $this->getDate();

    // Rekap transaksi month to month
    $month1 = $this->request->getPost('mth1');
    $month2 = $this->request->getPost('mth2');

    if ($month1 && $month2) {
      $date1 = $month1;
      $date2 = $month2;
    } else {
      $date1 = '2022-01-29';
      $date2 = '2022-01-31';
    }

    $monthToMonth = $this->rekapMonthToMonth($month1, $month2);
    $total = $transaksi->totalPendapatanByMonth($date1, $date2);

    $data = [
      'title' => 'Rekap Transaksi',
      'page' => 'mRT',
      'getDate' => $getDate,
      'mtm' => $monthToMonth,
      'total' => $total
    ];

    return view('adman/mRekapBulanan', $data);
  }

  public function rekapTransaksi()
  {
    // Rekap semua Transaksi
    $totalAllTransaksi = $this->totalAllTransaksi();
    $totalAllItemTransaksi = $this->totalAllItemTransaksi();
    $menuFavorit = $this->bestMenu();

    $data = [
      'title' => 'Rekap Transaksi',
      'page' => 'mRT',
      'totalTransaksi' => $totalAllTransaksi,
      'totalPenjualan' => $totalAllItemTransaksi,
      'bestMenu' => $menuFavorit,
    ];

    return view('adman/mRekapTransaksi', $data);
  }

  // Admin
  public function managePegawai()
  {
    $data = [
      'title' => 'Manage Pegawai',
      'page' => 'mPegawai'
    ];

    return view('adman/mPegawai', $data);
  }

  public function addPegawai()
  {
    $pegawai = new UserModel();
    $nama = $this->request->getPost('nama');
    $username = $this->request->getPost('username');
    $password = $this->request->getPost('password');
    $jabatan = $this->request->getPost('jabatan');
    $pegawai->addPegawai($nama, $username, $password, $jabatan);

    if ($pegawai) {
      session()->setFlashdata('sukses', 'User berhasil ditambahkan');
      return redirect()->back();
    }
  }

  public function suntingPegawai($id)
  {
    $pegawai = new UserModel();
    $nama = $this->request->getPost('nama');
    $jabatan = $this->request->getPost('jabatan');
    $pegawai->suntingPegawai($id, $nama, $jabatan);

    if ($pegawai) {
      session()->setFlashdata('edited', 'User berhasil ditambahkan');
      return redirect()->back();
    }
  }

  public function deletePegawai($id)
  {
    $pegawai = new UserModel();
    $pegawai->deletePegawai($id);

    if ($pegawai) {
      session()->setFlashdata('deleted', 'Berhasil menghapus pegawai');
      return redirect()->back();
    }
  }

  public function logPegawai()
  {
    $data = [
      'title' => 'Log Pegawai',
      'page' => 'mLog'
    ];

    return view('adman/mLogPegawai', $data);
  }

  public function profile()
  {
    $appName = $this->detProfile();
    $admAcc = $this->detProfileAdm();
    $data = [
      'app_name' => $appName,
      'adm_acc' => $admAcc,
      'title' => 'Administrator Profile',
      'page' => 'mProfile'
    ];

    return view('adman/mProfile', $data);
  }

  public function updateProfileApp()
  {
    $appName = $this->request->getPost('nameApp');
    $updating = $this->upProfileApp($appName);

    if ($updating) {
      return redirect()->back();
    }
  }

  // Private function
  private function detProfileAdm()
  {
    $adm = $this->db->table('user')
      ->select('*')
      ->where("role", "admin")
      ->get()
      ->getRow();
    return $adm;
  }

  private function detProfile()
  {
    $profile = $this->db->table('settings')
      ->select('app_name')
      ->get()
      ->getRow()
      ->app_name;
    return $profile;
  }

  private function upProfileApp($appName)
  {
    $updating = $this->db->table('settings')
      ->update(["app_name" => $appName]);
    return $updating;
  }

  private function totalAllTransaksi()
  {
    $totalAll = $this->db->table('transaksi')
      ->selectSum('total', 'totalTransaksi')
      ->get()
      ->getRow()
      ->totalTransaksi;
    return $totalAll;
  }

  private function bestMenu()
  {
    $bestMenu = $this->db->table('pre_transaksi')
      ->select('id_menu')
      ->get()
      ->getRow()
      ->id_menu;
    return $bestMenu;
  }

  private function totalAllItemTransaksi()
  {
    $totalAllItem = $this->db->table('transaksi')
      ->selectSum('qty')
      ->get()
      ->getRow()
      ->qty;
    return $totalAllItem;
  }

  private function getDate()
  {
    $date = $this->db->table('transaksi')
      ->select('tgl')
      ->groupBy('tgl')
      ->get()
      ->getResult();
    return $date;
  }

  private function rekapMonthToMonth($month1, $month2)
  {
    if ($month1 && $month2) {
      $date1 = $month1;
      $date2 = $month2;
    } else {
      $date1 = '2022-01-29';
      $date2 = '2022-01-31';
    }

    $mtm = $this->db->table('transaksi')
      ->select('nama, transaksi.id_user, transaksi.tgl')
      ->selectSum('qty', 'jumlah')
      ->selectSum('total', 'totalPendapatan')
      ->join('user', 'user.id_user = transaksi.id_user')
      ->where('transaksi.tgl >=',  $date1)
      ->where('transaksi.tgl <=',  $date2)
      ->groupBy('transaksi.id_user')
      ->get()
      ->getResult();
    return $mtm;
  }

  private function rekapPerkasir()
  {
    $totalAllPerkasir = $this->db->table('transaksi')
      ->select('user.nama, transaksi.id_user, transaksi.no_trx')
      ->selectSum('transaksi.qty', 'jumlah')
      ->selectSum('transaksi.total', 'totalPendapatan')
      ->join('user', 'user.id_user = transaksi.id_user')
      ->groupBy('transaksi.id_user')
      ->get()
      ->getResult();
    return $totalAllPerkasir;
  }

  private function detailRekapPerkasir()
  {
    $detailTotalAllPerkasir = $this->db->table('transaksi')
      ->select('*')
      ->selectSum('pre_transaksi.qty', 'jumlah')
      ->join('pre_transaksi', 'pre_transaksi.no_trx = transaksi.no_trx')
      ->join('user', 'user.id_user = transaksi.id_user')
      ->join('menu', 'menu.id_menu = pre_transaksi.id_menu')
      ->groupBy('pre_transaksi.id_menu')
      ->get()
      ->getResult();
    return $detailTotalAllPerkasir;
  }

  private function rekapPerDate($tgl)
  {
    if ($tgl) {
      $date = $tgl;
    } else {
      $date = '2022-01-29';
    }

    $totalPerDate = $this->db->table('transaksi')
      ->select('nama, transaksi.id_user, transaksi.tgl')
      ->selectSum('qty', 'jumlah')
      ->selectSum('total', 'totalPendapatan')
      ->join('user', 'user.id_user = transaksi.id_user')
      ->where('transaksi.tgl',  $date)
      ->groupBy('transaksi.id_user')
      ->get()
      ->getResult();
    return $totalPerDate;
  }

  // Datatables
  public function dtPegawai()
  {
    $datatables = new Datatables;
    $datatables->table('user')->select('id_user, nama, role')->where(['role !=' => 'admin']);
    echo $datatables->draw();
  }

  public function dtMenu()
  {
    $datatables = new Datatables;
    $datatables->table('menu')->select('id_menu, nama, harga, jenis');
    echo $datatables->draw();
  }

  public function dtLog()
  {
    $datatables = new Datatables;
    $datatables->table('user')->select('nama, log, logout, role')->join('log', 'log.id_user = user.id_user');
    echo $datatables->draw();
  }

  public function dtLogKasir()
  {
    $datatables = new Datatables;
    $datatables->table('user')->select('nama, log, logout')->join('log', 'log.id_user = user.id_user')->where(['role' => 'kasir']);
    echo $datatables->draw();
  }
}
