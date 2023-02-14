<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
</div>
<footer class="footer haslayout">
    <p>&copy; <?php echo date('Y'); ?> | All Rights Reserved</p>
</footer>
</div>

</body>

<script src="<?php echo base_url('/assets/js/bootstrap.min.js'); ?>"></script>
<script src="<?php echo base_url('/assets/js/typeahead.jquery.js'); ?>"></script>
<script src="<?php echo base_url('/assets/js/bloodhound.js'); ?>"></script>
<script src="<?php echo base_url('/assets/js/sticky_message.js'); ?>"></script>

<?php
if(!empty($javascripts)){
    foreach ($javascripts as $value) {
        ?>
        <script src="<?php echo base_url();?>assets/<?php echo $value;?>"></script>
        <?php
    }
}
?>

<script>

    $(document).ready(function () {

        /**------------------------------------------------
         * Seacrh Tacking no using barcode scanner.
         -----------------------------------------------*/
        $('input[name=barcode_no]').focus();
        $('input[name=barcode_no]').bind('change', function (e) {
            e.preventDefault();
            var _this = $(this);
            var barcode = _this.val();
            var search_type = 'ura_barcode_no';
            $.ajax({
                url: '<?php echo base_url('/index.php/laboratory/search_barcode_record'); ?>',
                type: 'POST',
                dataType: 'json',
                data: {'barcode': barcode, 'search_type': search_type},
                success: function (response) {
                    if (response.type === 'success') {
                        jQuery.sticky(response.msg, {classList: 'success', speed: 200, autoclose: 7000});
                        _this.parents('.tg-trackrecords').next('.row').find('.load-track-record-data').html(response.encode_data);
                        _this.parents('.specimen_track_search').find('.add_specimen_wrap').html('');
                        $('input[name=barcode_no]').val('');
                        $('input[name=barcode_no]').focus();
                        _this.parents('.specimen_tracking_form').find('.book_in_from_clinic').html(response.encode_status_data_1);
                        _this.parents('.specimen_tracking_form').find('.book_out_to_lab_primary_release').html(response.encode_status_data_2);
                        _this.parents('.specimen_tracking_form').find('.book_out_to_lab_fw_completed').html(response.encode_status_data_3);
                    } else {
                        _this.parents('.tg-trackrecords').next('.row').find('.load-track-record-data').html('');
                        _this.parents('.specimen_tracking_form').find('.book_in_from_clinic').html('');
                        _this.parents('.specimen_tracking_form').find('.book_out_to_lab_primary_release').html('');
                        _this.parents('.specimen_tracking_form').find('.book_out_to_lab_fw_completed').html('');
                        jQuery.sticky(response.msg, {classList: 'important', speed: 200, autoclose: 7000});

                    }
                }
            });
        });

        /**------------------------------------------------
         * Seacrh Tacking no using tracking no ul number scanner.
         -----------------------------------------------*/
        $('input[name=tracking_no_ul]').bind('change', function (e) {
            e.preventDefault();
            var _this = $(this);
            var track_no_ul = _this.val();
            var search_type = 'serial_number';
            $.ajax({
                url: '<?php echo base_url('/index.php/laboratory/search_barcode_record'); ?>',
                type: 'POST',
                dataType: 'json',
                data: {'track_no_ul': track_no_ul, 'search_type': search_type},
                success: function (response) {
                    if (response.type === 'success') {
                        jQuery.sticky(response.msg, {classList: 'success', speed: 200, autoclose: 7000});
                        _this.parents('.tg-trackrecords').next('.row').find('.load-track-record-data').html(response.encode_data);
                        _this.parents('.specimen_track_search').find('.add_specimen_wrap').html('');
                        $('input[name=tracking_no_ul]').val('');
                        $('input[name=tracking_no_ul]').focus();
                        _this.parents('.specimen_tracking_form').find('.book_in_from_clinic').html(response.encode_status_data_1);
                        _this.parents('.specimen_tracking_form').find('.book_out_to_lab_primary_release').html(response.encode_status_data_2);
                        _this.parents('.specimen_tracking_form').find('.book_out_to_lab_fw_completed').html(response.encode_status_data_3);
                    } else {
                        _this.parents('.tg-trackrecords').next('.row').find('.load-track-record-data').html('');
                        _this.parents('.specimen_tracking_form').find('.book_in_from_clinic').html('');
                        _this.parents('.specimen_tracking_form').find('.book_out_to_lab_primary_release').html('');
                        _this.parents('.specimen_tracking_form').find('.book_out_to_lab_fw_completed').html('');
                        jQuery.sticky(response.msg, {classList: 'important', speed: 200, autoclose: 7000});
                    }
                }
            });
        });

        /**------------------------------------------------
         * Seacrh Tacking no using tracking no ul number scanner.
         -----------------------------------------------*/
        $('input[name=tracking_no_lab]').bind('change', function (e) {
            e.preventDefault();
            var _this = $(this);
            var track_no_lab = _this.val();
            var search_type = 'lab_number';
            $.ajax({
                url: '<?php echo base_url('/index.php/laboratory/search_barcode_record'); ?>',
                type: 'POST',
                dataType: 'json',
                data: {'track_no_lab': track_no_lab, 'search_type': search_type},
                success: function (response) {
                    if (response.type === 'success') {
                        jQuery.sticky(response.msg, {classList: 'success', speed: 200, autoclose: 7000});
                        _this.parents('.tg-trackrecords').next('.row').find('.load-track-record-data').html(response.encode_data);
                        _this.parents('.specimen_track_search').find('.add_specimen_wrap').html('');
                        $('input[name=tracking_no_lab]').val('');
                        $('input[name=tracking_no_lab]').focus();
                        _this.parents('.specimen_tracking_form').find('.book_in_from_clinic').html(response.encode_status_data_1);
                        _this.parents('.specimen_tracking_form').find('.book_out_to_lab_primary_release').html(response.encode_status_data_2);
                        _this.parents('.specimen_tracking_form').find('.book_out_to_lab_fw_completed').html(response.encode_status_data_3);
                    } else {
                        _this.parents('.tg-trackrecords').next('.row').find('.load-track-record-data').html('');
                        _this.parents('.specimen_tracking_form').find('.book_in_from_clinic').html('');
                        _this.parents('.specimen_tracking_form').find('.book_out_to_lab_primary_release').html('');
                        _this.parents('.specimen_tracking_form').find('.book_out_to_lab_fw_completed').html('');
                        jQuery.sticky(response.msg, {classList: 'important', speed: 200, autoclose: 7000});
                    }
                }
            });
        });

        /**===========================================
         * Save Book In From Clinic
         ==========================================*/
        $(document).on('click', '.institute_book_in_from_clinic', function (e) {
            e.preventDefault();
            var _this = $(this);
            var record_id = _this.data('recordid');
            var status_key = _this.data('statuskey');
            var barcode_no = _this.data('barcode');
            $.ajax({
                url: '<?php echo base_url('/index.php/laboratory/set_laboratory_record_history_track_status'); ?>',
                type: 'POST',
                dataType: 'json',
                data: {'record_id': record_id, 'track_status_key': status_key, 'barcode_no': barcode_no},
                success: function (response) {
                    if (response.type === 'success') {
                        jQuery.sticky(response.msg, {classList: 'success', speed: 200, autoclose: 7000});
                        _this.parents('.tg-trackrecords').next('.row').find('.load-track-record-data').html(response.record_track_data);
                    } else {
                        jQuery.sticky(response.msg, {classList: 'important', speed: 200, autoclose: 7000});
                        _this.parents('.tg-trackrecords').next('.row').find('.load-track-record-data').html('');
                    }
                }
            });
        });

        /**===========================================
         * Save Book Out To Lab Primary Release
         ==========================================*/
        $(document).on('click', '.institute_book_out_to_lab_primary_release', function (e) {
            e.preventDefault();
            var _this = $(this);
            var record_id = _this.data('recordid');
            var status_key = _this.data('statuskey');
            var barcode_no = _this.data('barcode');
            $.ajax({
                url: '<?php echo base_url('/index.php/laboratory/set_laboratory_record_history_track_status'); ?>',
                type: 'POST',
                dataType: 'json',
                data: {'record_id': record_id, 'track_status_key': status_key, 'barcode_no': barcode_no},
                success: function (response) {
                    if (response.type === 'success') {
                        jQuery.sticky(response.msg, {classList: 'success', speed: 200, autoclose: 7000});
                        _this.parents('.tg-trackrecords').next('.row').find('.load-track-record-data').html(response.record_track_data);
                    } else {
                        jQuery.sticky(response.msg, {classList: 'important', speed: 200, autoclose: 7000});
                        _this.parents('.tg-trackrecords').next('.row').find('.load-track-record-data').html('');
                    }
                }
            });
        });

        /**===========================================
         * Save Book Out To Lab FW Completed
         ==========================================*/
        $(document).on('click', '.institute_book_out_to_lab_fw_completed', function (e) {
            e.preventDefault();
            var _this = $(this);
            var record_id = _this.data('recordid');
            var status_key = _this.data('statuskey');
            var barcode_no = _this.data('barcode');
            $.ajax({
                url: '<?php echo base_url('/index.php/laboratory/set_laboratory_record_history_track_status'); ?>',
                type: 'POST',
                dataType: 'json',
                data: {'record_id': record_id, 'track_status_key': status_key, 'barcode_no': barcode_no},
                success: function (response) {
                    if (response.type === 'success') {
                        jQuery.sticky(response.msg, {classList: 'success', speed: 200, autoclose: 7000});
                        _this.parents('.tg-trackrecords').next('.row').find('.load-track-record-data').html(response.record_track_data);
                    } else {
                        jQuery.sticky(response.msg, {classList: 'important', speed: 200, autoclose: 7000});
                        _this.parents('.tg-trackrecords').next('.row').find('.load-track-record-data').html('');
                    }
                }
            });
        });

        /**=======================================================
        * Send Specimen Error Log and Feedback Private Message
        ======================================================*/
        //Search Record Suggestion Code
        var receipent_suggestions = new Bloodhound({
            datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
            queryTokenizer: Bloodhound.tokenizers.whitespace,
            remote: {
                url: '<?php echo base_url('index.php/laboratory/searchReceipentUsers?query=%QUERY'); ?>',
                wildcard: '%QUERY',
                transform: function (receipent_suggestions) {
                    return $.map(receipent_suggestions, function (items) {
                        return {
                            user_id: items.user_id,
                            username: items.username,
                            first_name: items.first_name,
                            last_name: items.last_name
                        };
                    });
                }
            }
        });
        $('.tg-pm-receipent input.typeahead').typeahead({
            minLength: 2,
            highlight: true
        },
        {
            name: 'user_search',
            source: receipent_suggestions,
            display: function (item) {
                return item.first_name + ' ' + item.last_name;
            },
            limit: 30,
            templates: {
                suggestion: function (item) {
                    return '<div><a href="javascript:;">' + item.first_name + ' ' + item.last_name + '</a></div>';
                },
                notFound: function (query) {
                    return 'No Result Found...';
                },
                pending: function (query) {
                    return '<div>Loading...<i class="fa fa-circle-o-notch fa-spin pull-right" style="font-size:20px;"></i></div>';
                },
            }
        }).on('typeahead:selected', function (event, selection) {
            var _this = $(this);
            _this.typeahead('val', selection.username);
        });

    });
</script>
</html>