<html>
<body>
    <h1>Sign in to your Account</h1>
</body>
</html>
<?php use app\core\form\Form;?>
 <?php $form = Form::begin('',"post") ?>
 <?php echo $form->field($model,'email')?>
<?php echo $form->field($model,'password')->passField()?>
<button type="submit" class="btn btn-primary">Sign in</button>
  <a href="/register">Have no Account?</a>
  <?php Form::end()?>