<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "customer_profile".
 *
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property string $phone_number
 * @property string $email
 * @property string $date_of_birth
 * @property string $address
 * @property int $gender 0=male, 1=female
 * @property int $user_id
 * @property string $created_at
 * @property string $updated_at
 *
 * @property HotelOrder[] $hotelOrders
 */
class CustomerProfile extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'customer_profile';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['first_name', 'last_name', 'phone_number', 'email', 'address', 'gender', 'user_id'], 'required'],
            [['date_of_birth', 'created_at', 'updated_at'], 'safe'],
            [['gender', 'user_id'], 'integer'],
            [['first_name', 'last_name'], 'string', 'max' => 50],
            [['phone_number'], 'string', 'max' => 15],
            [['email'], 'string', 'max' => 100],
            [['address'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'first_name' => 'Nama Depan',
            'last_name' => 'Nama Belakang',
            'phone_number' => 'Nomor Telepon',
            'email' => 'Email',
            'date_of_birth' => 'Tanggal Lahir',
            'address' => 'Alamat',
            'gender' => 'Jenis Kelamin',
            'user_id' => 'Username',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHotelOrders()
    {
        return $this->hasMany(HotelOrder::className(), ['customer_profile_id' => 'id']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(\common\models\User::className(), ['id' => 'user_id']);
    }

    public function findCustomerProfileByIdUser()
    {
        return CustomerProfile::findOne(['user_id' => Yii::$app->user->identity->id])['id'];
    }
}
