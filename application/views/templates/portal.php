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
<div class="container">
<div class="col-xs-12 col-lg-4 col-lg-offset-4">
		<?php echo $this->template->content; ?>
</div>
</div>

<!-- Modal -->
<div class="modal fade" id="resetModal" tabindex="-1" role="dialog" aria-labelledby="resetModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="resetModalLabel">Email untuk reset password</h4>
      </div>
      <form action="<?php echo site_url('login/resetpassaction');?>" method="post">
        <div class="modal-body">
          <input type="email" name="email" class="form-control" />
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary col-xs-12">Kirim</button>
        </div>
      </form>
    </div>
  </div>
</div>
<?php echo $this->template->javascript; ?>
</body>
</html>
