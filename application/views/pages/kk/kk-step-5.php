    <table class="table table-bordered">
    <thead>
        <tr>
            <th>Nama Lengkap</th>
            <th>Jenis Kelamin</th>
            <th>Kelainan Fisik</th>    
            <th>Penyandang Cacat</th>
        </tr>
    </thead>
    <tbody>
        <?php
            if (isset($keluarga)) {
                foreach ($keluarga as $key => $value) {?>
                    <tr>
                        <td><?php echo $value['nama_lengkap'];?></td>
                        <td>
                            <?php echo (isset($gender))? DirectSelectOptionsView('jenis_kelamin',$gender,$value['id'],$value['jenis_kelamin']) : '';?></td>                        
                        <td>
                            <?php echo (isset($kelainfisik))? DirectSelectOptionsView('kelainan_fisik',$kelainfisik,$value['id'],$value['kelainan_fisik']) : '';?>
                        </td>
                        <td>
                            <?php if ($value['kelainan_fisik'] == 2) { 
                                echo (isset($penycct))? DirectSelectOptionsView('penyandang_cacat',$penycct,$value['id'],$value['penyandang_cacat']) : '';
                            }else{ ?>
                                <i class="glyphicon glyphicon-remove"></i>
                            <?php } ?>
                        </td>
                    </tr>
                <?php }
            }
         ?>
    </tbody>
    </table>
<a href="<?php echo site_url('welcome/kk_step/4');?>" class="pull-left btn btn-lg btn-default"><i class="glyphicon glyphicon-chevron-left"></i> Sebelumnya</a>        
<a href="<?php echo site_url('welcome/kk_step/6');?>" class="pull-right btn btn-lg btn-success"><i class="glyphicon glyphicon-chevron-right"></i> Selanjutnya</a>