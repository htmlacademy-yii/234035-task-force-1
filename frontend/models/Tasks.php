<?php

namespace frontend\models;

use Yii;
use yii\db\Query;

/**
 * This is the model class for table "tasks".
 *
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property float $budget
 * @property string $registration_date
 * @property string|null $execution_date
 * @property string|null $finish_date
 * @property int|null $city_id
 * @property int|null $category_id
 * @property int|null $executor_id
 * @property int|null $customer_id
 * @property int|null $status_id
 *
 * @property Files[] $files
 * @property Opinions[] $opinions
 * @property Replies[] $replies
 * @property Cities $city
 * @property Categories $category
 * @property Users $executor
 * @property Users $customer
 * @property Statuses $status
 */
class Tasks extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return 'tasks';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['name', 'budget', 'registration_date'], 'required'],
            [['budget'], 'number'],
            [['registration_date', 'execution_date', 'finish_date'], 'safe'],
            [['city_id', 'category_id', 'executor_id', 'customer_id', 'status_id'], 'integer'],
            [['name'], 'string', 'max' => 128],
            [['description'], 'string', 'max' => 512],
            [['city_id'], 'exist', 'skipOnError' => true, 'targetClass' => Cities::className(), 'targetAttribute' => ['city_id' => 'id']],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Categories::className(), 'targetAttribute' => ['category_id' => 'id']],
            [['executor_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['executor_id' => 'id']],
            [['customer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['customer_id' => 'id']],
            [['status_id'], 'exist', 'skipOnError' => true, 'targetClass' => Statuses::className(), 'targetAttribute' => ['status_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'description' => 'Description',
            'budget' => 'Budget',
            'registration_date' => 'Registration Date',
            'execution_date' => 'Execution Date',
            'finish_date' => 'Finish Date',
            'city_id' => 'City ID',
            'category_id' => 'Category ID',
            'executor_id' => 'Executor ID',
            'customer_id' => 'Customer ID',
            'status_id' => 'Status ID',
        ];
    }

    /**
     * Gets query for [[Files]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFiles()
    {
        return $this->hasMany(Files::className(), ['task_id' => 'id']);
    }

    /**
     * Gets query for [[Opinions]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOpinions()
    {
        return $this->hasMany(Opinions::className(), ['task_id' => 'id']);
    }

    /**
     * Gets query for [[Replies]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getReplies()
    {
        return $this->hasMany(Replies::className(), ['task_id' => 'id']);
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
     * Gets query for [[Executor]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getExecutor()
    {
        return $this->hasOne(Users::className(), ['id' => 'executor_id']);
    }

    /**
     * Gets query for [[Customer]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCustomer()
    {
        return $this->hasOne(Users::className(), ['id' => 'customer_id']);
    }

    /**
     * Gets query for [[Status]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStatus()
    {
        return $this->hasOne(Statuses::className(), ['id' => 'status_id']);
    }

    public function getData()
    {
        $query = new Query();
        $data = $query->select([
            'tasks.id',
            'tasks.name',
            'tasks.description',
            'tasks.budget',
            'tasks.registration_date',
            'tasks.execution_date',
            'tasks.finish_date',
            'cities.city as city',
            'categories.name as category',
            'categories.icon as icon',
            'tasks.executor_id',
            'tasks.customer_id',
            'tasks.status_id'
        ])
            ->from('tasks')
            ->join('INNER JOIN', 'cities', 'tasks.city_id = cities.id')
            ->join('INNER JOIN','categories', 'tasks.category_id = categories.id')
            ->join('INNER JOIN','statuses','tasks.status_id = statuses.id')
            ->where(['statuses.name' => 'new'])
            ->orderBy(['registration_date' => SORT_DESC])->all();

        foreach ($data as &$task) {
            $task['registration_date'] = date('H:i:s d.m.Y', strtotime($task['registration_date']));
        }

        return $data;
    }
}
