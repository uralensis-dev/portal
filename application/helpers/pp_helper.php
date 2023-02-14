<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('pp_limit_characters')) {
    function pp_limit_characters($string, $count) {
        $pieces = str_split($string);
        $string = "";
        if (count($pieces) > $count) {
            for($i = 0; $i < $count; $i++)
                $string = $string . "" . $pieces[$i];
            $string = trim($string);
            $string = $string . "...";
        }
        else {
            for($i = 0; $i < count($pieces); $i++)
                $string = $string . "" . $pieces[$i];
            $string = trim($string);
        }
        return $string;
    }
}

if (!function_exists('pp_limit_words')) {
    function pp_limit_words($string, $count){
        $pieces = explode(" ", $string);
        $string = "";

        for($i = 0; $i < $count; $i++)
            $string = $string . " " . $pieces[$i];

        $string = trim($string);
        if (count($pieces) > $count)
            $string = $string . "...";

        return $string;
    }
}

if (!function_exists('pp_random_string')) {
    function pp_random_string($length = 10, $stringType = "uln") {
        $characters = "";
        if ($stringType == "n")
            $characters = "0123456789";
        else if ($stringType == "un")
            $characters = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        else if ($stringType == "ln")
            $characters = "0123456789abcdefghijklmnopqrstuvwxyz";
        else if ($stringType == "uln")
            $characters = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
        else if ($stringType == "ul")
            $characters = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";

        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }

        return $randomString;
    }
}

if (!function_exists('pp_human_timing')) {
    function pp_human_timing($time){
        $time = time() - $time; // to get the time since that moment

        $tokens = array (
            31536000 => 'year',
            2592000 => 'month',
            604800 => 'week',
            86400 => 'day',
            3600 => 'hour',
            60 => 'minute',
            1 => 'second'
        );

        foreach ($tokens as $unit => $text) {
            if ($time < $unit) {
                continue;
            }
            $numberOfUnits = floor($time / $unit);
            return $numberOfUnits.' '.$text.(($numberOfUnits>1)?'s':'');
        }
    }
}

if (!function_exists('pp_pagination_configuration')) {
    function pp_pagination_configuration($url, $totalRecords){
        $config['base_url'] = base_url() . $url;
        $config['total_rows'] = $totalRecords;
        $config['per_page'] = RECORDS_PER_PAGE;
        $config['use_page_numbers'] = TRUE;
        $config['prefix'] = 'page-';
        $config['next_link'] = '»';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['prev_link'] = '«';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a class="paginate">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['full_tag_open'] = '<ul class="pagination pagination-sm no-margin pull-right">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = 'First';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['last_link'] = 'Last';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';

        return $config;
    }
}

if (!function_exists('pp_random_color')) {
    function pp_random_color() {
        return "#" . str_pad( dechex( mt_rand( 0, 255 ) ), 2, '0', STR_PAD_LEFT) .
        str_pad( dechex( mt_rand( 0, 255 ) ), 2, '0', STR_PAD_LEFT) .
        str_pad( dechex( mt_rand( 0, 255 ) ), 2, '0', STR_PAD_LEFT);
    }
}

if (!function_exists('pp_convert_status')) {
    function pp_convert_status($status, $convertTo = "string") {
        if ($convertTo == "string") {
            switch ($status) {
                case -1:
                    $status = "All";
                    break;
                case 0:
                    $status = "Inactive";
                    break;
                case 1:
                    $status = "Active";
                    break;
                case 2:
                    $status = "Approval Pending";
                    break;
                case 3:
                    $status = "Locked";
                    break;
                case 4:
                    $status = "Deleted";
                    break;
                case 5:
                    $status = "Message Pending";
                    break;
                case 6:
                    $status = "Message Delivered";
                    break;
            }
        }
        else {
            switch ($status) {
                case "all":
                    $status = -1;
                    break;
                case "inactive":
                    $status = 0;
                    break;
                case "active":
                    $status = 1;
                    break;
                case "approvalpending":
                    $status = 2;
                    break;
                case "locked":
                    $status = 3;
                    break;
                case "deleted":
                    $status = 4;
                    break;
                case "messagepending":
                    $status = 5;
                    break;
                case "messagedelivered":
                    $status = 6;
                    break;
            }
        }

        return $status;
    }
}

if (!function_exists('pp_calculate_age')) {
    function pp_calculate_age($birthDate) {
        $from = new DateTime($birthDate);
        $to   = new DateTime('today');

        return $from->diff($to)->y;
    }
}

if (!function_exists('pp_check_dealer_session')) {
    function pp_check_dealer_session($checkingFrom = "other"){
        if ($checkingFrom == "login"){
            if (isset($_SESSION["pp_user_id"]) && $_SESSION["pp_user_id"] != ""){
                redirect("dealer/dashboard");
                exit;
            }
        }
        else if ($checkingFrom == "other"){
            if (!isset($_SESSION["pp_user_id"]) || $_SESSION["pp_user_id"] == "") {
                redirect("dealer/login");
                exit;
            }
        }
    }
}

