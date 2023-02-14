<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function get_categories($level, $id) {
    $ci = &get_instance();
    $userID = $ci->ion_auth->user()->row()->id;
    $isAdmin = $ci->ion_auth->is_admin();
    $ci->db->select('tbl_teaching_cpc_category.parent_id');
    $ci->db->select('tbl_teaching_cpc_category.level1_id');
    $ci->db->select('tbl_teaching_cpc_category.level2_id');
    $ci->db->select('tbl_teaching_cpc_category.level3_id');
    $ci->db->select('tbl_teaching_cpc_category.type');
    $ci->db->from('tbl_teaching_cpc_category');
    if ($level == 0) {
        $ci->db->select('uralensis_teach_mdt_cats.ura_tech_mdt_cat as cat_title');
        $ci->db->join('uralensis_teach_mdt_cats', 'uralensis_teach_mdt_cats.ura_tec_mdt_id=tbl_teaching_cpc_category.parent_id');
        $ci->db->where('tbl_teaching_cpc_category.parent_id>', 0);
//    $ci->db->group_by('tbl_teaching_cpc_category.parent_id');
    }
    if ($level == 1 && $id != '') {
        $ci->db->select('uralensis_teach_mdt_cats.ura_tech_mdt_cat as cat_title1');
        $ci->db->join('uralensis_teach_mdt_cats', 'uralensis_teach_mdt_cats.ura_tec_mdt_id=tbl_teaching_cpc_category.level1_id');
        $ci->db->where('tbl_teaching_cpc_category.level1_id', $id);
        $ci->db->group_by('tbl_teaching_cpc_category.level1_id');
    }
    if ($level == 2 && $id != '') {
        $ci->db->select('uralensis_teach_mdt_cats.ura_tech_mdt_cat as cat_title2');
        $ci->db->join('uralensis_teach_mdt_cats', 'uralensis_teach_mdt_cats.ura_tec_mdt_id=tbl_teaching_cpc_category.level2_id');
        $ci->db->where('tbl_teaching_cpc_category.level2_id', $id);
        $ci->db->group_by('tbl_teaching_cpc_category.level2_id');
    }
    if ($level == 3 && $id != '') {
        $ci->db->select('uralensis_teach_mdt_cats.ura_tech_mdt_cat as cat_title3');
        $ci->db->join('uralensis_teach_mdt_cats', 'uralensis_teach_mdt_cats.ura_tec_mdt_id=tbl_teaching_cpc_category.level3_id');
        $ci->db->where('tbl_teaching_cpc_category.level3_id', $id);
        $ci->db->group_by('tbl_teaching_cpc_category.level3_id');
    }
    $res = $ci->db->get();
    if ($res->num_rows() > 0) {
        return $res->result_array();
    } else {
        return array();
    }
}
?>
<style>
    .alert-success {
        color: #155724 !important;
        background-color: #d4edda !important;
        border-color: #c3e6cb !important;
        margin-left: 0px !important; 
    }
    .mdt_teach_cpc_list_wrapper i {
        color: red;float: right;
    }
    .mdt_teach_cpc_list_wrapper a.primary {
        color: blue;float: right;
        padding-right: 5px;
    }
</style>
<div class="row">
    <div class="col-md-12">

        <!-- Page Header -->
        <div class="page-header">
            <div class="row">
                <div class="col-sm-12">
                    <!--<h3 class="page-title">Add Tech MDT CATS</h3>-->
                </div>
            </div>
        </div>
        <!-- /Page Header -->


        <div class="row">
            <div class="col-md-12">
                <p class="lead text-center">ADD Teaching and CPC Categories</p>
                <hr>
                <div class="row">
                    <div class="col-md-4">
                        <h3>Add Category</h3>
                        <hr>
                        <div class="parent_cat_msg"></div>
                        <?php
                        $attributes = array('id' => 'teach_and_mdt_cats');
                        echo form_open("", $attributes);
                        ?>
                        <!--<form id="teach_and_mdt_cats">-->

                        <!--                <div class="form-group">
                                            <label>Select hospital <span class="text-danger">*</span></label>
                                            <select name="hospital_id" class="form-control tg-select display_mdt_list_on_hospital">
                                                <option value="">Choose Hospital</option>
                        <?php
