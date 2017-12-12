<?php

class m170213_164836_create_user_table extends CDbMigration
{
	public function up()
    {
        $this->createTable('user', array(
            'id' => 'pk',
            'username' => 'string NOT NULL',
            'password' => 'string NOT NULL',
            'role' => 'integer NOT NULL',
        ));

        $this->insert('user', array(
            'username' => 'admin',
            'password' => md5('admin'),
            'role' => 2,
        ));
        $this->insert('user', array(
            'username' => 'user',
            'password' => md5('user'),
            'role' => 1,
        ));
    }

    public function down()
    {
        $this->dropTable('user');
    }

	/*
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	}

	public function safeDown()
	{
	}
	*/
}