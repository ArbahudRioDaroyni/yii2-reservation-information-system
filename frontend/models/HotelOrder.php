<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "hotel_order".
 *
 * @property int $id
 * @property string $code
 * @property string $start_date
 * @property string $finish_date
 * @property int $total_calculation total per satuan
 * @property int $hotel_id
 * @property int $customer_profile_id
 * @property string $created_at
 * @property string $updated_at
 *
 * @property CustomerProfile $customerProfile
 * @property Hotel $hotel
 * @property Payment[] $Payments
 */
class HotelOrder extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'hotel_order';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['start_date', 'finish_date', 'hotel_id'], 'required'],
            [['code', 'created_at', 'updated_at', 'total_calculation', 'customer_profile_id'], 'safe'],
            [['total_calculation', 'hotel_id', 'customer_profile_id'], 'integer'],
            [['code'], 'string', 'max' => 20],
            [['code'], 'unique'],
            [['customer_profile_id'], 'exist', 'skipOnError' => true, 'targetClass' => CustomerProfile::className(), 'targetAttribute' => ['customer_profile_id' => 'id']],
            [['hotel_id'], 'exist', 'skipOnError' => true, 'targetClass' => Hotel::className(), 'targetAttribute' => ['hotel_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'code' => 'Kode Order',
            'start_date' => 'Check In',
            'finish_date' => 'Check Out',
            'total_calculation' => 'Total Menginap',
            'hotel_id' => 'Hotel',
            'customer_profile_id' => 'Customer Profile',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomerProfile()
    {
        return $this->hasOne(CustomerProfile::className(), ['id' => 'customer_profile_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHotel()
    {
        return $this->hasOne(Hotel::className(), ['id' => 'hotel_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPayments()
    {
        return $this->hasMany(Payment::className(), ['order_id' => 'id', 'list_type_order_id' => 'HotelOrder']);
    }

    public function generateCode()
    {
        $this->code = Yii::$app->security->generateRandomString(9) . '-' . time();
    }

    public function generateUserId()
    {
        $this->user_id = CustomerProfile::find(['user_id' => Yii::$app->user->id]);
    }

    public function order(HotelOrder $model)
    {
        if (!$this->validate()) {
            return null;
        }

        $model->generateCode();
        $model->total_calculation = \common\helpers\MyHelper::getDateInterval($model->start_date, $model->finish_date);
        $model->customer_profile_id = CustomerProfile::findCustomerProfileByIdUser();
        $model->save();
        Payment::generatePayment($model, 1);
        return true;
        
    }
}
