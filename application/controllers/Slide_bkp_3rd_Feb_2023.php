<?php
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
defined('BASEPATH') or exit('No direct script access allowed');
/**
 * Slide Label Controller
 *
 * @package    CI
 * @subpackage Controller
 * @author     Uralensis <info@oxbridgemedica.com>
 * @version    1.0.0
 */
class Slide extends CI_Controller
{
    /**
     * Constructor to load models and helpers
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Slide_model', 'sl');
        $this->load->helper(array('url'));
    }
    public function AddSlides($fileName = '', $fileId = '')
    {
        $response['status'] = "fail";
        $response['message'] = "Something went wrong. Please try again!!!";

        if ($fileName == '') {
            $response['message'] = "Please provide the filename.";
            echo json_encode(($response));
            exit;
        }
        if ($fileId == '') {
            $response['message'] = "Please provide the auto Id.";
            echo json_encode(($response));
            exit;
        }
        if (!strpos(urldecode($fileName), '.mrnx')) { 
            $response['message'] = "Something went wrong. Please check the filename.";
            echo json_encode(($response));
            exit;
        }
        // Check the filename has a valid values or not
        $imageInfo = explode("_", urldecode($fileName));
        $slideExist = $this->sl->checkSlideExist(urldecode($fileName));
        if($slideExist != ''){
            $response['message'] = "Image already exist!";
            echo json_encode(($response));
            exit;
        }
        if ($imageInfo && count($imageInfo) > 0) {
            $labNumber  = $imageInfo[0];
            //Get the request id based on lab number
            $requestId = $this->sl->getRequestId($labNumber);
            if ($requestId == '') {
                $response['message'] = "Invalid lab number.";
                echo json_encode(($response));
                exit;
            } else {
                $requestedSpecimenNo = (int) filter_var($imageInfo[1], FILTER_SANITIZE_NUMBER_INT);
                if ($requestedSpecimenNo == 0) {
                    $response['message'] = "Invalid block no.";
                    echo json_encode(($response));
                    exit;
                } else {
                    $specimen_data = $this->sl->getSpecimens($requestId);
                    if ($specimen_data == '') {
                        $response['message'] = "Specimen does not exist for the given lab number!!!";
                        echo json_encode(($response));
                        exit;
                    } else {
                        
                        $testName = explode(".", $imageInfo[2]);
                        $blocksInfo = $this->sl->getSpecimensBlocks($specimen_data, $imageInfo[1], $testName[0]);
                        // echo $this->db->last_query();
                        // exit;
					    if (!$blocksInfo) {
                            $response['message'] = "No specimen found with the given block no!!!";
                            echo json_encode(($response));
                            exit;
                        } else {
                            $blockSlides['specimen_id'] = $blocksInfo->specimen_id;
                            $blockSlides['url'] = "https://slides.pathhub.uk/slide/".$fileId."/";
                            $blockSlides['thumbnail'] = "https://slides.pathhub.uk/slide/".$fileId."/fullthumbnail";
                            $blockSlides['block_id'] = $blocksInfo->id;
                            $blockSlides['slide_name'] = urldecode($fileName);
                            if ($this->db->insert('specimen_slide', $blockSlides)) {
                                $response['status'] = "success";
                                $response['message'] = "Slide has been added successfully!!!";
                                echo json_encode(($response));
                                exit;
                            } else {
                                echo json_encode(($response));
                                exit;
                            }
                        }
                    }
                }
            }
        } else {
            $response['message'] = "Please send the parameters in URL encode format!!!";
            echo json_encode(($response));
            exit;
        }
    }
}
