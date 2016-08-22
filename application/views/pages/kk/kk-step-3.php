    <table class="table table-bordered">
    <thead>
        <tr>
            <th>Nama Lengkap</th>
            <th>Agama</th>    
            <th>Status Hub. Keluarga</th>
            <th>Status Perkawinan</th>
            <th>Pendidikan terakhir</th>
            <th>Pekerjaan</th>
        </tr>
    </thead>
    <tbody>
        <?php
            if (isset($keluarga)) {
                foreach ($keluarga as $key => $value) {
                    $pekerjaan ='';
                    if (!is_null($value['pekerjaan'])) {
                        $kodejob    = explode('-', $value['pekerjaan']);
                        $pekerjaan  = GetKodeJob($kodejob[0])[$kodejob[1]];
                    }
                 ?>
                    <tr>
                        <td><?php echo $value['nama_lengkap'];?></td>                        
                        <td><?php echo (isset($agama))? DirectSelectOptionsView('agama',$agama,$value['id'],$value['agama']) : '';?></td>
                        <td><?php echo (isset($statuskel))? DirectSelectOptionsView('status_keluarga',$statuskel,$value['id'],$value['status_keluarga']) : '';?></td>
                        <td><?php echo (isset($kawin))? DirectSelectOptionsView('status_perkawinan',$kawin,$value['id'],$value['status_perkawinan']) : '';?></td>
                        <td><?php echo (isset($kawin))? DirectSelectOptionsView('pendidikan_terakhir',$pendakhir,$value['id'],$value['pendidikan_terakhir']) : '';?></td>
                        <td>
                        <input type="text" id="<?php echo $value['id'];?>" name="pekerjaan" class="form-control auto-person-job <?php echo 'sc-jb-'.$value['id'];?>" value="<?php echo $pekerjaan;?>" /></td>
                        <!--<input type="checkbox" class="pegi">Pegawai Negeri -->
                    </tr>
                <?php }
            }
         ?>
    </tbody>
    </table>
<a href="<?php echo site_url('welcome/kk_step/2');?>" class="pull-left btn btn-lg btn-default"><i class="glyphicon glyphicon-chevron-left"></i> Sebelumnya</a>        
<a href="<?php echo site_url('welcome/kk_step/4');?>" class="pull-right btn btn-lg btn-success"><i class="glyphicon glyphicon-chevron-right"></i> Selanjutnya</a>