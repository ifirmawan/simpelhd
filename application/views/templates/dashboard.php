<!doctype html>
<html>
<head>
    <title><?php echo $this->template->title->default("Default title"); ?></title>
    <meta charset="utf-8">
    <meta name="description" content="<?php echo $this->template->description; ?>">
    <meta name="author" content="ibm-st3telkom">
    <?php echo $this->template->meta; ?>
    <?php echo $this->template->stylesheet; ?>
    
</head>
<body>

<?php echo (isset($bar_navigation_top))? $bar_navigation_top : '';?>

<?php echo (isset($bar_menu_side))? $bar_menu_side : '';?>

<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">

<?php echo $this->template->content; ?>

<!-- Modal -->
<?php echo (isset($modal))? $modal : '';?>
<!-- page end-->
    </section>
</section>
<?php if (isset($personidentity)) : ?>
    <i class="val-op-step">op-step</i>
  <?php endif;?>
  <span class="url_act" style="display:none;"><?php echo site_url();?></span>
  <?php echo $this->template->javascript; ?>
</body>
</html>