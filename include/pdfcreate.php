<?php 
//DOMPDF
require plugin_dir_path(__FILE__) . '/include/dompdf/lib/html5lib/Parser.php';
require plugin_dir_path(__FILE__) . '/include/dompdf/lib/php-font-lib/src/FontLib/Autoloader.php';
require plugin_dir_path(__FILE__) . '/include/dompdf/lib/php-svg-lib/src/autoload.php';
require plugin_dir_path(__FILE__) . '/include/dompdf/src/Autoloader.php';
Dompdf\Autoloader::register();

// reference the Dompdf namespace
// use Dompdf\Dompdf;
require plugin_dir_path(__FILE__) .'/include/dompdf/autoload.inc.php'; 

// Reference the Dompdf namespace 
use Dompdf\Options; 
use Dompdf\Dompdf; 

function wl_generate_certificate(){
    // Instantiate and use the dompdf class 
    $options = new Options();
    $options->set('defaultMediaType', 'all');
    $options->set('isFontSubsettingEnabled', true);
    // $options->set('defaultFont', 'Roboto');
    $options->set('isRemoteEnabled', true);
    $dompdf = new Dompdf($options);
    $date = date("m.d.Y");
        // Load content from html file 
    $html = '        <img class="bg" src="https://staging6.hvacrschool.com/wp-content/uploads/2021/05/certificate-bckgrnd_without_logo-01.png" alt="">';

    $dompdf->loadHtml($html);

    // (Optional) Setup the paper size and orientation 
    $dompdf->setPaper('A4', 'landscape'); 

    // Render the HTML as PDF 
    $dompdf->render(); 
     $pdf = $dompdf->output(); 
    // file_put_contents(ABSPATH.'/wp-content/uploads/pdf_certificate/test3.pdf', $pdf);
     // $cont = file_get_contents($pdf);
    // $upload = wp_upload_bits( $name.'.pdf', null, $cont );
    // return $upload
    // Output the generated PDF (1 = download and 0 = preview) 
    // $dompdf->stream("certificate", array("Attachment" => 1));
    // $dir = wp_get_upload_dir();
    // $data = $dir['baseurl'].'/pdf_certificate/test3.pdf';
    // return $data;
}
