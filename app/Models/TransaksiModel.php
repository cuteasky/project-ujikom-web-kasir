<?php

namespace App\Models;

use CodeIgniter\Model;

class TransaksiModel extends Model
{
  protected $table = 'transaksi';
  protected $primaryKey = 'no_trx';
  protected $returnType = 'object';
  protected $allowedFields = ['id_user', 'tgl', 'qty', 'total'];

  public function saveTransaksi($idKasir, $tgl, $tItem, $tBayar)
  {
    $transaksi = new TransaksiModel();
    $transaksi->insert([
      'id_user' => $idKasir,
      'tgl' => $tgl,
      'qty' => $tItem,
      'total' => $tBayar
    ]);
  }

  public function noticeTable()
  {
    $builder = $this->db->query('SELECT transaksi.id_user, nama as nama, SUM(qty) as jumlah, SUM(total) as pendapatan FROM transaksi JOIN user ON user.id_user = transaksi.id_user GROUP BY transaksi.id_user');
    return $builder;
  }

  public function struk($id)
  {
    return $this->db->table('pre_transaksi')->select('*')->join('menu', 'menu.id_menu = pre_transaksi.id_menu')->where('no_trx', $id)->get()->getResult();
  }

  public function totalTransaksi()
  {
    return $this->db->table('transaksi')->selectSum('qty')->get()->getRow()->qty;
  }

  public function totalPendapatan()
  {
    return $this->db->table('transaksi')->selectSum('total')->get()->getRow()->total;
  }

  public function totalPendapatanByDate($tgl)
  {
    return $this->db->table('transaksi')->selectSum('total')->where('tgl', $tgl)->get()->getRow()->total;
  }

  public function totalPendapatanByMonth($date1, $date2)
  {
    return $this->db->table('transaksi')->selectSum('total')->where('tgl >=', $date1)->where('tgl <=', $date2)->get()->getRow()->total;
  }

  public function lastIdTransaksi()
  {
    return $this->db->table('transaksi')->selectMax('no_trx', 'maxIdTrx')->get()->getRow()->maxIdTrx;
  }

  public function totalTransaksiById($id)
  {
    return $this->db->table('transaksi')->selectSum('total')->where('id_user', $id)->get()->getRow()->total;
  }
}