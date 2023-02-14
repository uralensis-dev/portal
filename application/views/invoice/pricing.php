<style type="text/css">
    .cancel-btnn{border: 1px solid #ccc;
    padding: 5px 10px;
    border-radius: 3px;
    font-size: 14px;
    color: #333;}
    .cancel-btnn:hover{
        border: 1px solid #00c5fb;
        background-color: #00c5fb;
        color: #fff;
    }
    #upload_csv{
        margin-bottom: 40px;`
        padding-left: 0;
        display:none;
    }
    .csv_div{
        border: 1px solid lightgrey;
        padding: 25px!important;
        border-radius: 5px;
    }
    .add-btn{
        font-size: 14px;
        min-width: auto;
    }
    .error_list {
        margin: 15px 0px;
        background-color: red;
        color: white;
        padding: 10px;
        border-radius: 5px;
    }
    .success_list {
        margin: 15px 0px;
        background-color: lightgreen;
        color: white;
        padding: 10px;
        border-radius: 5px;
    }
</style>

<div class="page-header">
    <div class="row align-items-center">
        <div class="col">
            <h3 class="page-title">Billing</h3>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Dashboard</a></li>
                <li class="breadcrumb-item active">Billing</li>
            </ul>
        </div>
        <div class="col-auto float-right ml-auto" style="padding-right: 0;">
            <a href="<?php echo base_url('laboratory/add_billing'); ?>" class="btn add-btn"><i class="fa fa-plus"></i>Add</a>
        </div>
        <!-- <div class="col-auto float-right ml-auto">
            <a href="javascript:void(0);" class="btn add-btn mr-2" id="show_upload_div"><i class="fa fa-upload"></i> Upload CSV</a> &nbsp;
        </div>
        <div class="col-auto float-right ml-auto" style="padding-left: 0;">
            <a href="<?php echo base_url('billing/bill_track'); ?>" class="btn add-btn"><i class="fa fa-gears"></i></a>
        </div> -->
    </div>
</div>

<div class="notification">
    <?php if ($this->session->flashdata('error') != '') { ?>
        <div class="error_list">
            <?= $this->session->flashdata('error'); ?>
        </div>
    <?php } ?>
    <?php if ($this->session->flashdata('success') != '') { ?>
        <div class="success_list">
            <?= $this->session->flashdata('success'); ?>
        </div>
    <?php } ?>
</div>

<div class="row">
    <div class="col-sm-12" id="upload_csv">
        <form method="POST" action="<?= base_url('billing/addBillingDataFromCsv'); ?>" enctype="multipart/form-data" name="impForm" id="ImpForm">
            <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
            <div class="modal-body csv_div">
                <div class="row" style="margin-bottom:-15px;">
                    <div class="col-sm-2 col-md-2 text-right">
                        <strong>Select CSV File:</strong>
                    </div>
                    <div class="col-sm-3 col-md-3">
                        <div class="form-group">
                            <!--<label class="col-form-label">Select CSV File</label>-->
                            <input type="file" name="UploadCSV" id="UploadCSV">
                        </div>
                    </div>
                    <div class="col-sm-3 col-md-3" style="text-align: center;">
                        <div class="form-group">
                            <a href="<?= base_url('uploads/Billing.csv'); ?>"><i class="fa fa-download"></i> Download Sample File</a>
                        </div>
                    </div>
                    <div class="col-sm-3 col-md-3">
                        <div class="form-group">
                            <button class="btn btn-info btn- btn-rounded btn-sm submit">Submit</button>
                        </div>
                    </div>
                    <div class="col-sm-1 col-md-1 text-right">
                        <i class="fa fa-close hide_upload_div"></i>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="col-md-12">
        <table class="table table-striped no-footer" id="billingData" style="width: 100%;">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Clinic</th>
                    <th>Bill Code</th>
                    <th>Description</th>
                    <th>Specimen Type</th>
                    <th>Category</th>
                    <th>Tissue Type</th>
                    <th>Price</th>
                    <th class="text-right">Action</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>
</div>

<div class="modal custom-modal fade" id="delete_billing_modal" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="form-header">
                    <h3>Delete Billing</h3>
                    <p>Are you sure want to delete?</p>
                </div>
                <div class="modal-btn delete-action">
                    <div class="row">
                        <div class="col-6">
                            <a href="javascript:void(0);" class="btn btn-primary continue-btn billing-delete-btn">Delete</a>
                        </div>
                        <div class="col-6">
                            <a href="javascript:void(0);" data-dismiss="modal" class="btn btn-primary cancel-btn">Cancel</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        setTimeout(function (){
            $('.notification').hide(9000);
        }, 5000);

        $(".hide_upload_div").click(function () {
            $("#upload_csv").hide(1000);
        });

        $("#hide_upload_div").click(function () {
            $("#upload_csv").hide(1000);
        });

        $("#show_upload_div").click(function () {
            $("#upload_csv").show(1000);
        });

        $("#billingData").on("draw.dt", function () {
            $(this).find(".dataTables_empty").parents('tbody').empty();
            $('div.dataTables_processing').hide();
        });
        
        $("#billingData").DataTable({
            "ajax": {
                "url": _base_url + "laboratory/get_billing_data",
                "dataSrc": 'data'
            },
            "processing": true,
            "autoWidth": true,
            "ordering": true,
            "columns": [
                {data: 'count'},
                {data: 'clinic'},
                {data: 'code'},
                {data: 'description'},
                {data: 'specimen_type'},
                {data: 'category'},
                {data: 'tissue_type'},
                {data: 'price'},
                {data: 'id', render: function (data, type, row, meta) {
                        return '<div class="dropdown dropdown-action text-right">\n' +
                            '<a href="javascript:void(0);" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>\n' +
                            '<div class="dropdown-menu dropdown-menu-rig">\n' +
                            `<a class="dropdown-item" href="${_base_url}laboratory/edit_billing/${data}"><i class="fa fa-pencil m-r-5"></i> Edit</a>\n` +
                            `<a class="dropdown-item" href="javascript:delete_billing(\'${_base_url}laboratory/delete_billing/${data}\')"><i class="fa fa-trash-o m-r-5"></i> Delete</a>\n` +
                            '</div>\n' +
                            '</div>';
                    }
                }
            ],
        });
    });

    function delete_billing(url){
        $('#delete_billing_modal').modal('show');
        $('.billing-delete-btn').attr('href', url);
    }
</script>