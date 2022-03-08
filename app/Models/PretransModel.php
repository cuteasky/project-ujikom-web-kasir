<?php

namespace App\Models;

use CodeIgniter\Model;

class PretransModel extends Model
{
  protected $table = 'pre_transaksi';
  protected $primaryKey = 'id_trx';
  protected $returnType = 'object';
  protected $allowedFields = ['no_trx', 'id_menu', 'qty', 'total'];

  public function saveToCart($kdTran, $idMenu, $jumlah, $total)
  {
    $an = new PretransModel();
    $an->insert([
      'no_trx' => $kdTran,
      'id_menu' => $idMenu,
      'qty' => $jumlah,
      'total' => $total
    ]);
  }

  public function deleteItem($id)
  {
    $keranjang = new PretransModel();
    $keranjang->where('id_trx', $id)->delete();
  }

  public function totalItem($noTrx)
  {
    return $this->db->table('pre_transaksi')->selectSum('qty')->where('no_trx', $noTrx)->get()->getRow()->qty;
  }

  public function totalBayar($noTrx)
  {
    return $this->db->table('pre_transaksi')->selectSum('total')->where('no_trx', $noTrx)->get()->getRow()->total;
  }

  public function totalBayarKeranjang($kdTran)
  {
    return $this->db->table('pre_transaksi')->selectSum('total', 'totalBayar')->where('no_trx', $kdTran)->get()->getRow()->totalBayar;
  }

  public function lastIdKeranjang()
  {
    return $this->db->table('pre_transaksi')->selectMax('id_trx', 'maxId')->get()->getRow()->maxId;
  }

  public function valueKeranjang($kdTran)
  {
    $an = new PretransModel();
    $keranjang = $an->where('no_trx', $kdTran)->join('menu', 'menu.id_menu = pre_transaksi.id_menu')->findAll();
    return $keranjang;
  }
}
