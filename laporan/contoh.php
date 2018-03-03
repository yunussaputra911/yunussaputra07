<?php
$filename="contoh-dokumen.pdf";
$content = ob_get_clean();
$content = '<page style="font-family: freeserif"><br />'.nl2br($content).'</page>';
// conversion HTML => PDF
require_once(dirname(__FILE__).'/html2pdf.class.php'); // arahkan ke folder html2pdf
try
{
$html2pdf = new HTML2PDF('P','A4','fr', false, 'ISO-8859-15',array(30, 0, 20, 0)); //setting ukuran kertas dan margin pada dokumen anda
// $html2pdf->setModeDebug();
$html2pdf->setDefaultFont('Arial');
$html2pdf->writeHTML($content, isset($_GET['vuehtml']));
$html2pdf->Output($filename);
}
catch(HTML2PDF_exception $e) { echo $e; }
?>