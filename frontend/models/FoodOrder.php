<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "food_order".
 *
 * @property int $id
 * @property string $code
 * @property int $food_id
 * @property int $total_calculation
 * @property string $name
 * @property string $phone_number
 * @property string $delivery_address
 * @property int $customer_profile_id
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Food $food
 * @property CustomerProfile $customerProfile
 */
class FoodOrder extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'food_order';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['food_id', 'total_calculation', 'name', 'phone_number', 'delivery_address'], 'required'],
            [['food_id', 'total_calculation', 'customer_profile_id'], 'integer'],
            [['code', 'created_at', 'updated_at', 'customer_profile_id'], 'safe'],
            [['code'], 'string', 'max' => 20],
            [['name'], 'string', 'max' => 100],
            [['phone_number'], 'string', 'max' => 15],
            [['delivery_address'], 'string', 'max' => 255],
            [['code'], 'unique'],
            [['food_id'], 'exist', 'skipOnError' => true, 'targetClass' => Food::className(), 'targetAttribute' => ['food_id' => 'id']],
            [['customer_profile_id'], 'exist', 'skipOnError' => true, 'targetClass' => CustomerProfile::className(), 'targetAttribute' => ['customer_profile_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'code' => 'Code',
            'food_id' => 'Food ID',
            'total_calculation' => 'Total Calculation',
            'name' => 'Name',
            'phone_number' => 'Phone Number',
            'delivery_address' => 'Delivery Address',
            'customer_profile_id' => 'Customer Profile ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFood()
    {
        return $this->hasOne(Food::className(), ['id' => 'food_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomerProfile()
    {
        return $this->hasOne(CustomerProfile::className(), ['id' => 'customer_profile_id']);
    }

    public function generateCode()
    {
        $this->code = Yii::$app->security->generateRandomString(9) . '-' . time();
    }

    public function generateUserId()
    {
        $this->user_id = CustomerProfile::find(['user_id' => Yii::$app->user->id]);
    }

    public function order(FoodOrder $model)
    {
        if (!$this->validate()) {
            return null;
        }

        $model->generateCode();
        $model->customer_profile_id = CustomerProfile::findCustomerProfileByIdUser();
        $model->save();
        Payment::generatePayment($model, 3);
        return true;   
    }

    public function apiOrder(FoodOrder $model)
    {
        $model->generateCode();
        $model->save(false);
        $payment = Payment::generatePayment($model, 3);
        return $data = [
            'items' => [
                'order' => \yii\helpers\ArrayHelper::toArray($model),
                'payment' => \yii\helpers\ArrayHelper::toArray($payment)
            ]
        ];
    }
}
