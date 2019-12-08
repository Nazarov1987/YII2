<?php
namespace common\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use mohorev\file\UploadImageBehavior;
/**
 * User model
 *
 * @property integer $id
 * @property string $username
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $verification_token
 * @property string $email
 * @property string $auth_key
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $password write-only password
 *
 * @mixin UploadImageBehavior
 *
 * @property Task[] $activedTasks
 * @property Task[] $createdTasks
 * @property Task[] $updatedTasks
 * @property Project[] $createdProjects
 * @property Project[] $updatedProjects
 * @property Project[] $projects
*/
class User extends ActiveRecord implements IdentityInterface
{

    private $password;
    const STATUS_DELETED = 0;
    const STATUS_INACTIVE = 9;
    const STATUS_ACTIVE = 10;

    const STATUSES = [
    self::STATUS_DELETED,
    self::STATUS_INACTIVE,
    self::STATUS_ACTIVE,
];

const STATUSES_LABELS = [
    self::STATUS_DELETED => 'Удален',
    self::STATUS_INACTIVE => 'НеАктивный',
    self::STATUS_ACTIVE => 'Активный',
];

    const AVATAR_PREVIEW = 'preview';
    const AVATAR_ICO = 'ico';

    const SCENARIO_UPDATE = 'update';
    const SCENARIO_INSERT = 'insert';

    const RELATION_ACTIVED_TASKS = 'activedTasks';
    const RELATION_CREATED_TASKS = 'createdTasks';
    const RELATION_UPDATED_TASKS = 'updatedTasks';
    const RELATION_CREATED_PROJECTS = 'createdProjects';
    const RELATION_UPDATED_PROJECTS = 'updatedProjects';
    const RELATION_PROJECTS = 'projects';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            ['class' => TimestampBehavior::class,
            'createdAtAttribute' => 'created_at',
            'updatedAtAttribute' => 'updated_at'],
            [
                'class' => UploadImageBehavior::class,
                //имя файла с аватаром
                'attribute' => 'avatar',
                //сценарий загрузки
                'scenarios' => [self::SCENARIO_UPDATE],
                //'placeholder' => '@app/modules/user/assets/images/userpic.jpg',
                //путь к месту загрузки аватара
                'path' => '@frontend/web/upload/user/{id}',
                //url доступа к аватару
                'url' => Yii::$app->params['hosts.front'] .
                Yii::getAlias('@web/upload/user/{id}'),
                'thumbs' => [
                    self::AVATAR_ICO => ['width' => 30, 'height' => 30, 'quality' => 90],
                    self::AVATAR_PREVIEW => ['width' => 200, 'height' => 200],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'email'], 'required'],
            [['username', 'email', 'password'], 'safe'],
            ['status', 'default', 'value' => self::STATUS_INACTIVE],
            ['status', 'in', 'range' => self::STATUSES],
            ['avatar', 'image', 'extensions' => 'jpg, jpeg, gif, png', 'on' => [self::SCENARIO_UPDATE]],
        ];
    }

        /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Пользователь',
            'status' => 'Статус',
            'email' => 'EMAIL',
            'password' => 'Пароль',
            'created_at' => 'Дата регистрации',
        ];
    }

//getActivedTasks (задачи связанные по executor_id)
        /**
     * @return \yii\db\ActiveQuery
     */
    public function getActivedTasks()
    {
        return $this->hasMany(Task::className(), ['executor_id' => 'id']);
    }

//getCreatedTasks (задачи связанные по creator_id)
        /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedTasks()
    {
        return $this->hasMany(Task::className(), ['creator_id' => 'id']);
    }

    //getUpdatedTasks (задачи связанные по updater_id)
        /**
     * @return \yii\db\ActiveQuery
     */
    public function getUpdatedTasks()
    {
        return $this->hasMany(Task::className(), ['updater_id' => 'id']);
    }

    //getCreatedProjects (проекты связанные по creator_id)
        /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedProjects()
    {
        return $this->hasMany(Project::className(), ['creator_id' => 'id']);
    }

    //getUpdatedProjects (проекты связанные по updater_id)
        /**
     * @return \yii\db\ActiveQuery
     */
    public function getUpdatedProjects()
    {
        return $this->hasMany(Project::className(), ['updater_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

            /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjects()
    {
        return $this->hasMany(Project::className(), ['id' => 'id']);
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Finds user by verification email token
     *
     * @param string $token verify email token
     * @return static|null
     */
    public static function findByVerificationToken($token) {
        return static::findOne([
            'verification_token' => $token,
            'status' => self::STATUS_INACTIVE
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return bool
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
        if ($password){
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
        }
    }

        /**
     * {@inheritdoc}
     */
    public function getPassword()
    {
        $this->password;
    }

    public function beforeSave($insert)
    {
        if (!parent::beforeSave($insert)) {
            return false;
        }
        if ($insert) {
            $this->generateAuthKey();
        }
        return true;
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    public function generateEmailVerificationToken()
    {
        $this->verification_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }
}