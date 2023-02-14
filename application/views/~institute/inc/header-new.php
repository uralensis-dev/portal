<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
	<title>Dashboard</title>

	<!-- Favicon -->
	<link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url() ?>/assets/img/favicon.png">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="<?php echo base_url() ?>/assets/institute/css/bootstrap.min.css">


	<link rel="stylesheet" href="<?php echo base_url() ?>/assets/institute/css/bootstrap-select.min.css">


	<!-- Fontawesome CSS -->
	<link rel="stylesheet" href="<?php echo base_url() ?>/assets/institute/css/font-awesome.min.css">

	<!-- Lineawesome CSS -->
	<link rel="stylesheet" href="<?php echo base_url() ?>/assets/institute/css/line-awesome.min.css">

	<!-- Chart CSS -->
	<link rel="stylesheet" href="<?php echo base_url() ?>/assets/institute/plugins/morris/morris.css">

	<!-- Main CSS -->
	<link rel="stylesheet" href="<?php echo base_url() ?>/assets/institute/css/style.css">

	<!-- Main Custom CSS -->
	<link rel="stylesheet" href="<?php echo base_url() ?>/assets/institute/css/custom-styles.css">
	<link rel="stylesheet" href="<?php echo base_url() ?>/assets/institute/css/components.css">


	<link rel="stylesheet" href="<?php echo base_url() ?>/assets/institute/css/smart_wizard.min.css">
	<!-- Select2 CSS -->
	<link rel="stylesheet" href="<?php echo base_url() ?>/assets/institute/css/select2.min.css">

	<!-- Datetimepicker CSS -->
	<link rel="stylesheet" href="<?php echo base_url() ?>/assets/institute/css/bootstrap-datetimepicker.min.css">
	<link rel="stylesheet" href="<?php echo base_url() ?>/assets/institute/css/filepond.css">
	<link rel="stylesheet" href="<?php echo base_url() ?>/assets/institute/css/smart_wizard.min.css">

    <?php
    if (!empty($styles)) {
        foreach ($styles as $value) {
            ?>
            <link type="text/css" rel="stylesheet" href="<?php echo site_url(); ?>assets/<?php echo $value; ?>"/>
            <?php
        }
    }
    ?>
	
	<!-- Main CSS -->

	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
			<script src="assets/js/html5shiv.min.js"></script>
			<script src="assets/js/respond.min.js"></script>
		<![endif]-->
</head>

