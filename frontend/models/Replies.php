<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "replies".
 *
 * @property int $id
 * @property string|null $registration_date
 * @property float|null $rate
 * @property string|null $text
 * @property int|null $user_id
 * @property int|null $task_id
 *
 * @property Users $user
 * @property Tasks $task
 */
class Replies extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return 'replies';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['registration_date'], 'safe'],
            [['rate'], 'number'],
            [['user_id', 'task_id'], 'integer'],
            [['text'], 'string', 'max' => 1024],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['task_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tasks::className(), 'targetAttribute' => ['task_id' => 'id']],
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
            'rate' => 'Rate',
            'text' => 'Text',
            'user_id' => 'User ID',
            'task_id' => 'Task ID',
        ];
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Users::className(), ['id' => 'user_id']);
    }

    /**
     * Gets query for [[Task]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTask()
    {
        return $this->hasOne(Tasks::className(), ['id' => 'task_id']);
    }
}
