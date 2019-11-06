<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user}}`.
 */
class m191030_142734_create_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('user', [
            'id' => $this->primaryKey(),
            'username' => $this->string(255)->notNull(),
            'name' => $this->string(255)->notNull(),
            'password_hash' => $this->string(255)->notNull(),
            'access_token' => $this->string(255),
            'auth_key' => $this->string(255),
            'creator_id' => $this->integer(),
            'updater_id' => $this->integer(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('user');
        return true;
    }
}
