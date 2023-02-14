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
    .invoice-btn{
        text-align: center !important;
        background-color: #00c5fb;
        border: 1px solid #00c5fb;
        border-radius: 3px !important;
        color: #fff;
        font-weight: 500;
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
            <h3 class="page-title">Bill Report</h3>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url(); ?>">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="<?= base_url('laboratory/billing'); ?>">Billing</a></li>
                <li class="breadcrumb-item active">Bill Report</li>
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
            <input type="hidden" id="clinic_id" value="<?= $clinic_id?>" />
            <?php if($is_invoice_generate) { ?>
                <div class="text-center">
                    <button class="btn invoice-btn" type="button" id="invoice_preview">Generate Invoice</button>
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
                <div id="invoice_preview_html"></div>
            </div>
            <div class="modal-footer">
                <a class="btn add-btn" title="Generate Invoice" href="javascript:void(0);"id="invoice_generate">Continue</a>
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

        var invoicePreviewModal = $(document).find('#preview_invoice_modal');
        var clinicId = $(document).find('#clinic_id').val();

        $("#billTrackData").DataTable({
            "ajax": {
                "url": _base_url + "billing/get_bill_track_data/" + clinicId,
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

        $("body").on("click", "#invoice_preview", function(){
            let billingIdArr = [];
            let clinicId = $(document).find('#clinic_id').val();
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
                        invoicePreviewModal.find('#invoice_preview_html').html(response.html);
                        invoicePreviewModal.modal('show');
                    } else {
                        $.sticky(response.message, {classList: 'important', speed: 200, autoclose: 7000});
                    }
                }
            });
        });

        $("body").on("click", "#invoice_generate", function(){
            let clinicId = $(document).find('#clinic_id').val();
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