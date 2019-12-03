<?php 

use Fpdf\Fpdf;

//include_once("_fonts/ funcoes.php");

header('Content-Type: text/html; charset=utf-8');


//Connect to your database
// include ('../../_fonts/config/banco.php');
// Connect to database...

//Define informações locais 
setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');


$str = date('d-m-Y');
//resultado: Mar

$pdf = new FPDF();
$pdf->AliasNbPages();
$pdf->AddPage();

//$pdf->Image('./../img/planodeatendimento1.jpg', -2, 0,100); //primeiro valor posição em X,segundo valor posição em Y, terceiro valor tamanho



$pdf->Output('I', 'Plano de Atendimento - .pdf');
