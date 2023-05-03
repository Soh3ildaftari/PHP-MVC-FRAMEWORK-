<?php ?>
<?php use app\core\form\Form;?>
 <?php $form = Form::begin('',"post") ?>
 <?php echo $form->inputField($model,'email')?>
<?php echo $form->inputField($model,'subject')?>
<?php echo $form->textArea($model,'message')?>
<button type="submit" class="btn btn-primary">Send</button>
<?php Form::end()?>