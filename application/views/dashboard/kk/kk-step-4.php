<div class="row">
    <div class="col-lg-12">
    <section class="panel">
    <header class="panel-heading">
        DATA perkawinan Bpk 
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
            <th>Nomor Akta Perkawinan</th>    
            <th>Tanggal Perkawinan</th>
            <th>Nomor Akta Perceraian</th>
            <th>Tanggal Perceraian</th>
        </tr>
    </thead>
    <tbody>
        <?php
            if (isset($perkawinan)) {
                foreach ($perkawinan as $key => $value) {?>
                    <tr>
                        <td><?php echo $value['nama_lengkap'];?></td>                        
                        <td><input type="number" id="<?php echo $value['id'];?>" name="perkawinan_akte_no" class="form-control submit-editable" value="<?php echo $value['perkawinan_akte_no'];?>" /></td>
                        <td><input type="date" id="<?php echo $value['id'];?>" name="perkawinan_tgl" class="form-control tgl-step" value="<?php echo $value['perkawinan_tgl'];?>" /></td>
                        <td>
                            <?php if (in_array($value['status_perkawinan'], array('3','4'))):?>
                                <input type="number" id="<?php echo $value['id'];?>" name="cerai_akte_no" class="form-control submit-editable" value="<?php echo $value['cerai_akte_no'];?>" />
                            <?php else:?>
                                <i class="glyphicon glyphicon-remove"></i>
                            <?php endif;?>
                            
                        </td>
                        <td>
                            <?php if (in_array($value['status_perkawinan'], array('3','4'))):?>
                            <input type="date" id="<?php echo $value['id'];?>" name="cerai_tgl" class="form-control tgl-step" value="<?php echo $value['cerai_tgl'];?>" />
                            <?php else:?>
                                <i class="glyphicon glyphicon-remove"></i>
                            <?php endif;?>
                        </td>
                    </tr>
                <?php }
            }
         ?>
    </tbody>
    </table>
            <a href="<?php echo site_url('welcome/kk_step/3');?>" class="pull-left btn btn-lg btn-default"><i class="glyphicon glyphicon-chevron-left"></i> Sebelumnya</a>        
            <a href="<?php echo site_url('welcome/kk_step/5');?>" class="pull-right btn btn-lg btn-success"><i class="glyphicon glyphicon-chevron-right"></i> Selanjutnya</a>
    </div>
    </section>
    </div>
</div>