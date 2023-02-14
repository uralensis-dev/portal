<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Laboratory Controller
 *
 * @package    CI
 * @subpackage Controller
 * @author     Uralensis <info@oxbridgemedica.com>
 * @version    1.0.0
 */

class User_Permissions extends CI_Controller 
{

    /**
     * Constructor to load models and helpers
     */
    public function __construct() 
    {
        parent::__construct();
        $this->load->model('Permissions_model');
    }
    
    
}
