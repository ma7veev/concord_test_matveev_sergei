<?php
    
    use yii\helpers\Html;
    use yii\widgets\DetailView;
    use backend\models\Users;
    
    /* @var $this yii\web\View */
    /* @var $model backend\models\Users */
    $this -> title = $model -> id;
    $this -> params[ 'breadcrumbs' ][] = ['label' => 'Users', 'url' => ['index']];
    $this -> params[ 'breadcrumbs' ][] = $this -> title;
    \yii\web\YiiAsset ::register($this);
?>
<div class="users-view">
   <h1><?= Html ::encode($this -> title) ?></h1>
   <p>
       <?= Html ::a('Update',
             ['update', 'id' => $model -> id],
             ['class' => 'btn btn-primary']) ?>
       <?= Html ::a('Delete',
             ['delete', 'id' => $model -> id],
             [
                   'class' => 'btn btn-danger',
                   'data'  => [
                         'confirm' => 'Are you sure you want to delete this item?',
                         'method'  => 'post',
                   ],
             ]) ?>
   </p>
    <?= DetailView ::widget([
          'model' => $model,
          'attributes' => [
                'id',
                'login',
                'password',
                'email:email',
                'group_id',
                [
                      'attribute' => 'photo',
                      'format'    => 'raw',
                      'value'     => function ($model) {
                          /* @var \common\models\mailing\Sms $model */
                          return Html ::img('/'.Users::PHOTO_PATH.$model -> photo,
                                ['alt' => 'Наш логотип', 'style' => 'max-width:150px;']);
                      },
                ],
                'created_at',
                'updated_at',
          ],
    ]) ?>
</div>
