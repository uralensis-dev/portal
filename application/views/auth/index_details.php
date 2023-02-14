<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="tg-dbsectionspace tg-haslayout">
    <div class="row">
        <div class="col-12 col-sm-12 col-md-12 col-lg-12">
            <?php if (isset($message)) { ?>
                <div class="alert alert-success"><?php echo html_purify($message); ?></div>
            <?php } ?>
            <div class="jf-updatall">
                <i class="ti-announcement"></i>
                <span>To add a new user or group click on “Add New User/Group” button now.</span>
                <a class="btn btn-primary jf-btn pull-right" href="<?php echo base_url('index.php/auth/create_group'); ?>">Add New Group</a>
                <a class="btn btn-primary jf-btn pull-right" href="<?php echo base_url('index.php/auth/create_user'); ?>">Add New User</a>
            </div>
            <div class="tg-dashboardbox">
                <div class="tg-dashboardboxtitle">
                <ul class="tg-categoriestabs hospital_groups_cats">
                    <?php $admin_group_id = getAllUsersGroups('A')[0]['id']; ?>
                    <li><a href='<?php echo base_url('index.php?group_id=' . intval($admin_group_id)); ?>'>Admin&nbsp;<em><?php echo getUsersCountOnGroups($admin_group_id); ?></em></a></li>
                    <?php $doctor_group_id = getAllUsersGroups('D')[0]['id']; ?>
                    <li><a href='<?php echo base_url('index.php?group_id=' . intval($doctor_group_id)); ?>'>Doctor&nbsp;<em><?php echo getUsersCountOnGroups($doctor_group_id); ?></em></a></li>
                    <li class='menu-item-has-children page_item_has_children'>
                        <a href='javascript:;'>Hospitals&nbsp;<em><?php echo getAllHospitalGroup(); ?></em></a>
                        <?php
                        $user_groups = getAllUsersGroups('H');
                        if (!empty($user_groups)) {
                            ?>
                            <ul class='children hospital_groups_sub_menu'>
                                <?php
                                foreach ($user_groups as $ugkey => $ugval) {
                                    ?>
                                    <li><a href='<?php echo base_url('index.php?group_id=' . intval($ugval['id'])); ?>'><?php echo uralensisTruncateText(html_purify($ugval['description']), 25); ?><em><?php echo getUsersCountOnGroups(intval($ugval['id'])); ?></em></a></li>
                                <?php } ?>
                            </ul>
                        <?php } ?>
                    </li>
                    <?php $secretary_group_id = getAllUsersGroups('S')[0]['id']; ?>
                    <li><a href='<?php echo base_url('index.php?group_id=' . intval($secretary_group_id)); ?>'>Secretary&nbsp;<em><?php echo getUsersCountOnGroups($secretary_group_id); ?></em></a></li>
                    <li class='menu-item-has-children page_item_has_children'>
                        <a href='javascript:;'>Laboratories&nbsp;<em><?php echo getAllLaboratoryGroup(); ?></em></a>
                        <?php
                        $user_groups = getAllUsersGroups('L');
                        if (!empty($user_groups)) {
                            ?>
                            <ul class='children hospital_groups_sub_menu'>
                                <?php
                                foreach ($user_groups as $ugkey => $ugval) {
                                    ?>
                                    <li><a href='<?php echo base_url('index.php?group_id=' . intval($ugval['id'])); ?>'><?php echo uralensisTruncateText(html_purify($ugval['description']), 25); ?><em><?php echo getUsersCountOnGroups(intval($ugval['id'])); ?></em></a></li>
                                <?php } ?>
                            </ul>
                        <?php } ?>
                    </li>
                    <?php $clinician_group_id = getAllUsersGroups('C')[0]['id']; ?>
                    <li><a href='<?php echo base_url('index.php?group_id=' . intval($clinician_group_id)); ?>'>Clinician&nbsp;<em><?php echo getUsersCountOnGroups($clinician_group_id); ?></em></a></li>
                </ul>
                </div>
                <div class="tg-editformholder">
                    <table id="admin_users_datatable" class="table">
                        <thead>
                            <tr class="bg-primary">
                                <th>Member Name</th>
                                <th>Email</th>
                                <th>Group</th>
                                <th>Status</th>
                                <th>Mobile No.</th>
                                <th>Last Login</th>
                                <th>Total Logins</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            /**
                             * Check if Query String is Set in URL
                             */
                            $url_user_group_id = '';
                            if (isset($_GET) && !empty($_GET['group_id'])) {
                                $url_user_group_id = $_GET['group_id'];
                            }

                            //var_dump($url_user_group_id);exit;
                            $custom_users = getAllUsers($url_user_group_id);
                           
                            // echo last_query();exit;
                           // echo "<pre>";
                           // print_r($custom_users);
                            if (!empty($custom_users)) {
                                ?>
                                <?php
                                $color_count = 0;
                                foreach ($custom_users as $key => $value) {

                                    $full_name = '';
                                   // $first_name = htmlspecialchars($value->first_name, ENT_QUOTES, 'UTF-8');
                                    $first_name = htmlspecialchars($value->enc_first_name, ENT_QUOTES, 'UTF-8');
                                    $last_name = htmlspecialchars($value->enc_last_name, ENT_QUOTES, 'UTF-8');
                                   // $last_name = htmlspecialchars($value->last_name, ENT_QUOTES, 'UTF-8');

                                    if (!empty($first_name) || !empty($last_name)) {
                                        $full_name = $first_name . ' ' . $last_name;
                                    }
                                   // $user_email = htmlspecialchars($value->email, ENT_QUOTES, 'UTF-8');
                                   $user_email = htmlspecialchars($value->enc_email, ENT_QUOTES, 'UTF-8');


                                    if ($value->active) {
                                        $user_active_status = anchor("auth/deactivate/" . $value->id, lang('index_active_link'));
                                    } else {
                                        $user_active_status = anchor("auth/activate/" . $value->id, lang('index_inactive_link'));
                                    }


                                    //Get Hospital Group ID From User Meta Table
                                    $user_meta_hospiatl_group_id = $this->db->select('surgeon_clinician_hos_group_id')->where('id', $value->id)->get('users')->row_array()['surgeon_clinician_hos_group_id'];
                                    
                                    $hospital_linked_name = '';
                                    if (!empty($user_meta_hospiatl_group_id)) {
                                        $hospital_linked_name = '<i>Linked With: '.$this->ion_auth->group($user_meta_hospiatl_group_id)->row()->description.'</i>';
                                    }
                                    ?>
                                    <tr>
                                        <td class="uralensis_user_content">
                                            <div class="uralensis_user_pic" style="background: <?php echo randomNameInitialsColors(); ?>;">
                                            <?php if (!empty($value->picture_name) && !empty($value->profile_picture_path) && file_exists('uploads/'. $value->picture_name)) { ?>
                                                <img src="<?php echo base_url() .'uploads/'. $value->picture_name; ?>" alt="<?php echo $value->picture_name; ?>">
                                            <?php } else { ?>
                                                <span><?php echo getInitialsFromName(intval($value->id)); ?></span>
                                            <?php } ?>
                                            </div>
                                            <strong>
                                                <?php echo html_purify($full_name); ?>
                                                <br>
                                                <?php echo $hospital_linked_name; ?>
                                            </strong>
                                            
                                        </td>
                                        <td><?php echo html_purify($user_email); ?></td>
                                        <td>
                                            <?php
                                            foreach ($value->groups as $group) {
                                                echo anchor("auth/edit_group/" . intval($group->id), htmlspecialchars(ucwords($group->name), ENT_QUOTES, 'UTF-8'));
                                            }
                                            ?>
                                        </td>
                                        <td><?php echo html_purify('<br>' . $user_active_status); ?></td>
                                        <td><?php echo html_purify($value->enc_phone);//html_purify($value->phone); ?></td>
                                        <td><?php echo date('M d, y - H:i:s', $value->last_login); ?></td>
                                        <td><?php echo getUserLogins(html_purify($value->email), 'logins'); ?></td>
                                        <td><?php echo anchor("auth/edit_user/" . $value->id, '<img width="16px" src="' . base_url('assets/img/edit.png') . '">') . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:;" data-deleteurl="' . base_url('index.php/auth/delete_user/' . intval($value->id)) . '" class="delete_user"><img width="16px" src="' . base_url('assets/img/delete.png') . '"></a>'; ?></td>
                                    </tr>
                                <?php $color_count++;  } ?>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
