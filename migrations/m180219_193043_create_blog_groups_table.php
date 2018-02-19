<?php

use yii\db\Migration;

/**
 * Handles the creation of table `blog_groups`.
 */
class m180219_193043_create_blog_groups_table extends Migration
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

        $this->createTable('blog_groups', [
            'id' => $this->primaryKey(),
			'blog_id' => $this->integer()->notNull(),
			'group_id' => $this->integer()->notNull(),
			'created_on' => $this->dateTime()->notNull()
	    ],$tableOptions);

		// add foreign key for table `user`
		$this->addForeignKey(
			'fk-blog_groups-blog_id',
			'blog_groups',
			'blog_id',
			'blog',
			'id',
			'CASCADE'
		);

		// add foreign key for table `user`
		$this->addForeignKey(
			'fk-blog_groups-group_id',
			'blog_groups',
			'group_id',
			'groups',
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
			'fk-blog_groups-blog_id',
			'blog_groups'
		);

		// drops foreign key for table `user`
		$this->dropForeignKey(
			'fk-blog_groups-group_id',
			'blog_groups'
		);

        $this->dropTable('blog_groups');
    }
}
