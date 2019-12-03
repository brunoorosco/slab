<?php


$fileName = "./source/img/planodeatendimento.doc";

$phpWord = new \PhpOffice\PhpWord\PhpWord();

$templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor($fileName);

//require_once getcwd().'/vendor/autoload.php';

 $templateProcessor->setValue('empresa', 'John');
// $templateProcessor->setValue('CNPJ', '00.000.000/0001-00');


// $docxFile = "exp_.docx";
// $templateProcessor->saveAs($docxFile);
