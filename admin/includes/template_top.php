<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2014 osCommerce

  Released under the GNU General Public License
*/
?>
<!DOCTYPE html>
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<meta name="robots" content="noindex,nofollow">
<title><?php echo TITLE; ?></title>
<base href="<?php echo ($request_type == 'SSL') ? HTTPS_SERVER . DIR_WS_HTTPS_ADMIN : HTTP_SERVER . DIR_WS_ADMIN; ?>" />
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<!-- <link href="<?php echo tep_catalog_href_link('ext/bootstrap/css/bootstrap.min.css', '', 'SSL'); ?>" rel="stylesheet">-->
<link rel="stylesheet" href="<?php echo tep_catalog_href_link('ext/datepicker/css/datepicker.css', '', 'SSL'); ?>">
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">

<!--[if IE]><script type="text/javascript" src="<?php echo tep_catalog_href_link('ext/flot/excanvas.min.js', '', 'SSL'); ?>"></script><![endif]-->
<!-- <link rel="stylesheet" type="text/css" href="<?php echo tep_catalog_href_link('ext/jquery/ui/redmond/jquery-ui-1.10.4.min.css', '', 'SSL'); ?>"> -->
<script type="text/javascript" src="<?php echo tep_catalog_href_link('ext/jquery/jquery-2.2.3.min.js', '', 'SSL'); ?>"></script>
<script type="text/javascript" src="<?php echo tep_catalog_href_link('ext/jquery/ui/jquery-ui-1.10.4.min.js', '', 'SSL'); ?>"></script>

<script type="text/javascript" src="<?php echo tep_catalog_href_link('ext/flot/jquery.flot.min.js', '', 'SSL'); ?>"></script>
<script type="text/javascript" src="<?php echo tep_catalog_href_link('ext/flot/jquery.flot.time.min.js', '', 'SSL'); ?>"></script>
<script type="text/javascript" src="includes/general.js"></script>
</head>
<body>
    <?php require('includes/header.php'); ?>
    <div id="bodyWrapper">
        <div class="container-fluid">
            <div class="row">

<?php
	if (tep_session_is_registered('admin')) {
        include('includes/column_left.php');
		echo '<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">';	  
	} else {
		echo '<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">';
	}
?>
