<style>
    .continue-btn {
        background-color: #fff;
        border: 1px solid #00c5fb;
        border-radius: 50px;
        color: #00c5fb;
        display: block;
        font-size: 18px;
        font-weight: 600;
        padding: 10px 20px;
        text-align: center;
        width: 40%
    }
</style>
<div style="padding: 5%;">
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="page-title">Rota Group</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:;">Rota</a></li>
                    <li class="breadcrumb-item active">Rota Group</li>
                </ul>
            </div>
            <div class="col-auto float-right ml-auto">
                <a href="#" class="btn add-btn"><i class="fa fa-plus"></i> Add New</a>
            </div>
        </div>
    </div>
<?php
if ($this->session->flashdata('inserted') === true) {

    $type = $this->session->flashdata('type');

    if (!isset($type) && $type == '') {

        $type = "success";
    }
    ?>

    <div class="row">



        <div class="col-lg-12">



            <div class="alert alert-<?php echo $type; ?> alert-dismissible" role="alert">

                <strong><?php echo $this->session->flashdata('tckSuccessMsg'); ?></strong>



                <button type="button" class="close" data-dismiss="alert" aria-label="Close">

                    <span aria-hidden="true">×</span>

                </button>

            </div>

        </div>

    </div>

<?php } else if ($this->session->flashdata('error') === true) {
    ?>

    <div class="row">



        <div class="col-lg-12">



            <div class="alert alert-danger alert-dismissible" role="alert">

                <strong>Something went wrong, try again. <?php echo  $this->session->flashdata('error_msg') ?></strong>



                <button type="button" class="close" data-dismiss="alert" aria-label="Close">

                    <span aria-hidden="true">×</span>

                </button>

            </div>

        </div>

    </div> 

<?php }
?>
    <div class="row">
        <div class="table-responsive">
            <table class="table table-striped custom-table mb-0 datatable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Short Name</th>
                        <th>Created At</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $count = 1;
                    foreach ($dataSet as $row) {
                        ?>
                        <tr>
                            <td><?php echo  $count ?></td>
                            <td><?php echo  $row['name'] ?></td>
                            <td><?php echo  $row['short_name'] ?></td>
                            <td><?php echo  $row['created_at'] ?></td>
                            <td>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#edit_rota_category_<?php echo $row['rota_category_id']?>"><i class="fa fa-pencil m-r-5"></i> Edit</a>

                                <a class="dropdown-item delete_btn" href="#" data-rota_category_id='<?php echo $row['rota_category_id']; ?>'><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                            </td>
                            
                            
                            
                            
                            <div class="modal custom-modal fade" id="edit_rota_category_<?php echo $row['rota_category_id']?>" role="dialog">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">

            <div class="modal-body">

                <div class="form-header">

                    <h3>Edit Rota Group</h3>

                </div>

                <div class="modal-btn delete-action">

                    <div class="row">

                        <div class="col-6">

                            <?php
                            $attributes = array('method' => 'POST', 'id' => "editRotaCategory");

                            echo form_open("_rota/rota_category/addRotaCategory/", $attributes);
                            ?>
                            <input type="hidden" name="rota_category_id" value="<?php echo $row['rota_category_id']?>">

                            <div class="form-group">
                                <label>Rota Group Name</label>
                                <input type="text" name="name" value="<?php echo $row['name']?>" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label>Short Name</label>
                                <input type="text" name="short_name" value="<?php echo $row['short_name']?>" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <input type="submit" name="Update" value="Update" class="btn btn-primary">
                            </div>

                            </form>

                        </div>


                    </div>

                </div>

            </div>

        </div>

    </div>

</div>
                            
                            
                        </tr>
                        <?php
                        $count++;
                    }
                    ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Short Name</th>
                        <th>Created At</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
            </table>

        </div>  
    </div>  
</div>  



<!-- Delete Rota Category Modal -->

<div class="modal custom-modal fade" id="delete_rota_category" role="dialog">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">

            <div class="modal-body">

                <div class="form-header">

                    <h3>Delete Rota Group</h3>

                    <p>Are you sure want to delete? </p>

                </div>

                <div class="modal-btn delete-action">

                    <div class="row">

                        <div class="col-6">

                            <?php
                            $attributes = array('method' => 'POST', 'id' => "deleteRotaCategory");

                            echo form_open("_rota/rota_category/removeRotaCategory/", $attributes);
                            ?>

                            <input type='hidden' id='delete_rota_category_id' name='rota_category_id' value=''/>

                            <a href="javascript:void(0);" class="btn btn-primary continue-btn" id='cnfrmDelete'>Delete</a>

                            </form>

                        </div>

                        <div class="col-6">

                            <a href="javascript:void(0);" data-dismiss="modal" class="btn btn-primary continue-btn" style="float: right;margin-top: -50px;">Cancel</a>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<!-- /Delete Rota Category Modal -->

<!-- /Add Rota Category Modal -->

<div class="modal custom-modal fade" id="add_rota_category" role="dialog">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">

            <div class="modal-body">

                <div class="form-header">

                    <h3>Add Rota Group</h3>

                </div>

                <div class="modal-btn delete-action">

                    <div class="row">

                        <div class="col-6">

                            <?php
                            $attributes = array('method' => 'POST', 'id' => "addRotaCategory");

                            echo form_open("_rota/rota_category/addRotaCategory/", $attributes);
                            ?>

                            <div class="form-group">
                                <label>Rota Group Name</label>
                                <input type="text" name="name" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label>Short Name</label>
                                <input type="text" name="short_name" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <input type="submit" name="Save" value="Save" class="btn btn-primary">
                            </div>

                            </form>

                        </div>


                    </div>

                </div>

            </div>

        </div>

    </div>

</div>


<!-- /Add Rota Category Modal -->