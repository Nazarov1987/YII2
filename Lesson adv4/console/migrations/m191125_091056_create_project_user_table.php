<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%project_user}}`.
 */
class m191125_091056_create_project_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('project_user', [
            'id' => $this->primaryKey(),
            'project_id' => $this->integer()->notNull(),
            'user_id' => $this->integer()->notNull(),
            'role' => $this->string(255)->notNull()->defaultValue('tester'),
        ]);
        $this->addForeignKey('fx_project_user_user', 'project_user', ['user_id'], 'user', ['id']);
        $this->addForeignKey('fx_project_user_project', 'project_user', ['project_id'], 'project', ['id']);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('project_user');
        $this->dropForeignKey('fx_project_user_user','project_user');
        $this->dropForeignKey('fx_project_user_project','project_user');
        return true;
    }

            //$sql = "ALTER TABLE project_user ALTER role SET DEFAULT 'tester'";
        //return $this->execute($sql);
}
