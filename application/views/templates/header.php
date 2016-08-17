<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="ST3 Telkom Purwokerto">
    <meta name="keyword" content="simpel hand v.1">
    <link rel="shortcut icon" href="<?php echo base_url();?>assets/img/favicon.ico">

    <title><?php echo (isset($title))? $title : 'Simpel Hand';?></title>

    
    <?php if (isset($ResourceCSS) && $ResourceCSS && is_array($ResourceCSS)) {
        foreach ($ResourceCSS as $key => $value) { ?>
    <link href="<?php echo base_url().'assets/'.$value;?>" rel="stylesheet">
    <?php }
    }?>
  </head>
  <body>
  