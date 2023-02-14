<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Admin Controller
 *
 * @package    CI
 * @subpackage Controller
 * @author     Uralensis <info@oxbridgemedica.com>
 * @version    1.0.0
 */
class Menu extends CI_Controller
{
    /**
     * Constructor to load models and helpers
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Ion_auth_model');
        $this->load->model('menuModel');
        $this->load->helper(array('form', 'url', 'file', 'activity_helper','menu_helper', 'dashboard_functions_helper', 'ec_helper'));
                                    if (!$this->ion_auth->logged_in()) {
                                        redirect('auth/login', 'refresh');
                                    }
        track_user_activity(); //Track user activity function which logs user track actions.
        
    }

    public function index() {
        redirect('/menu/list', 'refresh');
    }

    public function list(){
        // Check if current user is admin
        if (!$this->ion_auth->is_admin()) {
            // Check if current user is hospital user lab user or network admin
            if ($this->menuModel->allowMenuAccess()) 
			{
               $group_id = $this->ion_auth->get_users_groups()->row()->id;
			   
                $menuID = $this->menuModel->getMenuId($group_id);
                redirect('/menu/itemList/'.$menuID, 'refresh');
            }
            else {
                redirect('/', 'refresh');
            }
        }
        $data['menuList'] = $this->menuModel->listMenu();
        
        $this->load->view('templates/header-new');
        $this->load->view('menu-controller/menu-list', $data);
        $this->load->view('templates/footer-new');
    }


    public function confirmEdit() {
        $data = array('url' => '');
        if (!$this->menuModel->allowMenuAccess()) {
            $data['url'] = base_url().'menu';
        }
        $menuID = $this->menuModel->confirmEdit();
        if ($menuID !== FALSE) {
            redirect('/menu/itemList/'.$menuID, 'refresh');
        }else{
            redirect('/menu', 'refresh');
        }
    }
    
    public function show($menuID = ''){
        $data['editMode'] = FALSE;
        if($menuID !=''){
            $data['menuData'] = $this->menuModel->getOne($menuID);
            $data['editMode'] = TRUE;
        }
        else{
            $data['menuData'] = array();
            
        }
        $data['groupList'] = $this->menuModel->getGroupList();
        $this->load->view('templates/header-new');
        $this->load->view('menu-controller/menu-form', $data);
        $this->load->view('templates/footer-new');
    }
    public function edit($menuID){
        $data['editMode'] = FALSE;
        if($menuID !=''){
            $data['menuData'] = $this->menuModel->getOne($menuID);
            $data['editMode'] = TRUE;
        }
        else{
            $data['menuData'] = array();
            
        }
        $data['groupList'] = $this->menuModel->getGroupList();
        $this->load->view('templates/header-new');
        $this->load->view('menu-controller/menu-form', $data);
        $this->load->view('templates/footer-new');
    }

    public function save($menuID=''){
        $menuName = $this->input->post('menu_name');
        $group_id = $this->input->post('group_id');
        $current_UrserID = $this->ion_auth->user()->row()->id;
        if($menuID != '' ){
            if($menuID != '' || is_numeric($menuID) || $menuID != 0){
                $this->db->set(
                    array(
                        "menu_name"=>$menuName,
                        "group_id"=> $group_id,
                        "modified_by"=>$current_UrserID,
                        "modified_on"=>date('Y-m-d H:i:s')
                    )

                );
                $this->db->where('menu_id',$menuID);
                $this->db->update('group_menu');
                $this->session->set_flashdata('showMessage',true);
                $this->session->set_flashdata('type','success');
                $this->session->set_flashdata('message','Group Menu Updated.');
    
                redirect('/menu/list', 'refresh');
            }else{
                $this->session->set_flashdata('showMessage',true);
                $this->session->set_flashdata('type','error');
                $this->session->set_flashdata('message','Invalid Data, Please Try Again.');
                redirect('/menu/list', 'refresh');
            }
        }else{
            $insData = array(
                "menu_name"=>$menuName,
                "group_id"=> $group_id,
                "created_by"=>$current_UrserID,
                "created_on"=>date('Y-m-d H:i:s')
            );
            $this->db->insert('group_menu',$insData);
            $this->session->set_flashdata('showMessage',true);
            $this->session->set_flashdata('type','success');
            $this->session->set_flashdata('message','Group Menu Created.');
            redirect('/menu/list', 'refresh');
        }

    }
    public function deactivate($menuID){
        if($menuID == '' || !is_numeric($menuID) || $menuID == 0){
            $this->session->set_flashdata('showMessage',true);
            $this->session->set_flashdata('type','error');
            $this->session->set_flashdata('message','Invalid Data, Please Try Again.');

            redirect('/menu/list', 'refresh');
        }

        $this->db->where('menu_id',$menuID);
        $this->db->set('is_active','0');
        $this->db->update('group_menu');

        $this->session->set_flashdata('showMessage',true);
        $this->session->set_flashdata('type','success');
        $this->session->set_flashdata('message','Menu Status Updated.');

        redirect('/menu/list', 'refresh');

    }
    public function activate($menuID){
        if($menuID == '' || !is_numeric($menuID) || $menuID == 0){
            $this->session->set_flashdata('showMessage',true);
            $this->session->set_flashdata('type','error');
            $this->session->set_flashdata('message','Invalid Data, Please Try Again.');

            redirect('/menu/list', 'refresh');
        }

        $this->db->where('menu_id',$menuID);
        $this->db->set('is_active','1');
        $this->db->update('group_menu');

        $this->session->set_flashdata('showMessage',true);
        $this->session->set_flashdata('type','success');
        $this->session->set_flashdata('message','Menu Status Updated.');

        redirect('/menu/list', 'refresh');

    }
    public function delete($menuID){
        if (!$this->ion_auth->is_admin()) {
            // Check if menu belongs to the user
            if (!$this->menuModel->menuBelongsToUser($menuID)) {
                redirect('/', 'refresh');
            } 
        }
        $current_UrserID = $this->ion_auth->user()->row()->id;
        $is_admin = $this->ion_auth->is_admin($current_UrserID);
        
        //REMOVE MENU ITEMS
        $this->db->where('menu_item_id',$menuID);
        $this->db->delete('menu_items');
        
        //REMOVE MENU
        $this->db->where('menu_id',$menuID);
        $this->db->delete('group_menu');

        $this->session->set_flashdata('showMessage',true);
        $this->session->set_flashdata('type','success');
        $this->session->set_flashdata('message','Menu Removed');

        redirect('/menu/list', 'refresh');

    }

    public function itemList($menuID){
        if (!$this->ion_auth->is_admin()) {
            // Check if menu belongs to the user
            if (!$this->menuModel->menuBelongsToUser($menuID)) {
                redirect('/', 'refresh');
            } 
        }
        
        $data['menuData'] = $this->menuModel->getOneWithGroup($menuID);
        $data['menuItemsLIst'] = $this->menuModel->get_all_categories($menuID,0);
        $data['menuID'] = $menuID;
        $using_default_menu = $this->menuModel->isDefault($menuID);
        $data['isDefault'] = $using_default_menu;
        if ($using_default_menu) {
            custom_log('Default menu loaded');
        } else {
            custom_log('Main menu loaded');
        }
        $f_data['javascripts'] = array('js/menu/itemList.js');
        $this->load->view('templates/header-new');
        $this->load->view('menu-controller/menu-item-list', $data);
        $this->load->view('templates/footer-new', $f_data);
    }


    public function itemCreate($menuID,$parentID='0',$itemID = ''){
        if (!$this->ion_auth->is_admin()) {
            // Check if menu belongs to the user
            if (!$this->menuModel->menuBelongsToUser($menuID)) {
                redirect('/', 'refresh');
            } 
        }
        $data['editMode'] = FALSE;
        if($itemID !=''){
            $data['itemData'] = $this->menuModel->getOneItem($itemID);
            $data['editMode'] = TRUE;
        }
        else{
            $data['itemData'] = array();
            
        }


        $this->db->where('is_active',1);
        $itemsList = $this->db->where('menu_id',$menuID)->get('menu_items')->result();
        $data['itemsList'] = $itemsList;
        $data['menuID'] = $menuID;
        $data['itemID'] = $itemID;
        if($parentID!='0'){
            $this->db->where('menu_item_id',$parentID);
            $this->db->where('is_active',1);
            $parentRES = $this->db->get('menu_items')->result_array()[0];
            $data['parentData'] = $parentRES;
        }
        $data['parentID'] = $parentID;
        $data['menuData'] = $this->menuModel->getOneWithGroup($menuID);
        $this->load->view('templates/header-new');
        $this->load->view('menu-controller/menu-item-form', $data);
        $this->load->view('templates/footer-new');
    }

    public function saveMenuItem($menuID ,$itemID =''){
        if (!$this->ion_auth->is_admin()) {
            // Check if menu belongs to the user
            if (!$this->menuModel->menuBelongsToUser($menuID)) {
                redirect('/', 'refresh');
            } 
        }
        $menuID = $menuID;
        $item_name = $this->input->post('item_name');
        $item_link = $this->input->post('item_link');
        $item_icon = $this->input->post('item_icon');
        $menu_item_parent_id = $this->input->post('menu_item_parent_id');
        $current_UrserID = $this->ion_auth->user()->row()->id;

        if($itemID != '' ){
            if($itemID != '' || is_numeric($itemID) || $itemID != 0){
                $this->db->set(
                    array(
                    'menu_id'=>$menuID,
                    'menu_item_parent_id'=>$menu_item_parent_id,
                    'item_name'=>$item_name,
                    'item_link'=>$item_link,
                    'item_icon'=>$item_icon
                    )
                );
                $this->db->where('menu_item_id',$itemID);
                $this->db->update('menu_items');
                $this->session->set_flashdata('showMessage',true);
                $this->session->set_flashdata('type','success');
                $this->session->set_flashdata('message','Menu Item Updated.');
                redirect('menu/itemList/'.$menuID, 'refresh');
            }
        }else{
            $insData = array(
                'menu_id'=>$menuID,
                'menu_item_parent_id'=>$menu_item_parent_id,
                'item_name'=>$item_name,
                'item_link'=>$item_link,
                'item_icon'=>$item_icon
            );
            $this->db->insert('menu_items',$insData);
            $this->session->set_flashdata('showMessage',true);
            $this->session->set_flashdata('type','success');
            $this->session->set_flashdata('message','Menu Item Added.');
            redirect('menu/itemList/'.$menuID, 'refresh');
        }
        
    }
    public function deactivateItem($menuID,$itemId){
        if (!$this->ion_auth->is_admin()) {
            // Check if menu belongs to the user
            if (!$this->menuModel->menuBelongsToUser($menuID)) {
                redirect('/', 'refresh');
            } 
        }
        if($itemId == '' || !is_numeric($itemId) || $itemId == 0){
            $this->session->set_flashdata('showMessage',true);
            $this->session->set_flashdata('type','error');
            $this->session->set_flashdata('message','Invalid Data, Please Try Again.');

            redirect('menu/itemList/'.$menuID, 'refresh');
        }

        $this->db->where('menu_item_id',$itemId);
        $this->db->set('is_active','0');
        $this->db->update('menu_items');

        $this->session->set_flashdata('showMessage',true);
        $this->session->set_flashdata('type','success');
        $this->session->set_flashdata('message','Menu Item Status Updated.');

        redirect('menu/itemList/'.$menuID, 'refresh');

    }
    public function activateItem($menuID,$itemId){
        if (!$this->ion_auth->is_admin()) {
            // Check if menu belongs to the user
            if (!$this->menuModel->menuBelongsToUser($menuID)) {
                redirect('/', 'refresh');
            } 
        }
        if($itemId == '' || !is_numeric($itemId) || $itemId == 0){
            $this->session->set_flashdata('showMessage',true);
            $this->session->set_flashdata('type','error');
            $this->session->set_flashdata('message','Invalid Data, Please Try Again.');

            redirect('menu/itemList/'.$menuID, 'refresh');
        }

        $this->db->where('menu_item_id',$itemId);
        $this->db->set('is_active','1');
        $this->db->update('menu_items');

        $this->session->set_flashdata('showMessage',true);
        $this->session->set_flashdata('type','success');
        $this->session->set_flashdata('message','Menu Item Status Updated.');

        redirect('menu/itemList/'.$menuID, 'refresh');

    }
    public function deleteItem($menuID,$itemId){
        if (!$this->ion_auth->is_admin()) {
            // Check if menu belongs to the user
            if (!$this->menuModel->menuBelongsToUser($menuID)) 
			{
                redirect('/', 'refresh');
            } 
        }
        //REMOVE MENU ITEMS
        $this->db->where('menu_item_parent_id',$itemId);
        $this->db->delete('menu_items');
        //REMOVE MENU
        $this->db->where('menu_item_id',$itemId);
        $this->db->delete('menu_items');

        $this->session->set_flashdata('showMessage',true);
        $this->session->set_flashdata('type','success');
        $this->session->set_flashdata('message','Menu Item Removed');

        redirect('menu/itemList/'.$menuID, 'refresh');

    }
}