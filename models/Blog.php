<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "blog".
 *
 * @property integer $id
 * @property string $author_id
 * @property string $post_subject
 * @property string $post_preview
 * @property string $post_body
 * @property string $post_date
 */
class Blog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'blog';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['post_subject', 'post_body', 'post_date'], 'required'],
            [['post_body'], 'string'],
            [['post_date'], 'safe'],
            [['post_subject'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'author_id' => 'Author',
            'post_subject' => 'Subject',
            'post_body' => 'Post Body',
            'post_date' => 'Date',
        ];
    }
}
