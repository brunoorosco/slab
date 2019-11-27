<?php

use Dompdf\Dompdf;
use Dompdf\Options;



//Para consolidar o CSS do Bootstrap via CDN no DomPDF, será necessário habilitar o acesso 
$options = new Options();
$options->set('isRemoteEnabled', TRUE);


$dompdf = new Dompdf($options);
// $dompdf->set_base_path('./assests/');
ob_start();
require __DIR__."/etiquetas.php";
$dompdf->loadHtml(ob_get_clean());

$customPaper = array(0, 0, 297, 240);
$dompdf->setPaper($customPaper);

$dompdf->render();

$dompdf->stream("etiqueta.pdf", ["Attachment" => false]);
