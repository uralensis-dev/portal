<style type="text/css">
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
            <h3 class="page-title">Invoice List</h3>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url(); ?>">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="<?= base_url('laboratory/billing'); ?>">Billing</a></li>
                <li class="breadcrumb-item active">Invoice List</li>
            </ul>
        </div>
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
    <div class="col-md-12">
        <div class="table-responsive">
            <table class="table table-striped no-footer" id="invoiceData" style="width: 100%;">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Invoice Number</th>
                    <th>Clinic</th>
                    <th>Quantity</th>
                    <th>Amount(£)</th>
                    <th>Status</th>
                    <th>Generated Date</th>
                    <th>Due Date</th>
                    <th class="text-right">Action</th>
                </tr>
                </thead>
                <tbody>
                    <tr><td colspan="10" class="text-center">No record found</td></tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal custom-modal fade" id="delete_invoice_modal" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="form-header">
                    <h3>Delete Invoice</h3>
                    <p>Are you sure want to delete?</p>
                </div>
                <div class="modal-btn delete-action">
                    <div class="row">
                        <div class="col-6">
                            <a href="javascript:void(0);" class="btn btn-primary continue-btn invoice-delete-btn">Delete</a>
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

        $("#invoiceData").DataTable({
            "ajax": {
                "url": _base_url + "billing/get_invoice_track_data",
                "dataSrc": 'data'
            },
            "processing": true,
            "autoWidth": true,
            "ordering": true,
            "columns": [
                {data: 'count'},
                {data: 'invoice_number'},
                {data: 'clinic'},
                {data: 'quantity'},
                {data: 'amount'},
                {
                    data: 'status',
                    render: function (data, type, row, meta) {
                        let status = '<?= ($is_change_status) ? 'enable': 'disabled'; ?>';
                        return '<select class="form-control update_status" data-id="'+ row.id +'" '+ status +'>' +
                                    '<option value="Invoiced" '+ (data == 'Invoiced' ? 'selected' : '') +'>Invoiced</option>' +
                                    '<option value="Paid" '+ (data == 'Paid' ? 'selected' : '') +'>Paid</option>' +
                                    '<option value="Processing" '+ (data == 'Processing' ? 'selected' : '') +'>Processing</option>' +
                                    '<option value="Unpaid" '+ (data == 'Unpaid' ? 'selected' : '') +'>Unpaid</option>' +
                                '</select>';
                    }
                },
                {
                    data: 'invoice_date'
                },
                {
                    data: 'invoice_due_date'
                },
                {
                    data: 'id',
                    render: function (data, type, row, meta) {
                        let delete_action_html = '';
                        if(row.is_delete){
                            delete_action_html += `<a class="dropdown-item delete_invoice" href="javascript:void(0)" data-url="${row.delete_url}"><i class="fa fa-trash-o m-r-5"></i> Delete</a>\n`;
                        }
                        return '<div class="dropdown dropdown-action text-right">\n' +
                                    '<a href="javascript:void(0);" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>\n' +
                                    '<div class="dropdown-menu dropdown-menu-rig">\n' +
                                        `<a class="dropdown-item" href="${row.file_path}" target="_blank"><i class="fa fa-download m-r-5"></i> Download</a>\n` +
                                        `<a class="dropdown-item print_invoice" href="javascript:void(0)" data-url="${row.file_path}"><i class="fa fa-print m-r-5"></i> Print</a>\n` +
                                        delete_action_html +
                                    '</div>\n' +
                                '</div>';
                    }
                }
            ],
        });

        $(document).on('click', '.print_invoice', function (){
            let print_url = $(this).attr('data-url');
            let newWin= window.open(print_url);
            //newWin.document.write(print_url);
            newWin.print();
            //newWin.close();
        });

        $(document).on('click', '.delete_invoice', function (){
            let delete_url = $(this).attr('data-url');
            $('#delete_invoice_modal').modal('show');
            $(document).find('.invoice-delete-btn').attr('href', delete_url);
        });

        $(document).on('change', '.update_status', function (){
            let invoice_id = $(this).attr('data-id');
            let status = $(this).val();
            $.ajax({
                type: "POST",
                url: _base_url + '/billing/update_invoice_status',
                data: { 'invoice_id': invoice_id, 'status': status, [csrf_name]: csrf_hash },
                dataType: "json",
                success: function (response) {
                    if (response.status === 'success') {
                        $('#password_info').modal('hide');
                        $.sticky(response.message, {classList: 'success', speed: 200, autoclose: 7000});
                    } else {
                        $.sticky(response.message, {classList: 'important', speed: 200, autoclose: 7000});
                    }
                }
            });
        });

    });
</script>