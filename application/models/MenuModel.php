<?php
defined('BASEPATH') or exit('No direct script access allowed');
class menuModel extends CI_Model
{

    public function getOne($menuID){
        $this->db->where('menu_id',$menuID);
        $menURES = $this->db->get('group_menu');
        if($menURES->num_rows() > 0){
            return $menURES->result_array()[0];
        }
        return array();
    }
    public function getOneItem($menuID){
        $this->db->where('menu_item_id',$menuID);
        $menURES = $this->db->get('menu_items');
        if($menURES->num_rows() > 0){
            return $menURES->result_array()[0];
        }
        return array();
    }

    public function getGroupList(){
        $this->db->order_by('name','ASC');
        return $this->db->get('groups')->result();
    }
    public function listMenu(){
        $this->db->join('groups','groups.id = group_menu.group_id','left');
        $menURES = $this->db->get('group_menu');
        return $menURES->result();
    }




    public function getOneWithGroup($menuID){
        $this->db->where('menu_id',$menuID);
        $this->db->join('groups','groups.id = group_menu.group_id','left');
        $menURES = $this->db->get('group_menu');
        if($menURES->num_rows() > 0){
            return $menURES->result_array()[0];
        }
        return array();
    }

    public function hasChildren($menuItemID){
        $this->db->where('menu_item_parent_id',$menuItemID);
        $menURES = $this->db->get('menu_items');
        if($menURES->num_rows() >  0){
            return true;
        }else{
            return false;
        }
    }


    public $returnArr = array();
    function get_all_categories($menuID,$parent, $indent = 0){
		$this->db->select([
            "menu_items.item_name",
            "menu_items.item_icon",
            "menu_items.item_link",
            "menu_items.is_active",
            "menu_items.menu_item_id",
            "menu_items.menu_id",
            'm2.item_name as parent_name'
        ]);
		$this->db->where('menu_items.menu_id',$menuID);
        $this->db->where('menu_items.menu_item_parent_id',$parent);

        $this->db->join('menu_items as m2', 'menu_items.menu_item_parent_id = m2.menu_item_id', 'left');

        // $this->db->order_by('menu_item_id',"ASC");
        $sqlResult = $this->db->get('menu_items');
        $num_rows 	= $sqlResult->num_rows();
		if ($num_rows > 0) {
            $lisItemsRES = $sqlResult->result_array();
			foreach($lisItemsRES as $key => $sqlROWS) {
                $returnArr[$key] = $sqlROWS;
                if ($this->hasChildren($sqlROWS['menu_item_id'])) {
                    $returnArr[$key]['sub_menu'] = $this->get_all_categories($menuID,$sqlROWS['menu_item_id'], $indent++);
                }else{
                    $returnArr[$key]['sub_menu'] = array();
                }

            }
        }
        return $returnArr;
    }


    public $frntEndArr = array();
    function getMenuArray($groupID, $lab_id)
	{
	//print $groupID;
        $menuID = $this->getMenuId($groupID);

        $this->db->select([
            "menu_item_id",
            "item_name",
            "item_icon",
            "item_link",
            "is_active",
        ]);
//        echo $menuID;exit;
        if($lab_id == 114){
            $this->db->where('item_name !=', 'Billing');    
        }
        $this->db->where('menu_id',$menuID);
        $this->db->where('menu_item_parent_id',0);
        $this->db->where('is_active',1);
        $sqlResult = $this->db->get('menu_items');
        $num_rows 	= $sqlResult->num_rows();
        if ($num_rows > 0) {
            $menuItems = $sqlResult->result();
            foreach($menuItems  as $menuItem){
                $this->frntEndArr [] = [
                    "id"=> $menuItem->menu_item_id,
                    "name"=> $menuItem->item_name,
                    "link"=> $menuItem->item_link,
                    "icon"=> $menuItem->item_icon,
                    "items"=>($this->hasChildren($menuItem->menu_item_id))?$this->childrenArr($menuItem->menu_item_id):[]
                ];
            }
        }

        return $this->frntEndArr;
    }

    function childrenArr($menuItem){
        $retArr = array();
        $this->db->select([
            "menu_item_id",
            "item_name",
            "item_icon",
            "item_link",
            "is_active",
        ]);
        $this->db->where('menu_item_parent_id',$menuItem);
        $this->db->where('is_active',1);
        $sqlResult = $this->db->get('menu_items');
        $num_rows 	= $sqlResult->num_rows();
        if ($num_rows > 0) {
            $menuItems = $sqlResult->result();
            foreach($menuItems  as $menuItem){
                $retArr[]= [
                    "id"=> $menuItem->menu_item_id,
                    "name"=> $menuItem->item_name,
                    "link"=> $menuItem->item_link,
                    "icon"=> $menuItem->item_icon,
                    "items"=>($this->hasChildren($menuItem->menu_item_id))?$this->childrenArr($menuItem->menu_item_id):[]
                ];
            }
        }
        return  $retArr ;
    }

    public function allowMenuAccess() 
	{
        $group_id = $this->ion_auth->get_users_groups()->row()->id;
        $this->db->select('group_type');
        $this->db->where('id', $group_id);
        $group_type = $this->db->get('groups')->row()->group_type;
        if ($group_type == 'H' || $group_type == 'HA' || $group_type == 'L' || $group_type == 'LA' || $group_type == 'N') 
		{
            $user_id = $this->session->userdata('user_id');
            $is_admin = $this->db->get_where('users', array('id' => $user_id))->result_array()[0]['is_hospital_admin'];
            if (!empty($is_admin)) {
                return TRUE;
            }
        }
        return FALSE;
    }


