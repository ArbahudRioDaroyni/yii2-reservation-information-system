<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "cleaning_order".
 *
 * @property int $id
 * @property string $code
 * @property int $cleaning_id
 * @property string $name
 * @property string $address
 * @property string $phone_number
 * @property string $note
 * @property string $start_at
 * @property int $customer_profile_id
 * @property string $created_at
 * @property string $updated_at
 */
class CleaningOrder extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cleaning_order';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cleaning_id', 'name', 'address', 'phone_number', 'note', 'start_at'], 'required'],
            [['customer_profile_id', 'code', 'start_at', 'created_at', 'updated_at'], 'safe'],
            [['cleaning_id', 'customer_profile_id'], 'integer'],
            [['code'], 'string', 'max' => 20],
            [['name'], 'string', 'max' => 100],
            [['address', 'note'], 'string', 'max' => 255],
            [['phone_number'], 'string', 'max' => 15],
            [['code'], 'unique'],
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
            'cleaning_id' => 'Cleaning ID',
            'name' => 'Name',
            'address' => 'Address',
            'phone_number' => 'Phone Number',
            'note' => 'Note',
            'start_at' => 'Starting At',
            'customer_profile_id' => 'Customer Profile ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCleaning()
    {
        return $this->hasOne(Cleaning::className(), ['id' => 'cleaning_id']);
    }

    public function generateCode()
    {
        $this->code = Yii::$app->security->generateRandomString(9) . '-' . time();
    }

    public function generateUserId()
    {
        $this->user_id = CustomerProfile::find(['user_id' => Yii::$app->user->id]);
    }

    public function order(CleaningOrder $model)
    {
        if (!$this->validate()) {
            return null;
        }

        $model->generateCode();
        $model->customer_profile_id = CustomerProfile::findCustomerProfileByIdUser();
        $model->save();
        Payment::generatePayment($model, 5);
        return $model;
        
    }

    public function apiOrder(CleaningOrder $model)
    {
        $model->generateCode();
        $model->save(false);
        $payment = Payment::generatePayment($model, 5);
        return $data = [
            'items' => [
                'order' => \yii\helpers\ArrayHelper::toArray($model),
                'payment' => \yii\helpers\ArrayHelper::toArray($payment)
            ]
        ];
        
    }
}
