<?php use app\core\form\Form;?>
<?php $form = Form::begin('',"post") ?>
<?php echo $form->field($model,'email')?>
<?php echo $form->field($model,'pass')->passField()?>
<?php echo $form->field($model,'passConf')->passField()?>
<button type="submit" class="btn btn-primary">Create Account</button>
<?php Form::end()?>
