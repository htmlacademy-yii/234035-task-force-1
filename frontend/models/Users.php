<?php

namespace frontend\models;

use Yii;
use yii\db\Query;

/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property string $registration_date
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string|null $address
 * @property string|null $birthday_date
 * @property string|null $info
 * @property string|null $avatar
 * @property float|null $rate
 * @property string|null $phone
 * @property string|null $skype
 * @property string|null $messenger
 * @property int|null $city_id
 * @property int|null $category_id
 *
 * @property Chats[] $chats
 * @property Chats[] $chats0
 * @property Opinions[] $opinions
 * @property Replies[] $replies
 * @property Tasks[] $tasks
 * @property Tasks[] $tasks0
 * @property Cities $city
 * @property Categories $category
 * @property UsersCategories[] $usersCategories
 */
class Users extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return 'users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['registration_date', 'name', 'email', 'password'], 'required'],
            [['registration_date', 'birthday_date'], 'safe'],
            [['rate'], 'number'],
            [['city_id', 'category_id'], 'integer'],
            [['name', 'avatar'], 'string', 'max' => 128],
            [['email', 'password', 'address', 'phone', 'skype', 'messenger'], 'string', 'max' => 64],
            [['info'], 'string', 'max' => 1024],
            [['city_id'], 'exist', 'skipOnError' => true, 'targetClass' => Cities::className(), 'targetAttribute' => ['city_id' => 'id']],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Categories::className(), 'targetAttribute' => ['category_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'registration_date' => 'Registration Date',
            'name' => 'Name',
            'email' => 'Email',
            'password' => 'Password',
            'address' => 'Address',
            'birthday_date' => 'Birthday Date',
            'info' => 'Info',
            'avatar' => 'Avatar',
            'rate' => 'Rate',
            'phone' => 'Phone',
            'skype' => 'Skype',
            'messenger' => 'Messenger',
            'city_id' => 'City ID',
            'category_id' => 'Category ID',
        ];
    }

    /**
     * Gets query for [[Chats]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getChats()
    {
        return $this->hasMany(Chats::className(), ['sender_id' => 'id']);
    }

    /**
     * Gets query for [[Chats0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getChats0()
    {
        return $this->hasMany(Chats::className(), ['recipient_id' => 'id']);
    }

    /**
     * Gets query for [[Opinions]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOpinions()
    {
        return $this->hasMany(Opinions::className(), ['user_id' => 'id']);
    }

    /**
     * Gets query for [[Replies]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getReplies()
    {
        return $this->hasMany(Replies::className(), ['user_id' => 'id']);
    }

    /**
     * Gets query for [[Tasks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTasks()
    {
        return $this->hasMany(Tasks::className(), ['executor_id' => 'id']);
    }

    /**
     * Gets query for [[Tasks0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTasks0()
    {
        return $this->hasMany(Tasks::className(), ['customer_id' => 'id']);
    }

    /**
     * Gets query for [[City]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCity()
    {
        return $this->hasOne(Cities::className(), ['id' => 'city_id']);
    }

    /**
     * Gets query for [[Category]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Categories::className(), ['id' => 'category_id']);
    }

    /**
     * Gets query for [[UsersCategories]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsersCategories()
    {
        return $this->hasMany(UsersCategories::className(), ['user_id' => 'id']);
    }

    public function getData()
    {
        $query = new Query();
        $data = $query->select([
            'users.id',
            'users.registration_date',
            'users.name',
            'users.info',
            'users.avatar',
            'users.rate'
        ])
            ->from('users')
            ->all();
        return $data;
    }
}
