<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Doctor Model
 *
 * @package    CI
 * @subpackage Model
 * @author     Uralensis <info@oxbridgemedica.com>
 * @version    1.0.0
 */

Class Api_model extends CI_Model 
{

   
    public function UpdateBasicInfoUserDoctor($firstName,$lastName,$phone,$email,$userid,$profileimage)  //update profil with email userid
    {              
        $query = $this->db->query("UPDATE users SET 
        first_name=AES_ENCRYPT(".$this->db->escape($firstName).", '".DATA_KEY."' ),
        last_name=AES_ENCRYPT(".$this->db->escape($lastName).", '".DATA_KEY."' ),
        phone=AES_ENCRYPT(".$this->db->escape($phone).", '".DATA_KEY."' )
        ,email=AES_ENCRYPT(".$this->db->escape($email).", '".DATA_KEY."' ),
        profile_picture_path = '".$profileimage."'
          WHERE id= ".$this->db->escape($userid));
          return TRUE;
        //return $query->row();
    }
     public function getUserDecryptedDetailsByid($id)  //get User profile details if first_name is not null and last_name is not null
    {
      
        $query = $this->db->query("SELECT profile_picture_path,AES_DECRYPT(phone, '".DATA_KEY."') AS phone,AES_DECRYPT(company, '".DATA_KEY."') AS company,AES_DECRYPT(last_name, '".DATA_KEY."') AS last_name,AES_DECRYPT(first_name, '".DATA_KEY."') AS first_name, AES_DECRYPT(email, '".DATA_KEY."') AS email, id,AES_DECRYPT(username, '".DATA_KEY."') AS username  FROM users
                                WHERE id=".$this->db->escape($id));
                              
        //query->collumn_name
       
        return $query->result_array();
    }
    public function getMetainfoofuser($id)  //get User profile details if first_name is not null and last_name is not null
    {
       
       
        $query = $this->db->query("SELECT meta_key,meta_value FROM usermeta
                                WHERE user_id=".$this->db->escape($id));
        //query->collumn_name
    }

    public function insertSpecimenSlide($specimen_id, $url, $thumbnail, $slide_name) {
        if (empty($specimen_id) || empty($url) || empty($thumbnail) || empty($slide_name)) {
            return false;
        }
        return $this->db->query(
           "INSERT INTO `specimen_slide` (`specimen_id`, `url`, `thumbnail`, `slide_name`)
           VALUE ($specimen_id, '$url', '$thumbnail', '$slide_name')"
       );
       return true;
    }
}
