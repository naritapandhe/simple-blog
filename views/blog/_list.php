<?php
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Markdown;
?>

<h3><a href="/blog/view?id=<?= $model->id ?>"><?= Html::encode($model->post_subject) ?></a></h3>

<h6>Author: <a href="/?author=<?= $model->author_id ?>"><?= $model->author_id ?></a> (<?= date('M j, Y, H:i', strtotime($model->post_date)) ?>)</h6>


<p><?= Markdown::process($model->post_body)?>
    <a href="/blog/view?id=<?= $model->id ?>"><b>Read more…</b></a></p>
