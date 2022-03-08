<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
  protected $table = 'user';
  protected $primaryKey = 'id_user';
  protected $returnType = 'object';
  protected $allowedFields = ['username', 'password', 'nama', 'role'];

  public function totalKasir()
  {
    return $this->db->table('user')->where('role', 'kasir')->countAllResults();
  }

  public function totalManager()
  {
    return $this->db->table('user')->where('role', 'manager')->countAllResults();
  }

  public function addPegawai($nama, $username, $password, $jabatan)
  {
    $pegawai = new UserModel();
    $pw = password_hash($password, PASSWORD_BCRYPT);
    $pegawai->insert([
      'nama' => $nama,
      'username' => $username,
      'password' => $pw,
      'role' => $jabatan,
    ]);
  }

  public function suntingPegawai($id, $nama, $jabatan)
  {
    $pegawai = new UserModel();
    $pegawai->update($id, [
      'nama' => $nama,
      'role' => $jabatan
    ]);
  }

  public function deletePegawai($id)
  {
    $pegawai = new UserModel();
    $pegawai->where('id_user', $id)->delete();
  }
}
