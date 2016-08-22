<div class="row">
    <div class="col-lg-12">
    <section class="panel">
    <header class="panel-heading">Pembuatan Kartu Keluarga </header>
    <div class="panel-body">
    <form action="<?php echo site_url('submit_person/new_person');?>"  method="post">
      <div class="row">
        <div class="col-xs-12 col-lg-6">

            <div class="form-group">
              <label >Kedudukan Dalam Keluarga</label>
              <?php echo (isset($jabatan))? $jabatan : '';?>
            </div>
            <div class="form-group">
              <label >Nama lengkap</label>
              <input type="text" name="nama_lengkap" class="form-control" >
            </div>
            <div class="form-group">
            <label >Gender</label>
              <?php echo (isset($gender))? $gender : '';?>
            </div>
            <div class="form-group">
              <label >Tempat lahir</label>
              <textarea name="lahir_tempat" rows="2" class="form-control"></textarea>
            </div>
            <div class="form-group">
            <label >Tanggal Lahir</label>
            <input type="date" name="lahir_tanggal" class="form-control" >
          </div>

        </div><!-- end- col-xs-12 -lg-6 -->
        <div class="col-xs-12 col-lg-6">

          <div class="form-group">
            <label>No. Akte</label>
            <input type="text" name="lahir_no_akte" class="form-control" >
          </div>
          <div class="form-group">
            <label >Golongan darah</label>
            <?php echo (isset($goldar))? $goldar : '';?>
          </div>
        <div class="form-group">
          <label >Alamat</label>
          <textarea rows="2" name="alamat" class="form-control" ></textarea>
        </div>
<div class="row">
  <div class="col-xs-12 col-lg-6">
    <div class="input-group">
      <span class="input-group-addon">No. RT</span>
      <input type="number" name="rt_nomer" class="form-control" />
    </div>
  </div>
  <div class="col-xs-12 col-lg-6">
    <div class="input-group">
    <span class="input-group-addon">Ketua RT</span>
    <input type="text" name="rt_ketua" class="form-control" />
    </div>
  </div>
</div>
<div class="row">
  <div class="col-xs-12 col-lg-6">
    <div class="input-group" style="margin:5px 0px 5px 0px;">
      <span class="input-group-addon">No. RW</span>
      <input type="number" name="rw_nomer" class="form-control" />
    </div>
  </div>
  <div class="col-xs-12 col-lg-6">
    <div class="input-group" style="margin:5px 0px 5px 0px;">
    <span class="input-group-addon">Ketua RW</span>
    <input type="text" name="rw_ketua" class="form-control" />
    </div>
  </div>
</div>
        <div class="form-group">
          <label>Agama</label>
          <?php echo (isset($agama))? $agama : '';?>
        </div>

        </div><!-- end- col-xs-12 -lg-6 -->

      </div>
      <div class="row pull-right">
        <div class="col-xs-12 ">
          <button type="submit" class="btn btn-success btn-lg">Selanjutnya</button>
        </div>
      </div>
      </form> 
    </div>
    </section>
    </div>
</div>
