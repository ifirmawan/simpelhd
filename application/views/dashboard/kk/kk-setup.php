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
            <?php if (isset($fields)) {
            unset($labels[0]);
            foreach ($fields as $key => $value) {?>
                    <label><?php echo (isset($labels[$key]))? $labels[$key] : 'none';?></label>
                <?php 
                switch ($value) {
                    case 'alamat': ?>
                    <textarea name="<?php echo $value;?>" class="form-control" rows="3"><?php echo (isset($details[$value]))? $details[$value] : ''; ?></textarea>    
                    <?php    break;
                    default: ?>
                    <input type="text" name="<?php echo $value;?>" class="form-control" value="<?php echo (isset($details[$value]))? $details[$value] : ''; ?>"/>
                    <?php break;
                }
             }
            }?>
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

