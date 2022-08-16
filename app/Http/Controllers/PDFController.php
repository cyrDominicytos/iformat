<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;

class PDFController extends Controller
{
    public function presence_pdf($data, $download)
    {     
        $pdf = PDF::loadView('pdf/presence', $data);
        if($download==1)
            return $pdf->download('presence.pdf');
        else
            return $pdf->stream('presence.pdf');

    }
    public function certif_presence_pdf($data, $download)
    {     
        $pdf = PDF::loadView('pdf/certif_presence', $data);
        if($download==1)
            return $pdf->download('presence.pdf');
        else
            return $pdf->stream('presence.pdf');

    }
}
