    <table class="table table-bordered">
    <thead>
        <tr>
            <td>Nama Lengkap</td>
            <td>Nomor KTP/Nopen</td>
            <td>Alamat Sebelumnya</td>
            <td>No. Passpor</td>
            <td>Tanggal berakhir paspor</td>
            <td>Aksi</td>
        </tr>
    </thead>
    <tbody>
        <tr>
        <?php if ($jmlkel < $personidentity->jml_anggota) : ?>
            <form action="<?php echo site_url('submit_person/new_member_family');?>" method="post">
            <td><input type="text" name="nama_lengkap" class="form-control" /></td>
            <td>
                <input type="text" class="form-control" name="NIK">
            </td>
            <td><textarea name="alamat" class="form-control"><?php echo (isset($personidentity))? $personidentity->alamat : '';?></textarea></td>
            <td><input type="number" name="passport_nomer" class="form-control" /></td>
            <td><input type="date" name="passport_tgl_terakhir" class="form-control tgl-step" /></td>
            <td>
                <button type="submit" class="btn btn-lg btn-primary"><i class="glyphicon glyphicon-plus"></i></button>
            </td>
            </form>
        <?php else:?>
            <td colspan="6">
                <h3 class="text-center txt-new-jml-kel">Data keluarga telah selesai dibuat, ingin mengganti jumlah anggota? <a href="#" class="link-new-jml-kel">Ya</a></h3>
                <div class="new-jml-kel" style="display:none;">
                    <strong class="pull-left" style="padding:10px;">Jumlah anggota keluarga</strong>
                    <div class="input-group pull-left" >
                        <input type="text" class="form-control" name="jml_anggota"/>
                        <input type="hidden" class="form-control" name="kepkel_id" value="<?php echo (isset($kepkel_id))? $kepkel_id : 0;?>" />
                        <span class="input-group-btn">
                            <button class="btn btn-default btn-new-jml-kel" type="button">simpan</button>
                        </span>
                    </div>
                </div>
            </td>
        <?php endif; ?>
        </tr>
        <?php
            if (isset($keluarga)) {
                foreach ($keluarga as $key => $value) { ?>
                    <tr>
                        <td><?php echo ($value['status_keluarga']==1)? $value['nama_lengkap'] : ReplaceNullValue($value['nama_lengkap'],'nama_lengkap',$value['id']);?></td>
                        <td><?php echo ReplaceNullValue($value['NIK'],'NIK',$value['id']);?></td>
                        <td><?php echo ReplaceNullValue($value['alamat'],'alamat',$value['id']);?></td>
                        <td><?php echo ReplaceNullValue($value['passport_nomer'],'passport_nomer',$value['id']);?></td>
                        <td><input type="date" name="passport_tgl_terakhir" id="<?php echo $value['id'];?>" class="form-control tgl-step" value="<?php echo $value['passport_tgl_terakhir'];?>"></td>
                        <td>
                            <?php if ($value['status_keluarga'] != 1):?>
                            <a href="<?php echo site_url('welcome/person_remove/'.encrypt_url($value['id']));?>" class="btn btn-sm btn-danger"><i class="glyphicon glyphicon-remove"></i></a>
                            <?php endif;?>
                        </td>
                    </tr>
                <?php }
            }
         ?>
    </tbody>
    </table>        
        <?php if ($jmlkel >= $personidentity->jml_anggota) : ?>
            <a href="<?php echo site_url('welcome/kk_step/2');?>" class="pull-right btn btn-lg btn-success">Selanjutnya</a>
        <?php endif;?>