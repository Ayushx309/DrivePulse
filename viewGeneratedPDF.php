<?php

require_once('lib/dompdf/autoload.inc.php');

use Dompdf\Dompdf;
use Dompdf\Options;

$options = new Options();
$options->set('chroot',realpath(''));
$pdf = new Dompdf($options);


ob_start();

include('viewpdf.php');

$htmlCode = ob_get_clean();


$pdf->loadHtml($htmlCode);

$pdf->setPaper('A4', 'portrait');

$pdf->render();

$pdf->stream('test.pdf', array('Attachment' => false));

?>