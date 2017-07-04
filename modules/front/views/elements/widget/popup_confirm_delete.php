<div class="modal fade" id="confirm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><?= $title ?></h4>
      </div>
      <div class="modal-body">
        <?= Yii::t('app','Are you sure you want to delete this item?') ?>
      </div>
      <div class="modal-footer">
        <button type="button" data-dismiss="modal" class="btn btn-danger" id="delete"><?= Yii::t('app','Delete') ?></button>
        <button type="button" data-dismiss="modal" class="btn btn-default"><?= Yii::t('app','Cancel') ?></button>
      </div>
    </div>
  </div>
</div> 