//                        if (!empty($hospitals_list)) {
//                            foreach ($hospitals_list as $hospitals) {
//                                echo '<option value="' . $hospitals->id . '">' . $hospitals->description . '</option> ';
//                            }
//                        }
                        ?>
                                            </select>						
                                        </div>-->
                        <div class="form-group">
                            <label for="tech_mdt_cats">Add New Category</label>
                            <input placeholder="Enter Category Name" class="form-control" type="text" name="tech_mdt_cats" id="tech_mdt_cats"  required>
                        </div>
                        <div class="form-group">
                            <input type="hidden" name="add_tech_mdt_parent" value="add_tech_mdt_parent">
                            <button name="add_tech_mdt_parent" value="add_tech_mdt_parent" class="btn btn-primary" type="button" id="add_tech_mdt_parent">Save Category</button>
                        </div>
                        </form>
                    </div>
                    <div class="col-md-4">
                        <h3>Add Categories Level</h3>
                        <hr>
                        <div class="child_cat_msg"></div>
                        <?php
                        $attributes = array('id' => 'teach_and_mdt_cats_child');
                        echo form_open("", $attributes);
                        ?>
                        <!-- <form id="teach_and_mdt_cats_child">-->
                        <div class="form-group">
                            <label for="tech_mdt_cats_type">Choose Category Type</label>
                            <select class="form-control" id="tech_mdt_cats_type" name="tech_mdt_cats_type" required>
                                <option value="0">Select The Type</option>
                                <option value="teaching">Teaching</option>
                                <option value="cpc">CPC</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="tech_mdt_parent_cat">Parent Category</label>
                            <select id="tech_mdt_parent_cat" name="tech_mdt_parent_cat" class="form-control" required>
                                <option value="0">Select Parent Category</option>
                                <?php
                                if (!empty($list_cats)) {
                                    foreach ($list_cats as $parent_cats) {
                                        ?>
                                        <option value="<?php echo $parent_cats->ura_tec_mdt_id; ?>"><?php echo $parent_cats->ura_tech_mdt_cat; ?></option>
                                        <?php
                                    }//endforeach
                                }// endif
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="tech_mdt_cats_child_name">Child Level 1</label>
                            <!--<input placeholder="Enter Child Category Name" class="form-control" type="text" name="tech_mdt_cats_child_name" id="tech_mdt_cats_child_name" >-->
                            <select id="tech_mdt_cats_child_name" name="tech_mdt_cats_child_name" class="form-control" required>
                                <option value="0">Select Level#1 Child Category</option>
                                <?php
                                if (!empty($list_cats)) {
                                    foreach ($list_cats as $parent_cats) {
                                        ?>
                                        <option value="<?php echo $parent_cats->ura_tec_mdt_id; ?>"><?php echo $parent_cats->ura_tech_mdt_cat; ?></option>
                                        <?php
                                    }//endforeach
                                }// endif
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="tech_mdt_cats_child_name">Child Level 2</label>
<!--                            <input placeholder="Enter Child Category Name" class="form-control" type="text" name="tech_mdt_cats_child_name_2" id="tech_mdt_cats_child_name_2" >-->
                            <select id="tech_mdt_cats_child_name_2" name="tech_mdt_cats_child_name_2" class="form-control" required>
                                <option value="0">Select Level#2 Child Category</option>
                                <?php
                                if (!empty($list_cats)) {
                                    foreach ($list_cats as $parent_cats) {
                                        ?>
                                        <option value="<?php echo $parent_cats->ura_tec_mdt_id; ?>"><?php echo $parent_cats->ura_tech_mdt_cat; ?></option>
                                        <?php
                                    }//endforeach
                                }// endif
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="tech_mdt_cats_child_name">Child Level 3</label>
                            <!--<input placeholder="Enter Child Category Name" class="form-control" type="text" name="tech_mdt_cats_child_name_3" id="tech_mdt_cats_child_name_3" >-->
                            <select id="tech_mdt_cats_child_name_3" name="tech_mdt_cats_child_name_3" class="form-control">
                                <option value="0">Select Level#3 Child Category</option>
                                <?php
                                if (!empty($list_cats)) {
                                    foreach ($list_cats as $parent_cats) {
                                        ?>
                                        <option value="<?php echo $parent_cats->ura_tec_mdt_id; ?>"><?php echo $parent_cats->ura_tech_mdt_cat; ?></option>
                                        <?php
                                    }//endforeach
                                }// endif
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="hidden" name="add_tech_mdt_child" id="add_tech_mdt_child" value="add_tech_mdt_child">
                            <button class="btn btn-primary" type="button" id="add_tech_mdt_child">Save</button>
                        </div>
                        </form>
                    </div>
                    <div class="col-md-4">
                        <h3>Categories Tree View</h3>
                        <div class="mdt_teach_cpc_list_wrapper">
                            <span class="mdt_del_msg"></span>
                            <ul id="mdt_teach_cpc_list" class="list-group" style="max-height:400px;overflow: scroll;overflow-x: hidden; background: white">
                                <?php
