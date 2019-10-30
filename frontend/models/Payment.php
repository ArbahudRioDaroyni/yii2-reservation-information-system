<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "payment".
 *
 * @property int $id
 * @property string $invoice invoice
 * @property string $date_of_issued tanggal dibuat
 * @property string $date_due jatuh tempo
 * @property int $tax pajak
 * @property int $total_price total_calculation x room_type.price
 * @property int $down_payment uang muka
 * @property int $amount_due total tagihan
 * @property int $payment_method metode pembayaran
 * @property int $status 0=not_paid, 1=insufficient, 2=paid_off
 * @property int $order_id
 * @property string $created_at
 * @property string $updated_at
 *
 * @property HotelOrder $orderHotel
 */
class Payment extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'payment';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['date_of_issued', 'date_due', 'total_payment', 'created_at', 'updated_at'], 'safe'],
            [['total_price', 'amount_due', 'order_id'], 'required'],
            [['tax', 'total_price', 'down_payment', 'amount_due', 'total_payment', 'payment_method', 'status', 'order_id'], 'integer'],
            [['invoice', 'payment_code'], 'string', 'max' => 20],
            [['invoice', 'payment_code'], 'unique'],
            // [['order_id'], 'exist', 'skipOnError' => true, 'targetClass' => HotelOrder::className(), 'targetAttribute' => ['order_id' => 'id']],
            [['list_type_order_id'], 'exist', 'skipOnError' => true, 'targetClass' => ListTypeOrder::className(), 'targetAttribute' => ['list_type_order_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'invoice' => 'Invoice',
            'payment_code' => 'Kode Pembayaran',
            'date_of_issued' => 'Tanggal Cetak',
            'date_due' => 'Tanggal Jatuh Tempo',
            'tax' => 'Tax',
            'total_price' => 'Total Price',
            'down_payment' => 'Down Payment',
            'amount_due' => 'Amount Due',
            'total_payment' => 'Total Pembayaran',
            'payment_method' => 'Payment Method',
            'status' => 'Status',
            'list_type_order_id' => 'Tipe Order',
            'order_id' => 'Order',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getListTypeOrder()
    {
        return $this->hasOne(HotelOrder::className(), ['id' => 'list_type_order_id']);
    }

    public function generatePriceHotel($id)
    {
        $price = Hotel::findOne(['id' => $id])['hotel_room_type_id'];
        return HotelRoomType::findOne(['id' => $price])['price'];
    }

    static public function generatePayment($order, $type_order)
    {
        $payment = new Payment;
        $payment->payment_code = $order->code;
        $payment->date_due = (isset($order->start_at)) ? $order->created_at : NULL ;

        // Hotel
        if ($type_order == 1) {
            $payment->total_price = Payment::generatePriceHotel($order->hotel_id) * $order->total_calculation;
            $payment->amount_due = $payment->total_price - $payment->down_payment;

        // Massage
        } elseif ($type_order == 2) {
            $payment->total_price = $order->massage->price;
            $payment->amount_due = $payment->total_price;

        // Food
        } elseif ($type_order == 3) {
            $payment->total_price = $order->food->price * $order->total_calculation;
            $payment->amount_due = $payment->total_price;

        // Towing
        } elseif ($type_order == 4) {
            $payment->total_price = $order->towing->price;
            $payment->amount_due = $payment->total_price;

        // Cleaning
        } elseif ($type_order == 5) {
            $payment->total_price = $order->cleaning->price;
            $payment->amount_due = $payment->total_price;
        }
        $payment->list_type_order_id = $type_order;
        $payment->order_id = $order->id;
        $payment->save();

        return $payment;
    }
}
