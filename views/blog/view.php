<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Markdown;


/* @var $this yii\web\View */
/* @var $model app\models\Blog */

$this->title = $model->post_subject;
$this->params['breadcrumbs'][] = ['label' => 'Blog', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="blog-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php if ($model->author_id == Yii::$app->user->id){ ?>
        <p>
            <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Delete', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ]) ?>
        </p>
    <?php }?>

    <?= DetailView::widget([
		'model' => $model,
		'attributes' => [
			[
				'label' => 'Contents',
				'value' => Markdown::process($model->post_body),
                'format' => 'raw',
			],
			[
				'label' => 'Date',
				'value' => $model->post_date,
        	],
		],

    ]) ?>

</div>
