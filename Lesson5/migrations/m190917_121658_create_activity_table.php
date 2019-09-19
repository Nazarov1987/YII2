<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%activity}}`.
 */
class m190917_121658_create_activity_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('event-tb2', [
            'id_event_fd' => $this->primaryKey(),
            'title_fd' => $this->string()->notNull(), 
            'day_start_fd' => $this->date(),
            'day_end_fd' => $this->date(),
            'user_id_fd' => $this->integer(),
            'description' => $this->text(),
            'repeat_fd' => $this->boolean(),
            'blocked_fd' => $this->boolean(),
            //'attachments' => '', реляционная связь
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('event-tb2');
    }
}
