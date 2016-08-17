<div class="row">
    <div class="col-lg-12">
    <section class="panel">
    <header class="panel-heading">
        DATA keluarga Bpk 
        <strong><?php echo (isset($personidentity))? ucfirst($personidentity->nama): 'Anonymous';?></strong> 
        <a href="#" class="btn btn-success" title="lihat details"><i class="glyphicon glyphicon-zoom-in"></i></a>
    </header>
    <div class="panel-body">
    <?php 
    if (!is_null($errors)) { ?>
        <div class="alert alert-warning">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <?php echo $errors;?></div>
    <?php }?>
    <table class="table table-bordered">
    <thead>
        <tr>
            <th>Nama Lengkap</th>
            <th>NIK Ibu</th>    
            <th>Nama lengkap Ibu</th>
            <th>NIK Ayah</th>
            <th>Nama lengkap Ayah</th>
        </tr>
    </thead>
    <tbody>
        <?php
            if (isset($keluarga)) {
                foreach ($keluarga as $key => $value) {?>
                    <tr>
                        <td><?php echo $value['nama_lengkap'];?></td>                        
                        <td><input type="number" id="<?php echo $value['id'];?>" name="ibu_nik" class="form-control submit-editable" value="<?php echo $value['ibu_nik'];?>" /></td>
                        <td><input type="text" id="<?php echo $value['id'];?>" name="ibu_nama" class="form-control submit-editable" value="<?php echo $value['ibu_nama'];?>" /></td>
                        <td><input type="number" id="<?php echo $value['id'];?>" name="ayah_nik" class="form-control submit-editable" value="<?php echo $value['ayah_nik'];?>" /></td>
                        <td><input type="text" id="<?php echo $value['id'];?>" name="ayah_nama" class="form-control submit-editable" value="<?php echo $value['ayah_nama'];?>" /></td>
                    </tr>
                <?php }
            }
         ?>
    </tbody>
    </table>
            <a href="<?php echo site_url('welcome/kk_step/5');?>" class="pull-left btn btn-lg btn-default"><i class="glyphicon glyphicon-chevron-left"></i> Sebelumnya</a>        
            <a href="<?php echo site_url('welcome/kk_done');?>" class="pull-right btn btn-lg btn-success"><i class="glyphicon glyphicon-chevron-right"></i> Selesai</a>
    </div>
    </section>
    </div>
</div>