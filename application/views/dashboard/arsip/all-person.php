<div class="adv-table editable-table ">

<div class="space15"></div>
<table class="table table-striped table-hover table-bordered" >
<thead>
<tr>
    <th>NIK</th>
    <th>Nama Lengkap</th>
    <th>Status Keluarga</th>
    <th>Jenis Kelamin</th>
    <th>Status Perkawinan</th>
    <td>Pilihan</td>

</tr>
</thead>
<tbody>
<?php if (isset($all)) {
  foreach ($all as $key => $value) { ?>
<tr>
    <td><?php echo $value['NIK'];?></td>
    <td><?php echo $value['nama_lengkap'];?></td>
    <td><?php 
    
    echo (is_null($value['status_keluarga']) || empty($value['status_keluarga']))? '<i class="label label-danger">none</i>' : GetStatusKel($value['status_keluarga']);?></td>
    <td><?php echo (is_null($value['jenis_kelamin']) || empty($value['jenis_kelamin']))? '<i class="label label-danger">none</i>' : GetGender($value['jenis_kelamin']);?></td>
    <td><?php echo (is_null($value['status_perkawinan']) || empty($value['status_perkawinan']))? '<i class="label label-danger">none</i>' : get_sts_kawin($value['status_perkawinan']);?></td>
    <td>
<div class="btn-group">
  <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
    Aksi <span class="caret"></span>
  </button>
  <ul class="dropdown-menu" role="menu">
    <li><a href="#">Ubah</a></li>
    <li><a href="#">Hapus</a></li>
    <li class="divider"></li>
    <li><a href="#">Lihat PDF</a></li>
  </ul>
</div>
    </td>
</tr>
  <?php }
}?>

</tbody>
</table>
</div>
                      