<?php

namespace Source\Models;

use PhpOffice\Common;
use Phpoffice\PhpWord;
use CoffeeCode\DataLayer\DataLayer;

class PlanoModel extends DataLayer
{
    public function __construct()
    {
        parent::__construct(
            "pedidoensaios",
            [
                //'Sequencial',
                'CodNomeEmpr',
                'DataInicio',
                'DataFim',
                //'ResponsavelAtendimento',
                'DataSolicitacao',
                //'DataAnalCritica',
                //'ResponsavelAnalise',
                'DataResposta',
                'FormaRecebimento',
                //'DataAprovacao',
                //'Obs',
                // 'DataCadastro',
                // 'HoraCadastro',
                'Usuario',
                //'Status'
            ],
            "Codigo",
            false
        );
    }

    public function print($infoPlano, $infoEmpresa)
    {
        
        /**Conversão das variaveis para correção no ato da impressão */
        $dataInicio = date("d/m/Y", strtotime(str_replace('-', '/', $infoPlano->DataInicio)));
        $datafinal = date("d/m/Y", strtotime(str_replace('-', '/', $infoPlano->DataFim)));
        $dataSol = date("d/m/Y", strtotime(str_replace('-', '/', $infoPlano->DataSolicitacao)));
        $dataResp = date("d/m/Y", strtotime(str_replace('-', '/', $infoPlano->DataResposta)));
        $cnpj = vsprintf("%s%s.%s%s%s.%s%s%s/%s%s%s%s-%s%s", str_split($infoEmpresa->CNPJ));

        $file = './Source/assests/plano.docx';

        $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor($file);
        $fontStyle = new \PhpOffice\PhpWord\Style\Font();
        $fontStyle->setBold(true);
        $fontStyle->setName('Tahoma');
        $fontStyle->setSize(13);
        $templateProcessor->setValue('ano', date("Y"));
        $templateProcessor->setValue('empresa', $infoEmpresa->Nome);
        $templateProcessor->setValue('cnpj', $cnpj);
        $templateProcessor->setValue('contato', $infoEmpresa->Contato);
        $templateProcessor->setValue('endereco', $infoEmpresa->Endereco);
        $templateProcessor->setValue('numero',   $infoEmpresa->Numero);
        $templateProcessor->setValue('email',   $infoEmpresa->Email);
        $templateProcessor->setValue('telefone', $infoEmpresa->Telefone);
        $templateProcessor->setValue('responsavel', $infoPlano->ResponsavelAtendimento);
        $templateProcessor->setValue('quantidades', '10');
        $templateProcessor->setValue('dataIni', $dataInicio);
        $templateProcessor->setValue('dataFim', $datafinal);
        $templateProcessor->setValue('dataRes', $dataResp);
        $templateProcessor->setValue('tipoSol', $infoPlano->FormaRecebimento);
        $templateProcessor->setValue('dataSol', $dataSol);
        $templateProcessor->setValue('nProposta', $infoPlano->Sequencial);
        $templateProcessor->setValue('tecnico', $infoPlano->ResponsavelAnalise);
        //   var_dump($dataInicio);

        $id = $infoPlano->Sequencial;
        $file = $id . '.docx';
        $filename = './Source/assests/planosImpressos/' . $file;
        $templateProcessor->saveAs($file);
        // if ($templateProcessor->saveAs($fileOutput)) return true;

        // else return false;

        // The following offers file to user on client side: deletes temp version of file
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . $file);
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Pragma: public');
        header('Content-Length: ' . filesize($file));
        flush();
        readfile($file);
        unlink($file); // deletes the temporary file
        return true;
    }
    
    public function planoEmpresa()
    {
      return (new Empresa())->find("Codigo = :uid","uid={$this->codigo}")->fetch(true);
      
    }
}
