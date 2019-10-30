<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "towing_order".
 *
 * @property int $id
 * @property string $code
 * @property int $towing_id
 * @property string $name
 * @property string $phone_number
 * @property string $pickup
 * @property string $destination
 * @property string $note
 * @property int $customer_profile_id
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Towing $towing
 * @property CustomerProfile $customerProfile
 */
class TowingOrder extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'towing_order';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['towing_id', 'name', 'phone_number', 'pickup', 'destination', 'note'], 'required'],
            [['code', 'customer_profile_id','start_at', 'created_at', 'updated_at'], 'safe'],
            [['towing_id', 'customer_profile_id'], 'integer'],
            [['code'], 'string', 'max' => 20],
            [['name'], 'string', 'max' => 100],
            [['phone_number'], 'string', 'max' => 15],
            [['pickup', 'destination', 'note'], 'string', 'max' => 255],
            [['code'], 'unique'],
            [['towing_id'], 'exist', 'skipOnError' => true, 'targetClass' => Towing::className(), 'targetAttribute' => ['towing_id' => 'id']],
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
            'towing_id' => 'Towing ID',
            'name' => 'Name',
            'phone_number' => 'Phone Number',
            'pickup' => 'Pickup',
            'destination' => 'Destination',
            'note' => 'Note',
            'customer_profile_id' => 'Customer Profile ID',
            'start_at' => 'Start At',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTowing()
    {
        return $this->hasOne(Towing::className(), ['id' => 'towing_id']);
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

    public function order(TowingOrder $model)
    {
        if (!$this->validate()) {
            return null;
        }

        $model->generateCode();
        $model->customer_profile_id = CustomerProfile::findCustomerProfileByIdUser();
        $model->save();
        Payment::generatePayment($model, 4);
        return $model;
        
    }

    public function apiOrder(TowingOrder $model)
    {
        $model->generateCode();
        $model->save(false);
        $payment = Payment::generatePayment($model, 4);
        return $data = [
            'items' => [
                'order' => \yii\helpers\ArrayHelper::toArray($model),
                'payment' => \yii\helpers\ArrayHelper::toArray($payment)
            ]
        ];
        
    }
}
