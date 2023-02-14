<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="row">
    <div class="col-md-12">
        <!--Message For Save Further Work-->
        <?php
        if ($this->session->flashdata('message_further') != '') {
            ?>
            <p class="bg-success" style="padding:7px;"> <?php echo $this->session->flashdata('message_further'); ?></p>
        <?php } ?>
        <?php
        if ($this->session->flashdata('message_additional') != '') {
            ?>
            <p class="bg-success" style="padding:7px;"> <?php echo $this->session->flashdata('message_additional'); ?></p>
        <?php } ?>
        <?php
        if ($this->session->flashdata('final_report_message') != '') {
            echo $this->session->flashdata('final_report_message');
        }
        ?>
        <?php
        if ($this->session->flashdata('record_updated') != '') {
            echo $this->session->flashdata('record_updated');
        }
        ?>
        <!--End Message-->
        <a onclick="window.history.back();"><button class="btn btn-primary"><< Go Back</button></a>
        <br /><br /><div id="advance_search_table">
        <?php
           $attributes = array('class' => '');
            echo form_open("Doctor/search_request", $attributes);
            ?>
                <table class="table table-bordered">
                    <tr class="bg-primary">
                        <th>Emis No</th>
                        <th>NHS No</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Lab No</th>
                    </tr>
                    <tr>
                        <td>
                            <input class="form-control" type="text" id="emis_no" name="emis_no">
                        </td>
                        <td>
                            <input class="form-control" type="text" id="nhs_no" name="nhs_no">
                        </td>
                        <td>
                            <input class="form-control" type="text" id="f_name" name="f_name">
                        </td>
                        <td>
                            <input class="form-control" type="text" id="l_name" name="l_name">
                        </td>
                        <td>
                            <input class="form-control" type="text" id="lab_no" name="lab_no">
                        </td>
                    </tr>

                </table>
                <div>
                    <button type="submit" class="btn btn-warning">Search</button>
                </div> 
            </form>
        </div>
        <p class="pull-right"><a id="doctor_advance_search" href="javascript:void(0);">Advance Search</a></p>
        <div class="clearfix"></div>
        <table id="doctor_record_publish_table" class="table table-striped" cellspacing="0" width="100%">
            <thead>
                <tr class="info">
                    <th>UL No.</th>
                    <th>First name</th>
                    <th>Surname:</th>
                    <th>DOB.</th>
                    <th>PCI No.</th>
                    <th>EMIS No.</th>
                    <th>NHS No.</th>
                    <th>LAB.No.</th>
                    <th>Client</th>
                    <th>Type</th>
                    <th>Request Date:</th>
                    <th>Received by Lab.</th>
                    <th>Authorised:</th>
                    <th>Status</th>
                    <th>&nbsp;</th>
                    <th>Docs</th>
                    <th>Un Publish</th>
                </tr>
            </thead>
            <tfoot>
                <tr class="info">
                    <th>UL No.</th>
                    <th>First name</th>
                    <th>Surname:</th>
                    <th>DOB.</th>
                    <th>PCI No.</th>
                    <th>EMIS No.</th>
                    <th>NHS No.</th>
                    <th>LAB.No.</th>
                    <th>Client</th>
                    <th>Type</th>
                    <th>Request Date:</th>
                    <th>Received by Lab.</th>
                    <th>Authorised:</th>
                    <th>Status</th>
                    <th>&nbsp;</th>
                    <th>Docs</th>
                    <th>Un Publish</th>
                </tr>
            </tfoot>
            <tbody>
                <?php
                foreach ($query as $row) :
                    ?>
                    <?php
                    if ($row->report_status == 1) :
                        echo '<tr class="bg-success">';
                    else :
                        echo '<tr>';
                    endif;
                    ?>

                <td style="font-size:11px;"><?php echo $row->serial_number; ?></td>
                <td><?php echo $row->f_name; ?></td>
                <td><?php echo $row->sur_name; ?></td>
                <td><?php echo $row->dob; ?></td>
                <td><?php echo $row->pci_number; ?></td>
                <td><?php echo $row->emis_number; ?></td>
                <td><?php echo $row->nhs_number; ?></td>
                <td><?php echo $row->lab_number; ?></td>
                <td><a data-toggle="tooltip" data-placement="top" title="<?php echo $this->ion_auth->group($row->hospital_group_id)->row()->description; ?>" href="javascript:void(0);" ><img  src="<?php echo base_url('assets/img/hospital.png'); ?>"></a></td>
                <td><?php echo $row->report_urgency; ?></td>
                <td><?php echo date('M j Y', strtotime($row->request_datetime)); ?></td>
                <td><?php echo $row->date_received_bylab; ?></td>
                <td><?php
                        $publish_date =  $row->publish_datetime;
                        
                        if(!empty($publish_date) && $publish_date != ''){
                            echo date('M j Y', strtotime($publish_date));
                        }
                    ?>
                </td>
                <td>
                    <?php
                    if ($row->specimen_update_status == 1 && $row->specimen_publish_status == 1) :
                        echo '<a data-toggle="tooltip" data-placement="top" title="' . $row->serial_number . ' Record Has Been Published Or Completed." href="' . site_url() . '/doctor/doctor_record_detail/' . $row->uralensis_request_id . '"><img src="' . base_url('assets/img/completed.png') . '"></a>';
                    endif;
                    ?>   
                </td>
                <td>
                    <?php
                    if ($row->supplementary_report_status == 1) :
                        echo '<a data-toggle="tooltip" data-placement="top" title="Supplementary Report Requested For This Record ' . $row->serial_number . '" href="javascript:void(0);"><img src="' . base_url('assets/img/requested.png') . '"></a>';
                    endif;
                    ?>
                </td>
                <td>
                    <?php if ($row->specimen_publish_status == 1) : ?>
                        <a target="_blank" href="<?php echo site_url() . '/doctor/generate_report/' . $row->uralensis_request_id; ?>"><img src="/uralensis/assets/img/pdf.png" title='Pdf View'></a>
                    <?php endif; ?> 
                </td>
                <td>
                    <?php if ($row->specimen_publish_status == 1) : ?>
                        <button class="record_id_unpublish btn btn-link" data-recordserial="<?php echo $row->serial_number; ?>" data-unpublishrecordid="<?php echo site_url() . '/doctor/unpublish_record/' . $row->uralensis_request_id; ?>">
                            Un-Publish
                        </button>
                        <?php
                    else :
                        echo 'Not Published';
                    endif;
                    ?>
                </td>
                </tr>

                <?php
            endforeach;
            ?>
            </tbody>
        </table>
    </div>
</div>

