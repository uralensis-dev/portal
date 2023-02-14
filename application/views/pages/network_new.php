<h1>New Network Form</h1>

<form action="<?php echo base_url('admin/new_network')?>" method="post">
    <p>Network Name</p>
    <input type="text" name="network_name" value="<?php echo isset($form_data) ? $form_data['network_name']: ""; ?>">
    <p style="color: red; <?php echo isset($form_error)? "": "display: none;" ?>"><?php echo isset($form_error)? $form_error['network_name']: ''; ?></p>
    <button>Submit</button>
</form>