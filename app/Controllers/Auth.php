<?php

namespace App\Controllers;

use App\Models\LogModel;
use App\Models\UserModel;

class Auth extends BaseController
{
  private $db;

  public function __construct()
  {
    $this->db = db_connect();
    $this->builder = $this->db;
  }

  public function index()
  {
    $data = [
      "title" => "Login"
    ];

    return view('auth/login', $data);
  }

  public function login()
  {
    $users = new UserModel();
    $username = $this->request->getPost('username');
    $password = $this->request->getPost('password');
    $user = $users->where([
      "username" => $username
    ])->first();

    if ($user) {
      if (password_verify($password, $user->password)) {
        $ns = explode(' ', trim($user->nama));
        session()->set([
          'id_user' => $user->id_user,
          'username' => $user->username,
          'namaShort' => $ns[0],
          'nama' => $user->nama,
          'role' => $user->role,
          'logged_in' => TRUE
        ]);

        // Menyimpan log
        $log = new LogModel();
        $idUser = $user->id_user;
        $log->insertLog($idUser);

        if ($user->role == 'kasir') {
          return redirect()->to(base_url('/kasir'));
        } elseif ($user->role == 'manager') {
          return redirect()->to(base_url('/manager'));
        } else {
          return redirect()->to(base_url('/admin'));
        }
      } else {
        session()->setFlashdata('error', 'Password Salah!');
        return redirect()->back();
      }
    } else {
      session()->setFlashdata('error', 'Cek kembali!');
      return redirect()->back();
    }
  }

  function logout($id_user)
  {
    // update log
    $logouted = $this->updateLog($id_user);
    if ($logouted) {
      session()->destroy();
      return redirect()->to(base_url());
    }
  }

  private function updateLog($id_user)
  {
    date_default_timezone_set("Asia/Bangkok");
    $date = date('Y/m/d H:i:s');
    $this->db->table("log")
      ->update(["logout" => $date], ["id_user" => $id_user]);
    return $this;
  }
}
