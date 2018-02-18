<?php

use kartik\datetime\DateTimePicker;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Blog */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="blog-form">

    <?php $form = ActiveForm::begin(); ?>


    <?= $form->field($model, 'post_subject')->textInput(['maxlength' => true]) ?>

	<?php echo $form->field($model, 'post_body')->widget(\yii2mod\markdown\MarkdownEditor::class, [
		'editorOptions' => [
			'toolbar' => false,
		],
	]); ?>

    <?= $form->field($model, 'post_date')->widget(Datetimepicker::className(), ['options' => [
        'lang' => 'ru',
        'format' => 'Y-m-d H:i',
        'timepicker' => true,
        'value' => $model->post_date,
        'mask' => '9999-99-99 99:99',
    ]]); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
