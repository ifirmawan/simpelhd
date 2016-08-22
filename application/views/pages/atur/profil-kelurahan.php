<div class="row">
    <div class="col-lg-12">
    <section class="panel">
    <header class="panel-heading">Atur Profil kelurahan</header>
    <div class="panel-body">
<form role="form" action="<?php echo site_url('submit_settings/set_config_kelurahan');?>" method="post">
    <?php echo (is_null($errors))? '' : '<div class="alert alert-warning alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><strong>Perhatian !</strong>'.$errors.'</div>';?>
    <div class="col-xs-12 col-lg-6">
        <span class="col-xs-12 col-lg-3" >
            <input type="number" name="prov_kode" class="form-control col-xs-3" placeholder="Kode Provinsi" style="border-radius:0px;" value="<?php echo GetKonfigValByKey('prov_kode');?>">
        </span>
        <span class="col-xs-12 col-lg-9">
            <input type="text" name="prov_nama" class="form-control col-xs-9" placeholder="provinsi" value="<?php echo GetKonfigValByKey('prov_nama');?>"/>
        </span>
    	<span class="col-xs-12 col-lg-3">
            <input type="number" name="kab_kode" class="form-control col-xs-3" placeholder="Kode Kabupaten" style="border-radius:0px;" value="<?php echo GetKonfigValByKey('kab_kode');?>"/>
        </span>
        <span class="col-xs-12 col-lg-9">
            <input type="text" name="kab_nama" class="form-control col-xs-9" placeholder="Kabupaten" value="<?php echo GetKonfigValByKey('kab_nama');?>"/>
        </span>
    	<span class="col-xs-12 col-lg-3">
            <input type="number" name="kec_kode" class="form-control col-xs-3" placeholder="Kode Kecamatan" style="border-radius:0px;" value="<?php echo GetKonfigValByKey('kec_kode');?>"/>
        </span>
        <span class="col-xs-12 col-lg-9">
            <input type="text" name="kec_nama" class="form-control col-xs-9" placeholder="Kecamatan" value="<?php echo GetKonfigValByKey('kec_nama');?>"/>
        </span>
    	<span class="col-xs-12 col-lg-3">
            <input type="number" name="kel_kode" class="form-control col-xs-3" placeholder="Kode Kelurahan" style="border-radius:0px;" value="<?php echo GetKonfigValByKey('kel_kode');?>"/>
        </span>
        <span class="col-xs-12 col-lg-9">
            <input type="text" name="kel_nama" class="form-control col-xs-9" placeholder="Kelurahan" value="<?php echo GetKonfigValByKey('kel_nama');?>"/>
        </span>
    		
		<div class="form-group">
    		<label >Dusun/Dukuh/Kampung</label>
    		<textarea class="form-control" name="desa_nama" ><?php echo GetKonfigValByKey('desa_nama');?></textarea>
    	</div>
    </div>
    <div class="col-xs-12 col-lg-6">
    	<div class="form-group">
    		<label >NIP Lurah</label>
    		<input type="text" class="form-control" name="lurah_nip" value="<?php echo GetKonfigValByKey('lurah_nip');?>"/>
    	</div>
    	<div class="form-group">
    		<label >Nama lurah</label>
    		<input type="text" class="form-control" name="lurah_nama" value="<?php echo GetKonfigValByKey('lurah_nama');?>"/>
    	</div>
    	
    </div>
    <div class="col-xs-12 pull-right">
    	<button type="submit" class="btn btn-primary btn-lg">Simpan</button>
    	<button type="reset" class="btn btn-default btn-lg">Reset</button>
    </div>
</form>
    </div>
    </section>
    </div>	
</div>