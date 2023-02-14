<style type="text/css">
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
<!-- Page Header -->
<div class="page-header">
    <div class="row align-items-center">
        <div class="col">
            <h3 class="page-title">Bill Track</h3>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url(); ?>">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="<?= base_url('laboratory/billing'); ?>">Billing</a></li>
                <li class="breadcrumb-item active">Bill Track</li>
            </ul>
        </div>
        <!--<div class="col-auto float-right ml-auto">
            <a href="javascript:void(0);" class="btn add-btn mr-2" id="show_upload_div"><i class="fa fa-upload"></i> Upload CSV</a> &nbsp;
        </div>-->
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
        <form method="POST" action="<?= base_url('billing/addBillTrackDataFromCsv'); ?>" enctype="multipart/form-data" name="impForm" id="ImpForm">
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
                            <a href="<?= base_url('uploads/BillTrack.csv'); ?>"><i class="fa fa-download"></i> Download Sample File</a>
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
        <div class="table-responsive">
            <table class="table table-striped no-footer" style="width: 100%;">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Clinic Name</th>
                    <th>Total Price</th>
                    <th class="text-right">Action</th>
                </tr>
                </thead>
                <tbody>
                <?php if(count($result) > 0) { $cnt=0; foreach ($result as $row) { $cnt++; ?>
                    <tr>
                        <td><?= $cnt; ?></td>
                        <td><?= $row['clinic']; ?></td>
                        <td><?= $row['price']; ?></td>
                        <td class="text-right">
                        <a class="dropdown-item bill_track_view" href="javascript:void(0);" data-clinic-id="<?= $row['id']; ?>" data-clinic-name="<?= $row['clinic']; ?>"><i class="fa fa-eye m-r-5"></i> View
                            <div class="dropdown dropdown-action show hide">
                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="true"><i class="material-icons">more_vert</i></a>
                                <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end" style="position: absolute; transform: translate3d(-40px, 31px, 0px); top: 0px; left: 0px; will-change: transform;">
                                    <a class="dropdown-item bill_track_view" href="javascript:void(0);" data-clinic-id="<?= $row['id']; ?>" data-clinic-name="<?= $row['clinic']; ?>"><i class="fa fa-eye m-r-5"></i> View
                                </div>
                            </div>
                        </td>
                    </tr>
                <?php } } else { ?>
                    <tr><td colspan="4" class="text-center">No record found</td></tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div id="track_detail_modal" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Bill track for clinic (<span class="title_span"></span>)</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-striped no-footer" id="billTrackData" style="width: 100%;">
                    <thead>
                    <tr>
                        <th><input type="checkbox" name="bill_track[]" class="checkAll" /></th>
                        <th>Lab ID</th>
                        <th>Request ID</th>
                        <th>Specimen</th>
                        <th>Price</th>
                        <th>Request Date</th>
                        <th>Lab Entry Date</th>
                        <th>Specimen Type</th>
<!--                        <th class="text-right">Action</th>-->
                    </tr>
                    </thead>
                    <tbody>
                    <tr><td colspan="10" class="text-center">No record found</td></tr>
                    </tbody>
                </table>
                <div id="invoice_preview"></div>
            </div>
            <?php if($is_invoice_generate) { ?>
                <div class="modal-footer">
                    <button class="btn add-btn" type="button" id="invoice_generate">Generate Invoice</button>
                </div>
            <?php } ?>
        </div>
    </div>
</div>

<div id="preview_invoice_modal" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Preview Invoice</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="invoice_preview"></div>
            </div>
            <div class="modal-footer">
                <button class="btn add-btn" id="back_to_list">Back</button>
                <a class="btn add-btn" href="javascript:void(0);" id="invoice_url">Continue</a>
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

        var detailModal = $(document).find('#track_detail_modal');
        var invoicePreviewModal = $(document).find('#preview_invoice_modal');

        $("body").on("click", ".bill_track_view", function (){

            let clinic_id = $(this).attr('data-clinic-id');
            let clinic_name = $(this).attr('data-clinic-name');
            detailModal.modal('show');
            detailModal.find('#invoice_generate').attr('data-clinic-id', clinic_id);
            detailModal.find('.title_span').text(clinic_name);

            if ($.fn.DataTable.isDataTable("#billTrackData")) {
                $('#billTrackData').DataTable().clear().destroy();
            }

            $("#billTrackData").DataTable({
                "ajax": {
                    "url": _base_url + "billing/get_single_bill_track_data/" + clinic_id,
                    "dataSrc": 'data'
                },
                "processing": true,
                "autoWidth": true,
                "ordering": true,
                "columns": [
                    {
                        data: 'count',
                        render: function (data, type, row, meta) {
                            if(row.invoice_path){
                                return '<a target="_blank" href="'+ _base_url + row.invoice_path +'"><i class="fa fa-file-pdf-o"></i></a>'
                            }else{
                                return '<input type="checkbox" name="bill_track[]" value="'+ row.id +'" class="checkSingle" />'
                            }
                        }
                    },
                    {data: 'lab_number'},
                    {data: 'pci_number'},
                    {data: 'specimen'},
                    {data: 'bill_price'},
                    {data: 'request_date'},
                    {data: 'created_at'},
                    {data: 'bill_code'}
                ],
            });
        });

        $("body").on("click", "#invoice_generate", function(){
            let billingIdArr = [];
            let clinicId = $(this).attr('data-clinic-id');
            if($(".checkSingle:checked").length <= 0){
                $.sticky('Please select record', {classList: 'important', speed: 200, autoclose: 7000});
                return false;
            }else{
                $(".checkSingle:checked").each(function(){
                    billingIdArr.push($(this).val());
                });
            }
            $.ajax({
                type: "POST",
                url: _base_url + "billing/preview_pdf",
                data: { 'clinic_id': clinicId, 'billing_id_arr': billingIdArr, [csrf_name]: csrf_hash },
                dataType: "json",
                success: function (response) {
                    if (response.status === 'success') {
                        //location.reload();
                        detailModal.modal('hide');
                        setTimeout(function (){
                            invoicePreviewModal.find('#invoice_preview').html(response.html);
                            invoicePreviewModal.find('#invoice_url').attr("data-clinic-id",clinicId);
                            //invoicePreviewModal.find('#invoice_url').prop("href",response.url);
                            invoicePreviewModal.modal('show');
                        },500);
                    } else {
                        $.sticky(response.message, {classList: 'important', speed: 200, autoclose: 7000});
                    }
                }
            });
        });

        $("body").on("click", "#invoice_url", function(){
            let clinicId = $(this).attr('data-clinic-id');
            let invoiceNumber = $(document).find('#invoice_number').text();
            let quantity = $(document).find('#quantity').val();
            let totalAmount = $(document).find('#total_amount').val();
            let billingIdArr = [];
            $(".checkSingle:checked").each(function(){
                billingIdArr.push($(this).val());
            });
            $.ajax({
                type: "POST",
                url: _base_url + "billing/generate_pdf",
                data: { 'clinic_id': clinicId, 'invoice_number': invoiceNumber, 'quantity': quantity, 'total_amount': totalAmount, 'billing_id_arr': billingIdArr, [csrf_name]: csrf_hash },
                dataType: "json",
                success: function (response) {
                    if (response.status === 'success') {
                        invoicePreviewModal.modal('hide');
                        $.sticky(response.message, {classList: 'success', speed: 200, autoclose: 7000});
                    } else {
                        $.sticky(response.message, {classList: 'important', speed: 200, autoclose: 7000});
                    }
                }
            });
        });

        $("body").on("click", "#back_to_list", function(){
            invoicePreviewModal.modal('hide');
            setTimeout(function (){
                detailModal.modal('show');
            },500);
        });

        $("body").on("change", ".checkAll", function(){
            if($(this).prop("checked")) {
                $(".checkSingle").prop("checked", true);
            } else {
                $(".checkSingle").prop("checked", false);
            }
        });

        $("body").on("change", ".checkSingle", function(){
            if($(".checkSingle").length == $(".checkSingle:checked").length) {
                $(".checkAll").prop("checked", true);
            }else {
                $(".checkAll").prop("checked", false);
            }
        });
    });
</script>