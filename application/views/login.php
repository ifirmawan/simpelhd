<div class="container">
<div class="col-xs-12 col-lg-4 col-lg-offset-4">
	<form role="form" action="<?php echo site_url('Login/login_aksi');?>" method="post">
  <div class="form-group">
    <label for="username">Username</label>
    <input type="text" class="form-control" name="username" id="username" placeholder="Masukkan username">
  </div>
  <div class="form-group">
    <label for="pass">Password</label>
    <input type="password" class="form-control" name="password" id="pass" placeholder="Masukkan password">
  </div>
  <button type="submit" class="btn btn-success col-xs-12">login</button>
  <a href="#resetModal"  data-toggle="modal" > Lupa password?</a>
</form>	
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
