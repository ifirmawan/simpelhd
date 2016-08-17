<div class="row">
    <div class="col-lg-12">
    <section class="panel">
    <header class="panel-heading">Pembuatan Kartu Keluarga </header>
    <div class="panel-body">
        

      <div class="row ">
          <div class="col-xs-12 col-lg-offset-2">
            <h3>Selamat <strong><?php echo (isset($personidentity[0]['nama_lengkap']))? $personidentity[0]['nama_lengkap'] : 'Anonymous';?></strong> :), pembuatan Kartu KK telah selesai<br/></h3>
            <strong>Ketentuan buat data baru</strong><br/>
            <input type="checkbox" name="relasi" value="<?php echo (isset($id))? $id : 0 ;?>">Masih satu keluarga?<br/>
          </div>
      </div> 
      <div class="row ">
        <div class="col-xs-12 col-lg-offset-2">
            <button type="submit" class="btn btn-primary btn-sm">Cetak</button>
            <button type="submit" class="btn btn-success btn-sm">Buat Baru</button>
            <button type="submit" class="btn btn-warning btn-sm">Keluar</button>
        </div>
      </div>

    </div>
    </section>
    </div>
</div>
