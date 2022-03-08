<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Struk extends Controller
{
    public function index()
    {
        return view('kasir/struk');
    }
    function htmlToPDF()
    {
        $dompdf = new \Dompdf\Dompdf();
        $dompdf->loadHtml(view('kasir/struk'));
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream();
    }
}