<?php

/**
 * Check If file exists and user
 * must be login in order to view the file.
 */

class Checkuplodad extends CI_Controller
{

    /**
     * Undocumented function
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Ion_auth_model');
        
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function index()
    {
        if (!empty($_GET['req'])) {
            // check if user is logged
            if ($this->ion_auth->logged_in()) {
                // $ptype=1; // tracking the type of file is being requested
                // if (strpos($url, 'report_problem') !== false) {
                //     $pdf_name = md5(time()).'.png';
                //     $ptype=2;
                // } elseif (strpos($url, 'Signature') !== false) {
                //     $filename = "signature.zip";
                //     $ptype=3;
                // } else {
                //     $pdf_name = md5(time()).'.pdf';
                // }

                $parse_url = pathinfo($_GET['req']);
                $file_check = $_SERVER['DOCUMENT_ROOT'].'/uploads/'.$parse_url['basename'];
                if (file_exists($file_check)) {
                    if ($parse_url['extension'] === 'jpg' || $parse_url['extension'] === 'png' || $parse_url['extension'] === 'jpeg') {
                        header('Content-Type: image/jpg');
                    } elseif ($parse_url['extension'] === 'pdf') {
                        header('Content-Type: application/pdf');
                    } elseif ($parse_url['extension'] === 'doc' || $parse_url['extension'] === 'docx') {
                        header('Content-Type: application/msword');
                    } elseif ($parse_url['extension'] === 'ppt' || $parse_url['extension'] === 'pptx') {
                        header('Content-Type: application/vnd.ms-powerpoint');
                    }
                    
                    ob_clean();
                    echo file_get_contents($file_check);
                } else {
                    echo 'This file does not exists in system.';
                    // redirect('My404');
                }
            } else {
                // redirect('My404');
                echo 'Direct Access Forbidden';
                exit;
            }
            die;
        }
    }
}



// class controller_file extends CI_Controller
// {
// public function __construct()
// {
//    parent::__construct();
// }

// public function index()
// {
//   //print_r($_GET);
//   if( !empty( $_GET['req'] ) )
//     {
//       // check if user is logged

//       if(!empty($this->session->userdata("is_loggedin")))
//       {
//         $url = $_GET['req'];
//         $ptype=1; // tracking the type of file is being requested
//         if (strpos($url, 'report_problem') !== false) {
//             $pdf_name = md5(time()).'.png';
//             $ptype=2;
//         }elseif(strpos($url, 'Signature') !== false) {
//             $filename = "signature.zip";
//             $ptype=3;
//         }else{
//             $pdf_name = md5(time()).'.pdf';
//         }
//         $pdf_file = $_SERVER['DOCUMENT_ROOT'].$url;
//         if( file_exists( $pdf_file ) )
//         {
         
//             if($ptype == 2){
//                 header('Content-Type: image/png');
//                 echo file_get_contents($pdf_file);
//             }elseif($ptype == 3){
//                 //echo $filename.'<br> '.$pdf_file; die;
//                 header("Pragma: public");
//                 header("Expires: 0");
//                 header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
//                 header("Cache-Control: public");
//                 header("Content-Description: File Transfer");
//                 header("Content-type: application/octet-stream");
//                 header("Content-Disposition: attachment; filename=\"".$filename."\"");
//                 header("Content-Transfer-Encoding: binary");
//                 header("Content-Length: ".filesize($pdf_file));
//                 ob_end_flush();
//                 @readfile($pdf_file);
                            
//             }else{
//                 header('Content-Type: application/pdf');
//                 echo file_get_contents($pdf_file);
//             }
//             //echo file_get_contents($pdf_file);
//         }else{
//             redirect('My404');
//         }
//       }else{
//         redirect('My404');
//         }
//     }
// }
// }
