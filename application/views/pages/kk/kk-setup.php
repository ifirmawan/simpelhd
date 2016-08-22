<div class="row">
    <div class="col-lg-12">
    <section class="panel">
    <header class="panel-heading">Data Kepala Keluarga </header>
    <div class="panel-body">
    <?php 
    if (!is_null($errors)) { ?>
        <div class="alert alert-warning">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <?php echo $errors;?></div>
    <?php }?>
    <form action="<?php echo site_url($action);?>" method="post">
     <div class="col-md-6 col-xs-12">
            <div class="form-group">
                <label>Nama Kepala Keluarga</label>
                <input type="text" name="nama" class="form-control" />
            </div>
            <div class="form-group">
                <label>Jumlah Anggota Keluarga</label>
                <input type="number" name="jml_anggota" class="form-control" />
            </div>
            <div class="form-group">
                <label>No. Telephone (Aktif)</label>
                <input type="number" name="telp" class="form-control" />
            </div>
        </div>
        <div class="col-md-6 col-xs-12">
            <div class="form-group">
                <label>Alamat</label>
                <textarea class="form-control" name="alamat"></textarea>
            </div>
            <div class="form-group">
                <label>Kode Pos</label>
                <input type="number" name="kodepos" class="form-control" />
            </div>
            <div class="row">
                <div class="col-md-3 col-xs-12">
                    <div class="form-group">
                        <label>No. RT</label>
                        <input type="number" name="rt" class="form-control" />
                    </div>
                </div>
                 <div class="col-md-9 col-xs-12">
                    <div class="form-group">
                        <label>Nama Ketua RT</label>
                        <input type="text" name="rt_nama_ketua" class="form-control" />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 col-xs-12">
                    <div class="form-group">
                        <label>No. RW</label>
                        <input type="number" name="rw" class="form-control" />
                    </div>
                </div>
                 <div class="col-md-9 col-xs-12">
                    <div class="form-group">
                        <label>Nama Ketua RW</label>
                        <input type="text" name="rw_nama_ketua" class="form-control" />
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 ">
                <div class="pull-right">
                    <?php echo (isset($id))? '<input type="hidden" name="id" value="'.$id.'" />' : '';?>
                    <button type="submit" class="btn btn-lg btn-primary">Selanjutnya</button>        
                </div>
            </div>
        </div>
    </form>
    </div>
    </section>
    </div>
</div>

