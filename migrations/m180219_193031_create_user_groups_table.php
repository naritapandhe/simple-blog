<?php

use yii\db\Migration;

/**
 * Handles the creation of table `user_groups`.
 */
class m180219_193031_create_user_groups_table extends Migration
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

        $this->createTable('user_groups', [
            'id' => $this->primaryKey(),
			'user_id' => $this->integer()->notNull(),
			'group_id' => $this->integer()->notNull(),
			'group_joined_on' => $this->dateTime()->notNull(),
			'group_left_on' => $this->dateTime()->defaultValue(null),
			'group_membership_approved_by' => $this->integer()->notNull()

        ],$tableOptions);

		// add foreign key for table `user`
		$this->addForeignKey(
			'fk-user_groups-user_id',
			'user_groups',
			'user_id',
			'user',
			'id',
			'CASCADE'
		);

		// add foreign key for table `user`
		$this->addForeignKey(
			'fk-user_groups-group_id',
			'user_groups',
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
			'fk-user_groups-user_id',
			'user_groups'
		);

		// drops foreign key for table `user`
		$this->dropForeignKey(
			'fk-user_groups-group_id',
			'user_groups'
		);

        $this->dropTable('user_groups');
    }
}
