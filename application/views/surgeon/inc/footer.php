<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
</div>
<footer class="footer haslayout">
    <p>&copy; <?php echo date('Y'); ?> | All Rights Reserved</p>
</footer>
</div>

</body>

<script src="<?php echo base_url('/assets/js/bootstrap.min.js'); ?>"></script>
<script src="<?php echo base_url('/assets/js/sticky_message.js'); ?>"></script>
<script src="<?php echo base_url('/assets/js/jquery.dataTables.min.js'); ?>"></script>
<script src="<?php echo base_url('/assets/js/dataTables.bootstrap.min.js'); ?>"></script>

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
        $('#sec_doc_records').DataTable({
            ordering: false,
            stateSave: true,
            "processing": true,
            "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]]
        });
    });
</script>
</html>