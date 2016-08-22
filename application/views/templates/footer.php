<!-- page end-->
          </section>
      </section>
<?php if (isset($personidentity)) : ?>
<i class="val-op-step">op-step</i>
<?php endif;?>
<span class="url_act" style="display:none;"><?php echo site_url();?></span>
      <!--main content end-->
<?php if (isset($ResourceJS)) {
    foreach ($ResourceJS as $key => $value) { ?>
        <script src="<?php echo base_url().'assets/'.$value;?>"></script>
    <?php }
}?>


  </body>
</html>