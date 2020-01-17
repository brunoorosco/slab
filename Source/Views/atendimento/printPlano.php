<?php  $v->layout("theme/sidebar");

$file = asset('plano.docx');

$templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor($file);

$templateProcessor->setValue('data', date("d-m-Y"));
$templateProcessor->setValue('empresa', 'ESTE SERÁ O NOME DA EMPRESA');
$templateProcessor->setValue('cnpj', '00.000.000/0001-00');
$templateProcessor->setValue('contato', 'Fulano');
$templateProcessor->setValue('endereco' , 'street');
$templateProcessor->setValue('telefone' , '(11) 54321-0989');
$templateProcessor->setValue('responsavel', 'Bruno Orosco');
$templateProcessor->setValue('quantidade', '10');
$templateProcessor->setValue('email', 'emailempresa@provedor.com');

$id = "0002";
$fileOutput = './Source/assests/planosImpressos/' . $id . '.docx';

$templateProcessor->saveAs($fileOutput);

echo "Impresso com sucesso!!!";
  