if (!function_exists('pp_check_admin_session')) {
    function pp_check_admin_session($checkingFrom = "other"){
        if ($checkingFrom == "login"){
            if (isset($_SESSION["pp_admin_user_id"]) && $_SESSION["pp_admin_user_id"] != ""){
                redirect("admin/dashboard");
                exit;
            }
        }
        else if ($checkingFrom == "other"){
            if (!isset($_SESSION["pp_admin_user_id"]) || $_SESSION["pp_admin_user_id"] == "") {
                redirect("admin/login");
                exit;
            }
        }
    }
}

if (!function_exists('pp_generate_menu')) {
    function pp_generate_menu($menuFromDB, $completeMenu, $menuToHighlight="Dashboard"){
        $html = "";
        $headerID = 0;
        $skin_color='';
        if($_SESSION['police_admin_roleID']==5){
            $skin_color='#4b646f';
           
        }else{
            
           $skin_color=' #dd4b39'; 
        }
		
        foreach ($menuFromDB as $menu) {
          
            if ($menu->id == 1) {
                $selected = $menu->title == $menuToHighlight ? "active" : "";
                $html .= "<li class='".$selected."'>
                            <a href='".base_url().$menu->link."'>
                                <i class='fa ".$menu->icon."'></i> <span>".$menu->title."</span></a>
                          </li>
						  ";
            }
            else {
                if ($headerID != $menu->headerID) {
                    $headerID = $menu->headerID;
                    foreach ($completeMenu as $menuItem) {
                        if ($menuItem->id == $headerID) {
                            $headerMenu = $menuItem;
                            break;
                        }
                    }

                    //$headerMenu = $this->adminModel->getMenu($headerID);

                    $html .= "<li class='header ' style='color:".$skin_color."'>".$headerMenu->title."</li>";
                }
                $selected = $menu->title == $menuToHighlight ? "active" : "";
                $html .= "<li class='".$selected."'>
                            <a href='".base_url().$menu->link."'>
                                <i class='fa ".$menu->icon."'></i> <span>".$menu->title."</span></a>
                          </li>";
            }
        }

        return $html;
    }
}
if (!function_exists('pp_generate_menu_dropdown')) {
    function pp_generate_menu_dropdown($menuFromDB, $completeMenu,$status){
        $html = "";
        $headerID = 0;
		$status='Active';
        foreach ($menuFromDB as $menu) {
            if ($menu->id == 1) {
                $html .= "<li>
                            <a href='".base_url().$menu->link."'>
                                <span class='fa ".$menu->icon."'></span> <span class='xn-text'>".$menu->title."</span></a>
                          </li>";
            }
            else {
                if ($headerID != $menu->headerID) {
                    $headerID = $menu->headerID;
                    foreach ($completeMenu as $menuItem) {
                        if ($menuItem->id == $headerID) {
                            $headerMenu = $menuItem;
                            break;
                        }
                    }

                    //$headerMenu = $this->adminModel->getMenu($headerID);

                    $html .= "<li class='xn-title'>".$headerMenu->title."</li>";
                }
                $html .= "<li>
                            <a href='".base_url().$menu->link."'>
                                <span class='fa ".$menu->icon."'></span> <span class='xn-text'>".$menu->title."</span></a>
                          </li>";
            }
        }

        return $html;
    }
}

	function dateDMY($dateString){
		$date = date("d-m-Y", strtotime($dateString));
		
		if($date == '01-01-1970' || empty($date)){
			$date = '00-00-0000';
		}
		return $date;
		//$myDateTime = DateTime::createFromFormat('Y-m-d', $dateString);
		//print_r($myDateTime);
		//$newDateString = $myDateTime->format('d-m-Y');
		//return $newDateString;
	} 

    function getCurrentYear(){
         $CI = & get_instance();
        $currentdate=strtotime(date('d-m-Y',strtotime(now)));
            //$currentdate=strtotime(date('d-m-Y',strtotime('2-10-2019')));
            if ($currentdate>strtotime(date('d-m-Y',strtotime('1-7-2017'))) && $currentdate<strtotime(date('d-m-Y',strtotime('30-6-2018'))))
            {
                $currentyear='1';
            }
            elseif($currentdate>strtotime(date('d-m-Y',strtotime('1-7-2018'))) && $currentdate<strtotime(date('d-m-Y',strtotime('30-6-2019'))))
            {
                $currentyear='2';
            }
            elseif($currentdate>strtotime(date('d-m-Y',strtotime('1-7-2019'))) && $currentdate<strtotime(date('d-m-Y',strtotime('30-6-2020'))))
            {
                $currentyear='2';
            }
            elseif($currentdate>strtotime(date('d-m-Y',strtotime('1-7-2020'))) && $currentdate<strtotime(date('d-m-Y',strtotime('30-6-2021'))))
            {
                $currentyear='4';
            }
            else
            {$currentyear='1';}

            $CI->session->set_flashdata("year", true);
            //$CI->session->set_flashdata("year_id", $currentyear);
            $CI->session->set_userdata('year_id', $currentyear);
            return $currentyear;


    }

    function which_year(){
        $CI = & get_instance();
        $year_id = $CI->session->userdata('year_id');
        $text = '';
        
        if($year_id == 1){
            $text = '2017-18';
        }elseif($year_id == 2){
            $text = '2018-19';
        }elseif($year_id == 3){
            $text = '2019-20';
        }elseif($year_id == 4){
            $text = '2020-21';
        }else{
            $text = '2017-18';
        }

        return $text;
    }