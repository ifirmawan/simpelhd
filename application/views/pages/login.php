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