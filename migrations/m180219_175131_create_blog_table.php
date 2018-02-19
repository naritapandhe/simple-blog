<?php

use yii\db\Migration;

/**
 * Handles the creation of table `blog`.
 */
class m180219_175131_create_blog_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
		$tableOptions = '';
		if (Yii::$app->db->getDriverName() == 'mysql') {
			$tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
		}

		$this->createTable('blog', [
            'id' => $this->primaryKey(),
			'author_id' => $this->integer()->notNull(),
			'post_subject'     => $this->string(255)->notNull(),
			'post_body'        => $this->text()->notNull(),
			'post_date'        => $this->dateTime()->notNull(),

		],$tableOptions);

		$this->createIndex('idx_author', '{{%blog}}', 'author_id');
		$this->createIndex('idx_post_subject', '{{%blog}}', 'post_subject');

		// add foreign key for table `user`
		$this->addForeignKey(
			'fk-post-author_id',
			'blog',
			'author_id',
			'user',
			'id',
			'CASCADE'
		);
    }


    /**
     * @inheritdoc
     */
    public function down()
    {
		// drops foreign key for table `user`
		$this->dropForeignKey(
			'fk-post-author_id',
			'blog'
		);

		// drops index for column `author_id`
		$this->dropIndex(
			'idx_author',
			'blog'
		);

		// drops index for column `post_subject`
		$this->dropIndex(
			'idx_post_subject',
			'blog'
		);

        $this->dropTable('blog');
    }
}
