<?php

use yii\db\Migration;

/**
 * Handles the creation of table `blog_reads`.
 */
class m180219_193053_create_blog_reads_table extends Migration
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


		$this->createTable('blog_reads', [
            'id' => $this->primaryKey(),
			'blog_id' => $this->integer()->notNull(),
			'user_id' => $this->integer()->notNull(),
			'blog_read_on' => $this->dateTime()->notNull(),
			'last_accessed' => $this->dateTime()->notNull()
        ],$tableOptions);

		// add foreign key for table `user`
		$this->addForeignKey(
			'fk-blog_reads-blog_id',
			'blog_reads',
			'blog_id',
			'blog',
			'id',
			'CASCADE'
		);

		// add foreign key for table `user`
		$this->addForeignKey(
			'fk-blog_reads-user_id',
			'blog_reads',
			'user_id',
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
			'fk-blog_reads-blog_id',
			'blog_reads'
		);

		// drops index for column `author_id`
		$this->dropIndex(
			'fk-blog_reads-user_id',
			'blog_reads'
		);

		$this->dropTable('blog_reads');
    }
}
