<?php
require_once '../vendor/autoload.php';
use Dompdf\Dompdf;

$dompdf = new Dompdf();

ob_start();
include('conteudopdf.php'); 
$html = ob_get_clean();
$html = "
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset='UTF-8'>
    </head>
    <body>
        " . $html ."
    </body>
    </html>
";

$dompdf->loadHtml($html);

$dompdf->setPaper('A4');

$dompdf->render();

$dompdf->stream();
?>