<?php

namespace common\models;

use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use lhs\Yii2SaveRelationsBehavior\SaveRelationsBehavior;
use Yii;

/**
 * This is the model class for table "project".
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property int $active
 * @property int $creator_id
 * @property int $updater_id
 * @property int $created_at
 * @property int $updated_at
 *
 * @property User $creator
 * @property User $updater
 *
 * @property Task[] $tasks
 * @property ProjectUser[] $users
 */

class Project extends \yii\db\ActiveRecord
{
    const STATUS_ACTIVE = 1;
    const STATUS_NOTACTIVE = 0;


    const STATUSES = [
    self::STATUS_NOTACTIVE,
    self::STATUS_ACTIVE,
];

const STATUSES_LABELS = [
    self::STATUS_NOTACTIVE => 'НеАктивный',
    self::STATUS_ACTIVE => 'Активный',
];

    const RELATION_PROJECT_TASKS = 'tasks';
    const RELATION_PROJECT_USERS = 'users';

    public function behaviors()
    {
        return [
            ['class' => TimestampBehavior::class,
            'createdAtAttribute' => 'created_at',
            'updatedAtAttribute' => 'updated_at'],
            ['class' => BlameableBehavior::class,
            'createdByAttribute' => 'creator_id',
            'updatedByAttribute' => 'updater_id',],
            'saveRelations' => [
                'class'     => SaveRelationsBehavior::class,
                'relations' => [
                    self::RELATION_PROJECT_USERS,
                ],
            ],
        ];
    }
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'project';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'description'], 'required'],
            [['description'], 'string'],
            [['active'], 'in', 'range' => self::STATUSES],
            [['title'], 'string', 'max' => 255],
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
            'title' => 'Название проекта',
            'description' => 'Описание проекта',
            'active' => 'Статус проекта',
            'creator_id' => 'ID создателя',
            'updater_id' => 'ID юзера',
            'created_at' => 'Дата создания',
            'updated_at' => 'Дата изменения',
        ];
    }

    //в Project модели с Task по полю project_id (один ко многим)
        /**
     * @return \yii\db\ActiveQuery
     */
    public function getTasks()
    {
        return $this->hasMany(Task::className(), ['project_id' => 'id']);
    }

        /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(ProjectUser::className(), ['project_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserRoles()
    {
        return $this->getUsers() -> select('role')->indexBy('user_id') -> column();
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
     * @return \common\models\query\ProjectQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\ProjectQuery(get_called_class());
    }
}
