<?php

namespace common\models;

use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use Yii;

/**
 * This is the model class for table "task".
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property int $project_id
 * @property  int $executor_id
 * @property int $started_at
 * @property int $completed_at
 * @property int $creator_id
 * @property int $updater_id
 * @property int $created_at
 * @property int $updated_at
 *
 * @property User $executor
 * @property User $creator
 * @property User $updater
 *
 * @property Project[] $projects
 */
class Task extends \yii\db\ActiveRecord
{
    const RELATION_TASK_PROJECTS = 'projects';

    public function behaviors()
    {
        return [
            ['class' => TimestampBehavior::class,
            'createdAtAttribute' => 'created_at',
            'updatedAtAttribute' => 'updated_at'],
            ['class' => BlameableBehavior::class,
            'createdByAttribute' => 'creator_id',
            'updatedByAttribute' => 'updater_id',]
        ];
    }
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'task';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'description'], 'required'],
            [['description'], 'string'],
            ['completed_at','default', 'value' => function () {
                return $this->started_at;
            }],
            [['project_id', 'executor_id', 'creator_id', 'updater_id', 'created_at', 'updated_at', 'started_at', 'completed_at'], 'integer'],
            [['title'], 'string', 'max' => 255],
            [['executor_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['executor_id' => 'id']],
            [['creator_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['creator_id' => 'id']],
            [['updater_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['updater_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Название задачи',
            'description' => 'Описание задачи',
            'project_id' => 'ID проекта',
            'executor_id' => 'ID исполнителя',
            'started_at' => 'Дата начала',
            'completed_at' => 'Дата завершения',
            'creator_id' => 'ID создателя',
            'updater_id' => 'ID юзера',
            'created_at' => 'Дата создания',
            'updated_at' => 'Дата изменения',
        ];
    }

        //в Task с Project по project_id (многие к одному)
        /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjects()
    {
        return $this->hasMany(Project::className(), ['id' => 'project_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExecutor()
    {
        return $this->hasOne(User::className(), ['id' => 'executor_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreator()
    {
        return $this->hasOne(User::className(), ['id' => 'creator_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUpdater()
    {
        return $this->hasOne(User::className(), ['id' => 'updater_id']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\TaskQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\TaskQuery(get_called_class());
    }
}
