<?php

require_once '../vendor/autoload.php';
require_once '../models/Revisionmedica.php';

$revisionmedica = new Revisionmedica();


use Spipu\Html2Pdf\Html2Pdf;
use Spipu\Html2Pdf\Exception\Html2PdfException;
use Spipu\Html2Pdf\Exception\ExceptionFormatter;

if (isset($_GET["idrevision"])) {
  // asignar w1 y w2 a dos variables
  $idrevision = $_GET["idrevision"];
}

try{

  $clave = $revisionmedica->reporteCompleto(['idrevision' => $idrevision]);
  
  ob_start();

  $data = "";

  // cargar estilos
  include './informe/estilos.html';
  //Páginas:
  include './informe/historia-clinica.php';

  //Otras páginas:
  $data .= ob_get_clean();

  //Creando espacio
  //   P vertical / L en horizontal
  $html2pdf = new Html2Pdf('P', 'A4', 'fr', true, 'utf-8', array(10,10,15,15));
  $html2pdf->setDefaultFont('Arial');
  $html2pdf->writeHTML($data);

  $html2pdf->output('reporte-senati.pdf');

}
catch(Html2PdfException $e){
  $html2pdf->clean();
  $formatter = new ExceptionFormatter($e);
  echo $formatter->getHtmlMessage();
}

?>



