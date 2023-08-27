<?php

require_once('lib/dompdf/autoload.inc.php');

use Dompdf\Dompdf;
use Dompdf\Options;

$options = new Options();
$options->set('chroot',realpath(''));
$pdf = new Dompdf($options);


ob_start();

include('mailReceipt.php');

$htmlCode = ob_get_clean();


$pdf->loadHtml($htmlCode);

$pdf->setPaper('A4', 'portrait');

$pdf->render();

$savePath = 'addmission_pdf/test.pdf';
file_put_contents($savePath, $pdf->output());

// // Output the PDF for preview
// header('Content-Type: application/pdf');
// header('Content-Disposition: inline; filename="test.pdf"');


?>