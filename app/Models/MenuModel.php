<?php

namespace App\Models;

use CodeIgniter\Model;

class MenuModel extends Model
{
  protected $table = 'menu';
  protected $primaryKey = 'id_menu';
  protected $returnType = 'object';
  protected $allowedFields = ['nama', 'harga', 'jenis'];

  public function insertMenu($nama, $harga, $jenis)
  {
    $menu = new MenuModel();
    $menu->insert([
      'nama' => $nama,
      'harga' => $harga,
      'jenis' => $jenis,
    ]);
  }

  public function updateMenu($id, $nama, $jenis, $harga)
  {
    $menu = new MenuModel();
    $menu->update($id, [
      'nama' => $nama,
      'jenis' => $jenis,
      'harga' => $harga
    ]);
  }

  public function deleteMenu($id)
  {
    $menu = new MenuModel();
    $menu->where('id_menu', $id)->delete();
  }
}
