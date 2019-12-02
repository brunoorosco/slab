<?php

use Dompdf\Dompdf;
use Dompdf\Options;



$hmtl = "<html>
    <head>
    <style>
    /** 
    * Set the margins of the PDF to 0
    * so the background image will cover the entire page.
    **/
    @page {
        margin: 0cm 0cm;
    }

    /**
    * Define the real margins of the content of your PDF
    * Here you will fix the margins of the header and footer
    * Of your background image.
    **/
    body {
        margin-top:    3.5cm;
        margin-bottom: 1cm;
        margin-left:   1cm;
        margin-right:  1cm;
    }

    /** 
    * Define the width, height, margins and position of the watermark.
    **/
    #watermark {
        position: fixed;
        bottom:   0px;
        left:     0px;
        /** The width and height may change 
            according to the dimensions of your letterhead
        **/
        width:    21.8cm;
        height:   28cm;

        /** Your watermark should be behind every content**/
        z-index:  -1000;
    }
</style>
    </head>
    <body>
        <div id='watermark'>
            <h1>hello</h1>"
            .url("Source/img/planodeatendimento.doc'")."
          <img src=".url('Source/img/planodeatendimento.doc')." height='50%' width='50%' />
        </div>

      
    </body>
</html>";


//Para consolidar o CSS do Bootstrap via CDN no DomPDF, será necessário habilitar o acesso 
$options = new Options();
$options->set('isRemoteEnabled', TRUE);


$dompdf = new Dompdf($options);
// $dompdf->set_base_path('./assests/');
//ob_start();
//require __DIR__ . "/htmlEtiquetas.php";
$dompdf->loadHtml($hmtl);

$customPaper = array(0, 0, 297, 240);
$dompdf->setPaper('A4', '');

$dompdf->render();

$dompdf->stream("etiqueta.pdf", ["Attachment" => false]);