//                                                                echo "<pre>"; print_r(get_categories(0, ''));
                                foreach (get_categories(0, '') as $gc) {
                                    echo '<li class="list-group-item" style="border:none" id="mdt_teach_cpc_id_' . $row['parent_id'] . '">';
                                    ?>
                                    <h4>
                                        <i class='fa fa-trash delete_mdt_tec_cpc danger' data-mdtcpcteach='<?php echo $gc['parent_id']?>' > </i> 
                                        <?php echo $gc['cat_title']?>
                                        <a href="#" class="fa fa-pencil primary" onclick="return updateForm(<?php echo $gc['parent_id']?>,'<?php echo $gc['cat_title']?>')" > </a>
                                    </h4>
                                    <?php
                                    echo "<ul class='list-group' style='padding-left:20px;'>";
                                    foreach (get_categories(1, $gc['level1_id']) as $gc1) {
                                        echo "<li class='list-group-item'><i class='fa fa-trash delete_mdt_tec_cpc danger' data-mdtcpcteach='" . $gc['level1_id'] . "' > </i> " . $gc1['cat_title1'];
                                        ?>
                                <a href="#" class="fa fa-pencil primary" onclick="return updateForm(<?php echo $gc['level1_id']?>,'<?php echo $gc1['cat_title1']?>')" > </a> </li>
                                <?php
                                    }
                                    echo "</ul><ul class='list-group' style='padding-left:40px'>";
                                    foreach (get_categories(2, $gc['level2_id']) as $gc2) {
                                        echo "<li class='list-group-item'><i class='fa fa-trash delete_mdt_tec_cpc danger' data-mdtcpcteach='" . $gc['level2_id'] . "' > </i> " . $gc2['cat_title2'];
                                        ?>
                                <a href="#" class="fa fa-pencil primary" onclick="return updateForm(<?php echo $gc['level2_id']?>,'<?php echo $gc2['cat_title2']?>')" > </a> </li>
                                <?php
                                    }

                                    echo "</ul><ul class='list-group' style='padding-left:60px'>";
                                    foreach (get_categories(3, $gc['level3_id']) as $gc3) {
                                        echo "<li class='list-group-item'><i class='fa fa-trash delete_mdt_tec_cpc danger' data-mdtcpcteach='" . $gc['level3_id'] . "' > </i> " . $gc3['cat_title3'];
                                        ?>
                                <a href="#" class="fa fa-pencil primary" onclick="return updateForm(<?php echo $gc['level3_id']?>,'<?php echo $gc3['cat_title3']?>')" > </a> </li>
                                <?php
                                    }
                                    echo "</ul>";
                                    echo '<li>';
                                }
                                ?>
                            </ul>
                        </div>
                        <br><br>
                        <p style="color:red;"><small>*Delete will delete all the connecting (Parent/Child) categories.</small></p>
                        <p style="color:blue;"><small>*Update will delete all the connecting (Parent/Child) categories.</small></p>
                    </div>
                </div>
            </div>
        </div>
    </div>




</div>

<!-- Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
                        <?php
                        $attributes = array('id' => 'teach_and_mdt_cats_edit');
                        echo form_open("", $attributes);
                        ?>
                <div class="modal-body">
                    <div class="form-group">
                        <div class="parent_cat_msg_edit"></div>
                        <label for="tech_mdt_cats">Category Name</label>
                        <input type="hidden" name="ura_tec_mdt_id" id="ura_tec_mdt_id">
                        <input placeholder="Enter Category Name" class="form-control" type="text" name="ura_tech_mdt_cat_edit" id="ura_tech_mdt_cat_edit"  required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <input type="hidden" name="edit_tech_mdt_parent" value="edit_tech_mdt_parent">
                            <button name="edit_tech_mdt_parent" value="edit_tech_mdt_parent" class="btn btn-warning" type="button" id="edit_tech_mdt_parent">Update Category</button>

                </div>
            </form>
        </div>
    </div>



</div>