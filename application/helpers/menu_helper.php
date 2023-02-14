<?php
defined('BASEPATH') OR exit('No direct script access allowed');


if (!function_exists('admin_men_lister')) {
    function admin_men_lister($itemArr, $show_option){
        if(!empty($itemArr)){
            $counter = 1;
            foreach($itemArr as $submenu):
                echo "<tr>
    ";
    echo "
    <td> </td>";
    echo "
    <td>".$submenu['item_name']."</td>";
    echo "
    <td>".$submenu['parent_name']."</td>";
    echo "
    <td>".$submenu['item_icon']."</td>";
    echo "
    <td>".$submenu['item_link']."</td>";
    echo '
    <td class="text-right">
        ';
        if ($show_option):
        echo '        <div class="dropdown action-label">
            ';
            echo '            <a class="btn btn-white btn-sm btn-rounded dropdown-toggle" href="#" data-toggle="dropdown" aria-expanded="false">
                ';
                if($submenu['is_active'] == 1):
                echo '                <i class="fa fa-dot-circle-o text-success"></i> Active';
                else:
                echo '                    <i class="fa fa-dot-circle-o text-danger"></i> Inactive';
                endif;
                echo '
            </a>';
            echo '            <div class="dropdown-menu">
                ';
                if($submenu['is_active'] == 1):
                echo '                    <a class="dropdown-item" href="'.site_url('menu/deactivateItem/'.$submenu['menu_id'].'/'.$submenu['menu_item_id']).'"><i class="fa fa-dot-circle-o text-danger"></i> Deactivate</a>';
                else:
                echo '                    <a class="dropdown-item" href="'.site_url('menu/activateItem/'.$submenu['menu_id'].'/'.$submenu['menu_item_id']).'"><i class="fa fa-dot-circle-o text-success"></i> Activate</a>';
                endif;
                echo '
            </div>';
            echo '
        </div>';
        endif;
        echo '
    </td>';
    echo '
    <td class="text-right">
        ';
        if ($show_option):
        echo '        <div class="dropdown dropdown-action">
            ';
            echo '            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>';
            echo '            <div class="dropdown-menu dropdown-menu-right">
                ';
                echo '                <a class="dropdown-item" href="'.site_url('menu/itemCreate/'.$submenu['menu_id']." /".$submenu['menu_item_id']).'"><i class="fa fa-plus m-r-5"></i> Add Sub Item</a>';
                echo '                <a class="dropdown-item" href="'.site_url('menu/itemCreate/'.$submenu['menu_id']." /0/".$submenu['menu_item_id']).'"><i class="fa fa-pencil m-r-5"></i> Edit Item</a>';
                echo '                <a class="dropdown-item" href="'.site_url('menu/deleteItem/'.$submenu['menu_id'].'/'.$submenu['menu_item_id']).'"><i class="fa fa-trash-o m-r-5"></i> Delete</a>';
                echo '
            </div>';
            echo '
        </div>';
        endif;
        echo '
    </td>';
    echo '
</tr>';
                if(!empty($submenu['sub_menu'])):
                    echo "<tr><td colspan='7'></td></tr>";
                    admin_men_lister($submenu['sub_menu'], $show_option);
                endif;
            endforeach;
        }
    }

}
if (!function_exists('genMenu')) {
    function genMenu()
{
        $ci = & get_instance();
        $ci->load->database();

        $userID = $ci->ion_auth->user()->row()->id;
        $ci->db->select(['user_id','group_id']);
        $ci->db->where('user_id',$userID);
        $grpRES = $ci->db->get('users_groups');
		
        if($grpRES->num_rows() > 0)
		{
            $grpROW = $grpRES->row();
            $groupID = $grpROW->group_id;
        }
		else
		{
            $groupID=0;
        }
        $ci->load->model('menuModel');
        $lab_id = $ci->ion_auth->get_users_main_groups()->row()->id;        
        $menuArr  = $ci->menuModel->getMenuArray($groupID, $lab_id);
        if(!empty($menuArr))
        {
            $data['menuArr'] = $menuArr;
            echo $ci->load->view('menu-controller/frnt-end-menu', $data,true);
        }
else
{
            echo "No Menu Available for this Group";
        }
    }
}

if (!function_exists('p')) {
    function p($data_arr, $die = true){
        echo '<pre>';
        print_r($data_arr);
        echo '<pre>';
        if($die) {
            exit;
        }
    }
}
?>