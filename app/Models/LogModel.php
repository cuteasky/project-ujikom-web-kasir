<?php

namespace App\Models;

use CodeIgniter\Model;

class LogModel extends Model
{
  protected $table = 'log';
  protected $primaryKey = 'id_log';
  protected $returnType = 'object';
  protected $allowedFields = ['id_user', 'log', 'logout'];

  public function insertLog($id)
  {
    date_default_timezone_set("Asia/Bangkok");
    $log = new LogModel();
    $log->insert([
      'id_user' => $id,
      'log' => date('Y/m/d H:i:s')
    ]);
  }
}