<body>
	<!-- Main Wrapper -->
	<div class="main-wrapper">

		<!-- Header -->
		<div class="header patient-menu">
			<div class="container-fluid">

				<!-- Logo -->
				<div class="header-left">
					<a class="logo" href="/">
						<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 332.4 69.1">
							<title>Memorial Sloan Kettering Cancer Center</title>
							<path fill="#fff" d="M75.5 29.4c2.1-.4 2.5-.9 2.5-3.2v-9.4c0-.9-.4-1.3-2.5-1.4v-1h5.7l4.4 12.1h.2l4.4-12.1h5.7v1c-2 .1-2.5.3-2.5 1v11.7c0 .7.5 1 2.5 1v1h-7.1v-1c1.9-.1 2.1-.2 2.1-1V16.4h-.2l-5.2 13.9h-1l-5.2-13.9h-.2v9.8c0 2.2.2 2.8 2.3 3.2v.9h-6.1v-.9zm23.4-4.7c0 2.5 1.2 4.5 3.6 4.5 1.4 0 2.5-.8 3.4-2l.6.6c-.9 1.5-2.3 2.8-4.7 2.8-3.4 0-5.2-2.4-5.2-5.6 0-3.3 2.1-5.8 5.2-5.8 3.4 0 4.7 2.8 4.5 5.5h-7.4zm5.1-1.1c.1-2-.7-3.6-2.4-3.6-1.5 0-2.5 1-2.7 3.7l5.1-.1zm18.2-4.5c1.7 0 2.7 1.2 2.7 3.4v6c0 .6.4.8 1.8.8v1h-5.3v-1c1.2 0 1.4-.3 1.4-.8v-5.1c0-2-.7-2.6-2.1-2.6-.8 0-1.7.4-2.6 1.1v6.5c0 .6.2.8 1.6.8v1h-5.2v-1c1.2 0 1.4-.3 1.4-.8v-5.1c0-2-.8-2.6-2.2-2.6-1.1 0-1.8.5-2.5.9v6.8c0 .6.2.8 1.4.8v1h-5.3v-1c1.4 0 1.8-.3 1.8-.8v-7c0-.7-.4-1.2-1.8-1.2v-1l3.9-.1v1.7c1.3-.9 2.5-1.7 4.1-1.7 1.2 0 2.2.7 2.6 2 1.4-1.2 2.8-2 4.3-2zm4.9 5.8c0-3.4 2.2-5.8 5.5-5.8 3.4 0 5.5 2.3 5.5 5.7 0 3.4-2.2 5.8-5.5 5.8-3.5 0-5.5-2.4-5.5-5.7zm8.5-.1c0-3.2-1.2-4.7-3.2-4.7-1.9 0-2.9 1.4-2.9 4.7 0 3.2 1.2 4.7 3.2 4.7 1.8 0 2.9-1.5 2.9-4.7zm3.2 4.5c1.4 0 1.8-.3 1.8-.8v-7c0-.7-.4-1.2-1.8-1.2v-1l3.9-.1v1.9c.8-1.1 1.9-2 3.1-2 1.2 0 1.8.8 1.8 1.8 0 .8-.6 1.4-1.3 1.4-.7 0-1.4-.4-1.4-1.3v-.4c-1.1 0-1.8.7-2.3 1.3v6.5c0 .6.4.8 2 .8v1h-6v-.9zm9.7 0c1.4 0 1.8-.3 1.8-.8v-7c0-.7-.3-1.2-1.7-1.2v-1l3.9-.1v9.3c0 .6.3.8 1.8.8v1h-5.7v-1zm1.4-14.2c0-.9.6-1.5 1.4-1.5.9 0 1.4.6 1.4 1.5s-.6 1.5-1.4 1.5c-.8-.1-1.4-.6-1.4-1.5zm5.3 12.8c0-1 .5-2 1.5-2.5 1.8-1 4.7-1.4 5.1-1.7V23c0-2.1-.6-2.9-2.2-2.9-.8 0-1.2.2-1.6.5.2.4.3.8.3 1.1 0 .7-.5 1.3-1.3 1.3s-1.3-.6-1.3-1.3c0-1.6 2-2.7 4.3-2.7 2.5 0 4 1.1 4 3.4v5.3c0 1.2.2 1.5 1.8 1.3l.1.8c-.9.3-1.4.5-2.1.5-1.3 0-1.6-.5-1.8-1.9h-.2c-1 1.1-2.1 1.9-3.5 1.9-2.1.1-3.1-1-3.1-2.4zm6.6-.4v-2.9c-3.4.8-4.1 1.3-4.1 2.7 0 .9.5 1.6 1.7 1.6.9.1 1.8-.6 2.4-1.4zm4.7 1.8c1.4 0 1.8-.3 1.8-.8V15.8c0-.7-.5-1.2-1.9-1.2v-1l4-.1v15c0 .6.4.8 1.8.8v1h-5.7v-1zm11.1-3.7h.9c1.3 2.8 2.9 3.9 4.9 3.9 2.2 0 3.1-1.4 3.1-2.7 0-1.7-1.1-2.4-4.1-3.4-2.2-.8-4.6-1.5-4.6-4.5s2.4-4.8 5.4-4.8c1.4 0 2.2.3 3 .6l.8-.7h.7v4.7h-.9c-.8-2.2-2.1-3.3-4-3.3-1.5 0-2.8 1-2.8 2.6s1.2 2.2 3.8 3.1c2.2.7 4.6 1.5 4.6 4.5 0 2.4-1.5 5.2-5.5 5.2-1.3 0-2.5-.3-3.5-.7l-1.3.8h-.7v-5.3zm11.7 3.7c1.4 0 1.8-.3 1.8-.8V15.8c0-.7-.5-1.2-1.9-1.2v-1l4-.1v15c0 .6.4.8 1.8.8v1h-5.7v-1zm6.2-4.4c0-3.4 2.2-5.8 5.5-5.8 3.4 0 5.5 2.3 5.5 5.7 0 3.4-2.2 5.8-5.5 5.8-3.5 0-5.5-2.4-5.5-5.7zm8.5-.1c0-3.2-1.2-4.7-3.2-4.7-1.9 0-2.9 1.4-2.9 4.7 0 3.2 1.2 4.7 3.2 4.7 1.9 0 2.9-1.5 2.9-4.7zm3.6 3.1c0-1 .5-2 1.5-2.5 1.8-1 4.7-1.4 5.1-1.7V23c0-2.1-.6-2.9-2.2-2.9-.8 0-1.2.2-1.6.5.2.4.3.8.3 1.1 0 .7-.5 1.3-1.3 1.3s-1.3-.6-1.3-1.3c0-1.6 2-2.7 4.3-2.7 2.5 0 4 1.1 4 3.4v5.3c0 1.2.2 1.5 1.8 1.3l.1.8c-.9.3-1.4.5-2.1.5-1.3 0-1.6-.5-1.8-1.9h-.2c-1 1.1-2.1 1.9-3.5 1.9-2.1.1-3.1-1-3.1-2.4zm6.6-.4v-2.9c-3.4.8-4.1 1.3-4.1 2.7 0 .9.5 1.6 1.7 1.6 1 .1 1.8-.6 2.4-1.4zm4.8 1.8c1.4 0 1.8-.3 1.8-.8v-7c0-.7-.4-1.2-1.8-1.2v-1l3.9-.1v1.7c1.3-.9 2.7-1.7 4.3-1.7 1.7 0 2.8 1.2 2.8 3.4v6c0 .6.3.8 1.8.8v1h-5.5v-1c1.2 0 1.5-.3 1.5-.8v-5.1c0-2-.7-2.6-2.1-2.6-1.1 0-2 .5-2.7.9v6.8c0 .6.3.8 1.5.8v1H219v-1.1zm22.2-1.1c0 .8.1 1 2 1v1h-7v-1c2-.1 2.5-.3 2.5-1V16.5c0-.7-.5-1-2.5-1v-1h7.3v1c-2.1.1-2.3.2-2.3 1v6.2l5.2-5.2c1.2-1.2 1.1-1.9-.7-2.1v-.9h6.2v.9c-1.8.3-2.5.7-4.2 2.4l-3.2 3.1 4.7 6.4c.9 1.2 1.3 1.8 3.3 2.1v1h-7v-1c1.7-.2 2.1-.6 1.3-1.7l-3.7-5.2-1.7 1.6v4.1zm14-3.5c0 2.5 1.2 4.5 3.6 4.5 1.4 0 2.5-.8 3.4-2l.6.6c-.9 1.5-2.3 2.8-4.7 2.8-3.4 0-5.2-2.4-5.2-5.6 0-3.3 2.1-5.8 5.2-5.8 3.4 0 4.7 2.8 4.5 5.5h-7.4zm5.1-1.1c.1-2-.6-3.6-2.4-3.6-1.5 0-2.5 1-2.7 3.7l5.1-.1zm4.8 3.9v-7.1h-2v-.8l2-.4v-3.1l2.1-.9v4h3.4v1.2h-3.4v6.8c0 1.3.4 1.9 1.4 1.9.7 0 1.2-.5 1.7-1.3l.7.5c-.9 1.6-1.7 2.2-3.2 2.2-1.7.1-2.7-1.1-2.7-3zm8.5 0v-7.1h-2v-.8l2-.4v-3.1l2.1-.9v4h3.4v1.2h-3.4v6.8c0 1.3.4 1.9 1.4 1.9.7 0 1.2-.5 1.7-1.3l.7.5c-.9 1.6-1.7 2.2-3.2 2.2-1.8.1-2.7-1.1-2.7-3zm8.9-2.8c0 2.5 1.2 4.5 3.6 4.5 1.4 0 2.5-.8 3.4-2l.6.6c-.9 1.5-2.3 2.8-4.7 2.8-3.4 0-5.2-2.4-5.2-5.6 0-3.3 2.1-5.8 5.2-5.8 3.4 0 4.7 2.8 4.5 5.5h-7.4zm5.1-1.1c.1-2-.7-3.6-2.4-3.6-1.5 0-2.5 1-2.7 3.7l5.1-.1zm3.3 5.7c1.4 0 1.8-.3 1.8-.8v-7c0-.7-.4-1.2-1.8-1.2v-1l3.9-.1v1.9c.8-1.1 1.9-2 3.1-2 1.2 0 1.8.8 1.8 1.8 0 .8-.6 1.4-1.3 1.4-.7 0-1.4-.4-1.4-1.3v-.4c-1.1 0-1.8.7-2.3 1.3v6.5c0 .6.4.8 2 .8v1h-6v-.9zm9.7 0c1.4 0 1.8-.3 1.8-.8v-7c0-.7-.3-1.2-1.7-1.2v-1l3.9-.1v9.3c0 .6.3.8 1.8.8v1h-5.7v-1zm1.3-14.2c0-.9.6-1.5 1.4-1.5.9 0 1.4.6 1.4 1.5s-.6 1.5-1.4 1.5c-.8-.1-1.4-.6-1.4-1.5zm5.4 14.2c1.4 0 1.8-.3 1.8-.8v-7c0-.7-.4-1.2-1.8-1.2v-1l3.9-.1v1.7c1.3-.9 2.7-1.7 4.3-1.7 1.7 0 2.8 1.2 2.8 3.4v6c0 .6.3.8 1.8.8v1h-5.5v-1c1.2 0 1.5-.3 1.5-.8v-5.1c0-2-.7-2.6-2.1-2.6-1.1 0-2 .5-2.7.9v6.8c0 .6.3.8 1.5.8v1h-5.5v-1.1zm22.8-11.7c.8 0 1.3.5 1.3 1.2 0 .6-.4 1.1-.9 1.1-.6 0-1.1-.4-1.1-1.1-.5.2-1.1.6-1.4 1.1 1 .6 1.7 1.6 1.7 3 0 2.3-1.9 3.8-4.3 3.8-.5 0-1 0-1.4-.2-.6.3-1 .7-1 1.1 0 .5.3 1 2.3 1h1.1c3.2 0 4.6.8 4.6 2.8 0 1.9-2 4-5.8 4-3.2 0-4.8-1.2-4.8-2.6 0-1.1 1.1-2.1 2.9-2.4V30c-1.4-.3-1.9-.9-1.9-1.9 0-.7.6-1.4 1.7-2-1.2-.6-2-1.6-2-3.2 0-2.3 1.9-3.8 4.4-3.8.7 0 1.4.1 1.9.3.4-1 1.4-1.8 2.7-1.8zm-.9 14.5c0-1-.6-1.6-3-1.6h-2c-1.3.2-2.1.9-2.1 1.9 0 1.1 1.2 1.9 3.6 1.9 2.1-.1 3.5-1.1 3.5-2.2zm-1.7-9.2c0-1.8-.9-2.9-2.2-2.9-1.2 0-2 .7-2 2.9s1 2.8 2.2 2.8c1.1 0 2-.8 2-2.8zM75.6 47.6c0-4.9 3.6-8.5 8.2-8.5 1.7 0 2.9.6 3.8 1.1l.7-1h.9v5.5h-.8c-1.1-2.7-2.5-4.3-4.9-4.3-2.8 0-5.2 2.5-5.2 7.2 0 4.4 2.8 6.7 5.6 6.7 2.7 0 4-1.5 5-3.5l1 .5c-1 2.3-3.1 4.6-6.6 4.6-4.5-.1-7.7-3.4-7.7-8.3zM91.1 53c0-1 .5-2 1.5-2.5 1.8-1 4.7-1.4 5.1-1.7v-.7c0-2.1-.6-2.9-2.2-2.9-.8 0-1.2.2-1.6.5.2.4.3.8.3 1.1 0 .7-.5 1.3-1.3 1.3s-1.3-.6-1.3-1.3c0-1.6 2-2.7 4.3-2.7 2.5 0 4 1.1 4 3.4v5.3c0 1.2.2 1.5 1.8 1.3l.1.8c-.9.3-1.4.5-2.1.5-1.3 0-1.6-.5-1.8-1.9h-.2c-1 1.1-2.1 1.9-3.5 1.9-2.1.1-3.1-1-3.1-2.4zm6.5-.4v-2.9c-3.4.8-4.1 1.3-4.1 2.7 0 .9.5 1.6 1.7 1.6 1 .1 1.9-.7 2.4-1.4zm4.9 1.8c1.4 0 1.8-.3 1.8-.8v-7c0-.7-.4-1.2-1.8-1.2v-1l3.9-.1V46c1.3-.9 2.7-1.7 4.3-1.7 1.7 0 2.8 1.2 2.8 3.4v6c0 .6.3.8 1.7.8v1h-5.5v-1c1.2 0 1.5-.3 1.5-.8v-5.1c0-2-.7-2.6-2.1-2.6-1.1 0-2 .5-2.7.9v6.8c0 .6.3.8 1.5.8v1h-5.5v-1.1zm13.1-4.4c0-3.4 2.4-5.8 5.4-5.8 2.5 0 4 1.4 4 2.7 0 .9-.6 1.6-1.4 1.6-.8 0-1.4-.5-1.4-1.2s.4-1.1.8-1.3c-.3-.4-1.1-.8-2-.8-1.8 0-3.1 1.2-3.1 4.3 0 2.9 1.3 4.7 3.6 4.7 1.3 0 2.4-.7 3.2-1.7l.6.6c-1 1.5-2.3 2.5-4.6 2.5-3.1 0-5.1-2.4-5.1-5.6zm12.8-.2c0 2.5 1.2 4.5 3.6 4.5 1.3 0 2.5-.8 3.4-2l.6.6c-.9 1.5-2.3 2.8-4.7 2.8-3.4 0-5.2-2.4-5.2-5.6 0-3.3 2.1-5.8 5.2-5.8 3.4 0 4.7 2.8 4.5 5.5h-7.4zm5.1-1.1c.1-2-.7-3.6-2.4-3.6-1.5 0-2.5 1-2.7 3.7l5.1-.1zm3.3 5.7c1.4 0 1.8-.3 1.8-.8v-7c0-.7-.4-1.2-1.8-1.2v-1l3.9-.1v1.9c.8-1.1 1.9-2 3.1-2 1.2 0 1.8.8 1.8 1.8 0 .8-.6 1.4-1.3 1.4-.7 0-1.4-.4-1.4-1.3v-.4c-1.1 0-1.8.7-2.3 1.3v6.5c0 .6.4.8 2 .8v1h-6v-.9zm13.5-6.8c0-4.9 3.6-8.5 8.2-8.5 1.7 0 2.9.6 3.8 1.1l.7-1h.9v5.5h-.8c-1.1-2.7-2.5-4.3-4.9-4.3-2.8 0-5.2 2.5-5.2 7.2 0 4.4 2.8 6.7 5.6 6.7 2.7 0 4-1.5 5-3.5l1 .5c-1 2.3-3.1 4.6-6.6 4.6-4.5-.1-7.7-3.4-7.7-8.3zm18 2.2c0 2.5 1.2 4.5 3.6 4.5 1.3 0 2.5-.8 3.4-2l.6.6c-.9 1.5-2.3 2.8-4.7 2.8-3.4 0-5.2-2.4-5.2-5.6 0-3.3 2.1-5.8 5.2-5.8 3.4 0 4.7 2.8 4.5 5.5h-7.4zm5-1.1c.1-2-.7-3.6-2.4-3.6-1.5 0-2.5 1-2.7 3.7l5.1-.1zm3.3 5.7c1.4 0 1.8-.3 1.8-.8v-7c0-.7-.4-1.2-1.8-1.2v-1l3.9-.1V46c1.3-.9 2.7-1.7 4.3-1.7 1.7 0 2.8 1.2 2.8 3.4v6c0 .6.3.8 1.8.8v1h-5.5v-1c1.2 0 1.5-.3 1.5-.8v-5.1c0-2-.7-2.6-2.2-2.6-1.1 0-2 .5-2.7.9v6.8c0 .6.3.8 1.5.8v1h-5.5v-1.1zm14.5-1.8v-7.1h-2v-.8l2-.4v-3.1l2.1-.9v4h3.4v1.2h-3.4v6.8c0 1.3.4 1.9 1.4 1.9.7 0 1.2-.5 1.7-1.3l.7.5c-.9 1.6-1.7 2.2-3.2 2.2-1.8 0-2.7-1.1-2.7-3zm8.9-2.8c0 2.5 1.2 4.5 3.6 4.5 1.4 0 2.5-.8 3.4-2l.6.6c-.9 1.5-2.3 2.8-4.7 2.8-3.4 0-5.2-2.4-5.2-5.6 0-3.3 2.1-5.8 5.2-5.8 3.4 0 4.7 2.8 4.5 5.5H200zm5.1-1.1c.1-2-.6-3.6-2.4-3.6-1.5 0-2.5 1-2.7 3.7l5.1-.1zm3.3 5.7c1.4 0 1.8-.3 1.8-.8v-7c0-.7-.4-1.2-1.8-1.2v-1l3.9-.1v1.9c.8-1.1 1.9-2 3.1-2 1.2 0 1.8.8 1.8 1.8 0 .8-.6 1.4-1.3 1.4-.7 0-1.4-.4-1.4-1.3v-.4c-1.1 0-1.8.7-2.3 1.3v6.5c0 .6.4.8 2 .8v1h-6v-.9zM18.7 53.3l.6.1-1 7.8-.9-.1.9-6.9-1.5.3-.1-.7 2-.5zm5.9 8.5c-1.6-.1-2.9-1.1-2.8-2.4 0-.9.7-1.6 1.7-1.8-.7-.4-1.3-1-1.2-1.9 0-1.2 1.3-2 2.8-1.9 1.4.1 2.6 1 2.5 2.2 0 .9-.7 1.4-1.4 1.7.9.4 1.5 1.1 1.5 2-.2 1.4-1.5 2.2-3.1 2.1zm.2-3.7c-1.1-.1-2.1.5-2.1 1.4 0 .8.7 1.5 2 1.6 1.3.1 2.1-.6 2.1-1.4 0-.9-.9-1.5-2-1.6zm.1-3.5c-1-.1-1.8.5-1.8 1.3-.1.9.7 1.5 1.7 1.5s1.8-.5 1.9-1.4c0-.7-.7-1.4-1.8-1.4zm8.5 7.3c-1.7.1-3-.8-3-2.1 0-.9.6-1.6 1.5-2-.7-.3-1.4-.8-1.4-1.7 0-1.2 1.2-2.1 2.6-2.2 1.4 0 2.7.8 2.7 2 0 .9-.6 1.5-1.3 1.8.9.3 1.6.9 1.7 1.8 0 1.4-1.2 2.3-2.8 2.4zm-.2-3.7c-1.1 0-2 .7-2 1.6 0 .8.8 1.4 2.1 1.4 1.3-.1 2-.7 2-1.5 0-1-.9-1.6-2.1-1.5zm-.1-3.6c-1 0-1.8.6-1.7 1.4 0 .9.8 1.4 1.8 1.4s1.8-.6 1.7-1.5c0-.7-.8-1.3-1.8-1.3zm9.3-1.5l.7 5.2 1.2-.2.1.7-1.2.2.2 1.8-.8.2-.2-1.8-4.1.5-.3-.6 3.7-5.9.7-.1zm-.7 1.3L39 58.8l3.2-.4-.5-4zm-9.5-39.2l7.5 7.5 2.4-2.4L30.5 8.7 18.9 20.3l2.4 2.4 7.5-7.5v12.1h-8.3v3.4h8.3v2.9h-8.3V37h8.3v3h-8.3v3.4h8.3v8.7h3.4v-8.7h8.3V40h-8.3v-3h8.2v-3.4h-8.2v-2.9h8.3v-3.4h-8.3V15.2zm27.6 7.2c-2.5-11-9-18.2-18.9-21.1C37.9.5 34.5 0 30.8 0h-.3c-3.9 0-7.5.5-10.6 1.4-9.6 2.9-16 10-18.5 21C.5 26 0 29.9 0 34.3s.4 8.4 1.2 12c2.6 11.5 9.4 18.9 19.9 21.6 2.8.7 5.9 1.1 9.2 1.1h.3c3.3 0 6.4-.4 9.2-1 10.5-2.6 17.3-10 20-21.6.8-3.5 1.2-7.4 1.2-11.6.1-4.6-.3-8.7-1.2-12.4zm-3.8 24c-2 8.1-6.7 15.4-16.5 18.1-2.6.7-5.6 1.1-9.1 1.1h-.3c-3.4 0-6.5-.5-9.1-1.2-9.7-2.8-14.4-10-16.4-18.1-1-3.9-1.3-8.1-1.3-12 0-3.7.4-7.6 1.3-11.3 1.9-7.9 6.2-15 15.2-18 2.9-1 6.4-1.6 10.4-1.6h.3c3.9 0 7.2.6 10 1.5 9.2 3 13.6 10.1 15.5 18 .9 3.9 1.3 8 1.2 11.8.1 3.8-.3 7.8-1.2 11.7z"></path>
						</svg>
					</a>
				</div>
				<!-- /Logo -->


				<a id="menu-toggler" class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsCollapse" aria-controls="navbarsCollapse" aria-expanded="false" aria-label="Toggle navigation">
					<i class="fa fa-bars"></i>
				</a>

				<!-- Header Menu -->
				<ul class="nav pull-right">
					<li class="nav-item dropdown profile-item ">
						<a href="#">
							Test Doctor<br />
							Uralensis inov8 inc<br />
							June 27, 01:30pm
						</a>
						<a href="#" class="btn btn-primary btn-round">KJ</span>
						</a>
						<!-- <div class="dropdown-menu">
							<a class="dropdown-item" href="<?php echo base_url() ?>/profile/view">My Profile</a>
							<a class="dropdown-item" href="settings.html">Settings</a>
							<a class="dropdown-item" href="<?php echo base_url() ?>/logout">Logout</a>
						</div> -->
					</li>
				</ul>
				<a class="logo logo-center" href="/">
					<img src="<?php echo base_url() ?>/assets/institute/img/small-logo.jpg">
				</a>

				<div class="collapse navbar-collapse" id="navbarsCollapse">
					<ul class="nav patient-menu">
						<li class="nav-item">
							<a href="#">
								Surname: James <br />
								Last Name: Smith
							</a>
						</li>
						<li class="nav-item">
							<a href="">Gender: male <br />
								DOB: 23/02/1983</a>
						</li>
						<li class="nav-item">
							<a href="">Hospital No. 13123213<br />
								NHS: 232132132</a>
						</li>
						<li class="nav-item">
							<a href="">
								<span class="badge badge-pill relative bg-white">
									<i class="fa fa-male"></i>
									42
								</span>
								<span class="badge badge-pill relative bg-white">
									2ww
								</span>
								<br />
								<span class="badge badge-pill relative bg-white">
									PCI
								</span>
								<span class="badge badge-pill relative bg-white">
									R
								</span>
							</a>
						</li>
						<li class="nav-item">
							<a href="">
								16 <br /> RCPath
							</a>
						</li>
					</ul>
					<ul class="nav patient-menu">
						<li class="nav-item">
							<a class="btn-icon" href="#">
								<span>
									<span class="badge badge-pill">3</span>
									<img class="mt-1" src="assets/institute/img/layersIconMenu.png">
								</span>
								<span>Reported</span>
							</a>
						</li>
						<li class="nav-item">
							<a class="btn-icon" href="#">
								<span>
									<span class="badge badge-pill">3</span>
									<img class="mt-1" src="assets/institute/img/layersIconMenu.png">
								</span>
								<span>Unreported</span>
							</a>
						</li>
						<li class="nav-item">
							<a class="btn-icon" href="#">
								<span>
									<span class="badge badge-pill">3</span>
									<img class="mt-1" src="assets/institute/img/layersIconMenu.png">
								</span>
								<span>Further Work</span>
							</a>
						</li>
						<li class="nav-item">
							<a class="btn-icon" href="#">
								<span>
									<span class="badge badge-pill">3</span>
									<i class="fa fa-briefcase"></i><br />
								</span>
								<span>Emails</span>
							</a>
						</li>


					</ul>
				</div>
				<!-- /Header Menu -->

			</div>
		</div>
		<!-- /Header -->

		<!-- Secondary Navbar -->
		<!-- <div class="navbar navbar-expand-md">
				<div class="container">
					<ul class="top-menu">
						<li class="active">
							<a href="<?php echo base_url() ?>/">Home Dashboard</a>
						</li>

						<li>
							<a href="#">Upload Centre</a>
						</li>
						<li>
							<a href="#">View Record</a>
						</li>			
						<li>
							<a href="#">Archive</a>
						</li>		
						<li>
							<a href="<?php echo base_url() ?>/invoices">Billing</a>
						</li>	
						<li>
							<a href="#">Support</a>
						</li>	
						<li>
							<a href="#">Pollicies</a>
						</li>	
					</ul>
				</div> -->
	</div>
    <!-- /Secondary Navbar -->
    
     <!-- Page Wrapper -->

 <style>
 	#case-info-header {
 		margin-bottom: 20px;
 	}

 	#specimens-tab {
 		height: 40px;
 	}

 	#specimens-tab button {
 		margin-left: 5px;
 		margin-right: 5px;
 		border-radius: 5px;
 	}
 </style>

 <div class="page-wrapper patient-doctor">

 	<!-- Page Content -->
 	<div class="content container-fluid">