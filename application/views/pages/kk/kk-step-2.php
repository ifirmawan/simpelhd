<table class="table table-bordered">
    <thead>
        <tr>
            <th>Nama Lengkap</th>
            <th>Tempat Lahir</th>    
            <th>Tanggal/Bulan/Tahun/ lahir</th>
            <th>Umur</th>
            <th>No. Akte</th>
            <th>Golongan Darah</th>
        </tr>
    </thead>
    <tbody>
        <?php
            if (isset($keluarga)) {
                foreach ($keluarga as $key => $value) { ?>
                    <tr>
                        <td><?php echo $value['nama_lengkap'];?></td>
                        <td><textarea id="<?php echo $value['id'];?>" name="lahir_tempat" class="form-control submit-editable"><?php echo $value['lahir_tempat'];?></textarea></td>
                        <td><input type="date" id="<?php echo $value['id'];?>" name="lahir_tanggal" class="form-control tgl-step" value="<?php echo $value['lahir_tanggal'];?>" /></td>
                        <td><strong class="person-age">
                            <?php if (!is_null($value['lahir_tanggal'])) {
                                echo GetUmur($value['lahir_tanggal']);
                            }?> 
                            </strong></td>
                        <td><input type="number" id="<?php echo $value['id'];?>" name="lahir_no_akte" class="form-control submit-editable" value="<?php echo $value['lahir_no_akte'];?>" /></td>
                        <td>
                            <select name="goldar" id="<?php echo $value['id'];?>" class="op-step form-control">
                            <?php if (isset($goldar) && is_array($goldar)): 
                                foreach ($goldar as $k => $val) { ?>
                                    <option value="<?php echo $k;?>" <?php echo ($value['goldar'] == $k)? 'selected' : '';?>><?php echo $val;?></option>
                                <?php }?>
                                <?php else: ?>
                                    <option value="0">none</option>
                            <?php endif;?>
                            </select>
                        </td>
                    </tr>
                <?php }
            }
         ?>
    </tbody>
    </table>
            <a href="<?php echo site_url('welcome/kk_step/1');?>" class="pull-left btn btn-lg btn-default"><i class="glyphicon glyphicon-chevron-left"></i> Sebelumnya</a>        
            <a href="<?php echo site_url('welcome/kk_step/3');?>" class="pull-right btn btn-lg btn-success"><i class="glyphicon glyphicon-chevron-right"></i> Selanjutnya</a>