    public function getMenuId($group_id) 
	{
        $this->db->where('group_id', $group_id);
        $query = $this->db->get('group_menu');
        if ($query->num_rows() > 0) {
            $menuID = $query->row()->menu_id;
            return $menuID;
        }
        // get group type
       $res2 = $this->db->get_where('groups', array('id'=>$group_id))->result();
       
	  
	   	    
		if (empty($res))
        {
		//print LAB_GROUP;
           $group_type = $this->db->get_where('groups', array('id'=>$group_id))->row()->group_type;
            if(in_array("$group_type",HOSPITAL_GROUP))
            {
            $menu_id = $this->db->get_where('group_menu', array('menu_id' => 9))->row()->menu_id;
            return $menu_id; 
			}
           else if(in_array("$group_type",LAB_GROUP))
           {
            $menu_id = $this->db->get_where('group_menu', array('menu_id' => 18))->row()->menu_id;
            return $menu_id;
            }
			else if(in_array("$group_type",PATH_GROUP))
           {
            $menu_id = $this->db->get_where('group_menu', array('menu_id' => 1))->row()->menu_id;
            return $menu_id;
            }
			else if(in_array("$group_type",NETWork_GROUP))
           {
            $menu_id = $this->db->get_where('group_menu', array('menu_id' => 7))->row()->menu_id;
            return $menu_id;
            }

			else
           {
            $menu_id = $this->db->get_where('group_menu', array('group_id' => 0))->row()->menu_id;
            return $menu_id;
            }
        }
      $group_type = $res[0]['group_type'];

		

       $res = $this->db->get_where('group_menu', array('default_menu' =>$group_type))->row()->menu_id;
       // print $res;
        if ($res=='')
        {
            if(in_array(HOSPITAL_GROUP,$group_type))
             {
            $menu_id = $this->db->get_where('group_menu', array('menu_id' => 9))->row()->menu_id;
            return $menu_id; }
            if($group_type == 'L')
             {
            $menu_id = $this->db->get_where('group_menu', array('menu_id' => 18))->row()->menu_id;
            return $menu_id; }
           else
           {
            $menu_id = $this->db->get_where('group_menu', array('group_id' => 0))->row()->menu_id;
            return $menu_id;
            }
        }
        return $res;
    }


    public function confirmEdit() {
        $group_id = $this->ion_auth->get_users_groups()->row()->id;
        $dMenuID = $this->getMenuId($group_id);
        $res = $this->db->get_where("group_menu", array('menu_id' => $dMenuID))->result_array()[0];
        $doCopy = TRUE;
        if (empty($res['default_menu']) && $dMenuID != 0) {
            $doCopy = FALSE;
        }
        if ($doCopy) {
            // Create new menu and copy the default menu items to this menu.
            $group_name = $this->ion_auth->get_users_groups()->row()->description;
            $menu_data = array(
                'menu_name' => $group_name,
                'group_id' => $group_id,
                'is_active' => 1,
                'created_by' => $this->ion_auth->user()->row()->id
            );
            $this->db->insert('group_menu', $menu_data);
            $menuID = $this->db->insert_id();

            // Copying menu item
            // Get menu item tree
            $flat_tree_wid = $this->db->get_where('menu_items', array('menu_id' => $dMenuID))->result_array();
            $flat_tree = array();
            foreach ($flat_tree_wid as $element) {
                $flat_tree[$element['menu_item_id']] = $element;
                $parent_id = 0;
                if ($element['menu_item_parent_id'] != 0) {
                    $parent_id = $flat_tree[$element['menu_item_parent_id']]['new_id'];
                }
                $menu_item_data = array(
                    'menu_id' => $menuID,
                    'menu_item_parent_id' => $parent_id,
                    'item_name' => $element['item_name'],
                    'item_link'=> $element['item_link'],
                    'item_icon' => $element['item_icon'],
                    'is_active' => $element['is_active']
                );
                $this->db->insert('menu_items', $menu_item_data);
                $new_id = $this->db->insert_id();
                $flat_tree[$element['menu_item_id']]['new_id'] = $new_id;
            }

            return $menuID;
        } else {
            return FALSE;
        }
    }

    public function menuBelongsToUser($menuID) {
        $group_id = $this->ion_auth->get_users_groups()->row()->id;
        $group_type = $this->ion_auth->get_users_groups()->row()->group_type;
        $this->db->where('group_id', $group_id);
        $this->db->where('menu_id', $menuID);
        $num_rows = $this->db->get('group_menu')->num_rows();
        if ($num_rows > 0) 
		{
            return TRUE;
        }
        $num_rows = $this->db->get_where('group_menu', array('menu_id' => $menuID, 'default_menu' => $group_type))->num_rows();
        if ($num_rows > 0) {
            return TRUE;
        }

        if ($menuID == '0') {
            return TRUE;
        }
        return FALSE;
    }

    public function isDefault($menuID) {
        if ($this->ion_auth->is_admin()) {
            return FALSE;
        }

        $menu = $this->db->get_where('group_menu', array('menu_id' => $menuID))->result_array()[0];
        if (!empty($menu['default_menu'])) {
            return TRUE;
        }
        if ($menu['group_id'] == 0) {
            return TRUE;
        }
        return FALSE;
    }
}