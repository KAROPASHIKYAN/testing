<?php 
    require __DIR__ .'/dompdf/lib/html5lib/Parser.php';
    require __DIR__ .'/dompdf/lib/php-font-lib/src/FontLib/Autoloader.php';
    require __DIR__ .'/dompdf/lib/php-svg-lib/src/autoload.php';
    require __DIR__ .'/dompdf/src/Autoloader.php';
    Dompdf\Autoloader::register();
    // reference the Dompdf namespace
    // use Dompdf\Dompdf;
    require __DIR__ .'/dompdf/autoload.inc.php'; 
     
    // Reference the Dompdf namespace 
    use Dompdf\Options; 
    use Dompdf\Dompdf; 
    function wl_generate_certificate($name_course, $name, $grade, $number, $result_post_id){
        // Instantiate and use the dompdf class 
        $options = new Options();
        $options->set('defaultMediaType', 'all');
        $options->set('isFontSubsettingEnabled', true);
        // $options->set('defaultFont', 'Roboto');
        $options->set('isRemoteEnabled', true);
        $dompdf = new Dompdf($options);
        $date = date("m.d.Y");
            // Load content from html file 
        $html = '<!DOCTYPE html>
                    <html>
                    <head>
                    <link rel="preconnect" href="https://fonts.gstatic.com">
                    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;1,100;1,200;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">
                        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                    </head>
                    <style>
                    
                    @page {
                        margin: 10px;
                    }
                   
                    body {
                        background-image: url(http://bart.loc/wp-content/uploads/2021/09/d4a1e897f6132ebccb915766355a29e4-e1632832368693.jpg);
                        font-family: "Poppins", sans-serif;
                        background-position: center center;
                        background-size: 784px 1100px;
                        margin: 0;
                        top: 0;
                        left: 0;
                        padding: 0;
                        color: #094473;

                    }
                    .certificatebody {
                        padding: 5% 12%;
                        z-index:2;
                        position:relative;
                        background:transparent;
                        text-align: center;
                    }
                    .certificatebody h1 {
                        text-align: center;
                        text-transform: uppercase;
                        font-size: 47px;
                        font-weight: 700;
                        margin-bottom: 200px;
                        line-height: 40px;
                        height:47px;
                        margin-top: 30px;
                    }
                    .signature {
                    }
                    p{
                        margin: 10px 0 5px;
                        font-size: 24px;
                        line-height:20px;
                        height:24px;
                    }
                    .signature h3{
                        float:left;
                        margin-top: 95px;
                        text-align:start;
                        font-weight:400;
                    }
                    .signature h3 strong{
                        padding-left: 5px;
                        letter-spacing: 0.6px;
                    }
                    .name{
                        font-size: 32px;
                        margin: 10px 0 10px;
                        text-transform: uppercase;
                        font-weight: 700;
                        line-height: 26px;
                    }
                    .name+p{
                        margin: 10px 0 0;
                    }
                    h3{
                        font-size: 26px;
                        line-height: 20px;
                        font-weight:400;

                    }
                    .name_course{   
                        font-size: 32px;
                        line-height: 32px;
                        text-transform: uppercase;
                        margin-bottom:20px;
                        margin-top:0px;
                        font-weight: 800;
                        height:32px;
                    }   
                    .logo{
                        height: 130px;
                        width: 300px;
                        
                        margin-top: 30px;
                        margin-bottom: 0px;
                    }
                    .sign{
                        position:absolute;
                        top:800px;
                        right:12%;
                        display: block;
                        width: 197px;
                        height: 147px;
                    }
                    .bryan{
                        position:absolute;
                        top:735px;
                        right:35%;
                        text-align:center;
                        font-size: 27px;
                        font-weight: 700;
                        line-height: 27px;
                    }
                    .bryan span{
                        display: block;
                        font-weight: 400;
                        font-size: 24px;
                        line-height: 27px;
                    }
                    br{
                        height:0px;
                        font-size: 0px;
                        line-height: 0px;
                    }
                    .registration{
                        text-align:center;
                        margin-top: 200px;
                    }
                    
                    </style>
                    <body>
                       
                        <div class="certificatebody">
                            <img class="logo" src="http://bart.loc/wp-content/uploads/2021/09/2.png" alt="">
                            <h1>Certificate <br>of<br>completion</h1>
                            <p>this is to certify that</p>
                            <p class="name">'. $name .'</p>
                            <p class="date">has successfully completed</p>
                            <p class="name_course">'. $name_course .'</p>
                            <p class="date">with a score of <strong> '.$grade.'/100</strong> </p>
                            <div class="signature">
                                <h3>date : <strong>'. $date .'</strong></h3>
                                <p class="bryan">Bryan Orr</p>
                                <img class="sign" src="https://staging6.hvacrschool.com/wp-content/uploads/2021/05/Bryan_Signature-final.png" alt="">
                                <p class="registration">Number of registration<br>'.$number.'</p>
                            </div>
                        </div>
                    </body>
                    </html>'; 
        $dompdf->loadHtml($html); 
         
        // (Optional) Setup the paper size and orientation 
        $dompdf->setPaper('A4', 'portrait'); 
         
        // Render the HTML as PDF 
        $dompdf->render(); 
        $pdf = $dompdf->output(); 
        $upload_dir = wp_get_upload_dir();
        if (!is_dir(ABSPATH.'/wp-content/uploads/pdf_certificate/')) {
            mkdir(ABSPATH.'/wp-content/uploads/pdf_certificate/');
        }
        file_put_contents(ABSPATH.'/wp-content/uploads/pdf_certificate/'.$name.''.$name_course.''.$grade. $result_post_id.'.pdf', $pdf);
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