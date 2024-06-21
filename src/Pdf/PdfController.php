<?php
namespace App\Pdf;

use Dompdf\Dompdf;

class PdfController
{
    public function generatePdf()
    {
        $dompdf= new Dompdf();
        $dompdf->loadHtml("hello");

        $dompdf->setPaper('A4','portrait');

        $dompdf->render();

        $dompdf->stream('docu.pdf',array('Attachment'=>false));
    }
}