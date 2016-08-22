<!-- Modal -->
          <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="pengajuan" class="modal fade">
              <div class="modal-dialog">
                  <div class="modal-content">
                      <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                          <h4 class="modal-title">Pengajuan</h4>
                      </div>
                      <div class="modal-body text-center">
                              <form class="form-horizontal" action="">
                                      <div class="form-group">
                                          <label class="col-lg-4 control-label">Masukkan NIK</label>
                                          <div class="col-lg-8">
                                              <input type="text" class="form-control">
                                          </div>
                                      </div>
                                      <div class="form-group">
                                          <label class="col-lg-4 control-label">Ingin Mengajukan</label>
                                          <div class="col-lg-8">
                                                <select class="form-control m-bot15">
                                                  <option>Kartu Keluarga</option>
                                                  <option>Kartu Tanda Penduduk</option>
                                                  <option>Akte Kelahiran</option>
                                                  <option>Surat Keterangan Tidak Mampu</option>
                                                </select>                                              
                                          </div>
                                      </div>
                                     <button class="btn btn-success" type="submit">Mulai</button>
                                     Belum ada?
                                     
                                </form>

                      </div>                
                  </div>
              </div>
          </div>
          <!-- modal -->

  
    <!--sidebar start-->

      <aside>
          <div id="sidebar"  class="nav-collapse ">
<ul class="sidebar-menu" id="nav-accordion">
<?php if (isset($items) && $items) {
  foreach ($items as $key => $value) { ?>
      <li>
          <a class="active" href="<?php echo site_url($value['link']);?>">
                <i class="<?php echo $value['icon'];?>"></i>
                <span><?php echo $value['label'];?></span>
          </a>
      </li>
  <?php  
  }
}?>
</ul>
          </div>
      </aside>
      <!--sidebar end-->
