<html>
<body>
    <h1>Create An Account</h1>
</body>
</html>
<?php use app\core\form\Form;?>
<?php $form = Form::begin('',"post") ?>
<?php echo $form->field($model,'email')?>
<?php echo $form->field($model,'password')->passField()?>
<?php echo $form->field($model,'passConf')->passField()?>
<div>
<button type="submit" class="btn btn-primary">Create Account</button><a href="/login">Already Have an Account?</a>
</div>
<?php Form::end()?>
