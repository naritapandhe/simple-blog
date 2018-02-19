<?php

use yii\db\Migration;

/**
 * Handles the creation of table `groups`.
 */
class m180219_193020_create_groups_table extends Migration
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

		$this->createTable('groups', [
            'id' => $this->primaryKey(),
			'group_name' => $this->string(255)->notNull(),
			'group_created_on' => $this->dateTime()->notNull(),
			'group_created_by' => $this->integer()->notNull(),
			'group_members_limit' => $this->integer()->defaultValue(32767),
			'group_admin_id' => $this->integer()->notNull()
        ],$tableOptions);

		$this->createIndex('idx_group_name', '{{%groups}}', 'group_name');

		// add foreign key for table `user`
		$this->addForeignKey(
			'fk-groups-created_by_id',
			'groups',
			'group_created_by',
			'user',
			'id',
			'CASCADE'
		);

		// add foreign key for table `user`
		$this->addForeignKey(
			'fk-groups-created_admin',
			'groups',
			'group_admin_id',
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
			'fk-groups-created_by_id',
			'groups'
		);

		// drops foreign key for table `user`
		$this->dropForeignKey(
			'fk-groups-created_admin',
			'groups'
		);


		// drops index for column `author_id`
		$this->dropIndex(
			'idx_group_name',
			'groups'
		);


		$this->dropTable('groups');
    }
}
