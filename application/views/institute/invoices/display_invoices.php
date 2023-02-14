<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="row">
    <div class="col-md-12">
        <table class="table table-striped" id="doctor_invoice_table">
            <thead>
                <tr>
                    <th>INV No.</th>
                    <th>Doctor</th>
                    <th>Inv From</th>
                    <th>Inv To</th>
                    <th>View</th>
                    <th>Created</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (!empty($invoices_data)) {
                    $inv_count = 0;
                    foreach ($invoices_data as $key => $value) {

                        $doc_id = $value['ura_doc_id'];
                        $timestamp = date('d-m-Y h:i:s', $value['timestamp']);

                        //Unserialize the data
                        $invoice_data = unserialize($value['ura_invoice_data']);
                        ?>
                        <tr>
                            <td><?php echo $value['ura_invoice_no']; ?></td>
                            <td><?php echo uralensis_get_username($doc_id); ?></td>
                            <td><?php echo $value['ura_doc_date_from']; ?></td>
                            <td><?php echo $value['ura_doc_date_to']; ?></td>
                            <td>
                                <a href="javascript:;" data-toggle="modal" data-target="#invoice_modal_<?php echo $inv_count; ?>"><img src="<?php echo base_url('assets/img/view.png'); ?>"></a>
                                <div id="invoice_modal_<?php echo $inv_count; ?>" class="modal fade" role="dialog">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title">Invoice Costing</h4>
                                            </div>
                                            <div class="modal-body">
                                                <?php if (!empty($invoice_data)) { ?>
                                                    <table class="table table-bordered">
                                                        <tr class="bg-primary">
                                                            <th>Alopecia</th>
                                                            <th>IMF</th>
                                                            <th>Routine</th>
                                                            <th>Total Cost</th>
                                                            <th>Hospital</th>
                                                            <th>Status</th>
                                                            <th>TAT</th>
                                                        </tr>
                                                        <?php
                                                        foreach ($invoice_data as $key => $value) {
                                                            foreach ($value as $tat => $tat_data) {
                                                                $tat_text = 'FALSE';
                                                                if($tat_data['tat_value'] === 'ture'){
                                                                    $tat_text = 'TRUE';
                                                                }
                                                                ?>
                                                                <tr>
                                                                    <th><?php echo $tat_data['alopecia_cases']; ?></th>
                                                                    <th><?php echo $tat_data['imf_cases']; ?></th>
                                                                    <th><?php echo $tat_data['routine_cases']; ?></th>
                                                                    <th><?php echo $tat_data['total_cases_cost']; ?></th>
                                                                    <th><?php echo $tat_data['hospital_name']; ?></th>
                                                                    <th><?php echo ucfirst($tat_data['inv_status']); ?></th>
                                                                    <th><?php echo $tat_text; ?></th>
                                                                </tr>
                                                                <?php
                                                            }
                                                        }
                                                        ?>

                                                    </table>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td><?php echo $timestamp; ?></td>
                        </tr>
                        <?php
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
</div>