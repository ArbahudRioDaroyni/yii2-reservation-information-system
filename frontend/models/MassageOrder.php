<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "massage_order".
 *
 * @property int $id
 * @property string $code
 * @property int $massage_id
 * @property string $name
 * @property string $address
 * @property string $phone_number
 * @property string $email
 * @property string $start_at
 * @property int $customer_profile_id
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Massage $massage
 * @property CustomerProfile $customerProfile
 */
class MassageOrder extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'massage_order';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['massage_id', 'name', 'address', 'phone_number', 'email', 'start_at'], 'required'],
            [['massage_id', 'customer_profile_id'], 'integer'],
            [['code', 'start_at', 'customer_profile_id', 'created_at', 'updated_at'], 'safe'],
            [['code'], 'string', 'max' => 20],
            [['name', 'email'], 'string', 'max' => 100],
            [['address'], 'string', 'max' => 255],
            [['phone_number'], 'string', 'max' => 15],
            [['massage_id'], 'exist', 'skipOnError' => true, 'targetClass' => Massage::className(), 'targetAttribute' => ['massage_id' => 'id']],
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
            'massage_id' => 'Massage ID',
            'name' => 'Name',
            'address' => 'Address',
            'phone_number' => 'Phone Number',
            'email' => 'Email',
            'start_at' => 'Start At',
            'customer_profile_id' => 'Customer Profile ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMassage()
    {
        return $this->hasOne(Massage::className(), ['id' => 'massage_id']);
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

    public function order(MassageOrder $model)
    {
        if (!$this->validate()) {
            return null;
        }

        $model->generateCode();
        $model->customer_profile_id = CustomerProfile::findCustomerProfileByIdUser();
        $model->save();
        Payment::generatePayment($model, 2);
        return $model;    
    }

    public function apiOrder(MassageOrder $model)
    {
        $model->generateCode();
        $model->save(false);
        $payment = Payment::generatePayment($model, 2);
        return $data = [
            'items' => [
                'order' => \yii\helpers\ArrayHelper::toArray($model),
                'payment' => \yii\helpers\ArrayHelper::toArray($payment)
            ]
        ];
    }
}
