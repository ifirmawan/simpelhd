<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel"><? echo (isset($modal['title']))? $modal['title'] : ''; ?></h4>
      </div>
      <div class="modal-body">
        <?php echo (isset($modal['content']))? $modal['content'] : '';?>
      </div>
      <div class="modal-footer">
        <?php echo (isset($modal['footer']))? $modal['footer'] : '';?>
      </div>
    </div>
  </div>
</div>