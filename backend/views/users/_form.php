<?php
    
    use yii\helpers\Html;
    use yii\widgets\ActiveForm;
    use \yii\jui\DatePicker;
    
    /* @var $this yii\web\View */
    /* @var $model backend\models\Users */
    /* @var $form yii\widgets\ActiveForm */
?>
<div class="users-form">
    <?php $form = ActiveForm ::begin([
          'options' => [
                'enctype' => 'multipart/form-data',
                'class'   => 'users_form',
          ],
    ]); ?>
    
    <?= $form -> field($model, 'login') -> textInput(['maxlength' => true]) ?>
    
    <?= $form -> field($model, 'password') -> passwordInput(['maxlength' => true]) ?>
    
    <?= $form -> field($model, 'email') -> input('email', ['maxlength' => true]) ?>
    
    <?= $form -> field($model, 'group_id') -> dropDownList($groups_list); ?>
    
    <?= $form -> field($model, 'upload_file') -> fileInput() -> label('Photo') ?>
    
   <div class="form-group">
       <?= Html ::submitButton('Save', ['class' => 'btn btn-success']) ?>
   </div>
    <?php ActiveForm ::end(); ?>
</div>

