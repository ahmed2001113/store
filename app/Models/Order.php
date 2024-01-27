<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'store_id', 'user_id', 'payment_method', 'status', 'payment_status',
    ];

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class)->withDefault([
            'name' => 'Guest Customer'
        ]);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_items', 'order_id', 'product_id', 'id', 'id')
// هنعمل استدعاء للبايفوت موديل كده و لازم يكون اكستند بايفوت
// علشان يرجع الجدول الثالث كا اوبجيكت اعرف اعمل لوب عليه
        ->using(OrderItem::class)
        // مجرد اسم علشان هنكتبه في الليسينر
            ->as('order_item')
            // دي الكولم الي هحتاجها في الريليشن من الجدول الوسيط فا هنستدعيها بالطريقه دي
            // و من غير الكود ده هيرجع الفورين كي بس
            ->withPivot([
                'product_name', 'price', 'quantity', 'options',
            ]);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class, 'order_id');
    }

    public function addresses()
    {
        return $this->hasMany(OrderAddress::class);
    }

    public function billingAddress()
    {
        //هنستخدم الطريقه دي علشان هترجع الموديل  
        return $this->hasOne(OrderAddress::class, 'order_id', 'id')
            ->where('type', '=', 'billing');
// الطريقه دي هترجع كوليكشن فيه عنصر واحد
        //return $this->addresses()->where('type', '=', 'billing');
    }

    public function shippingAddress()
    {
        return $this->hasOne(OrderAddress::class, 'order_id', 'id')
            ->where('type', '=', 'shipping');
    }

    public function delivery()
    {
        return $this->hasOne(Delivery::class);
    }

    protected static function booted()
    {
        static::creating(function(Order $order) {
            // 20220001, 20220002
            // اوردر دي معنها الموديل
            $order->number = Order::getNextOrderNumber();
        });
    }
// فانكشن علشان نجيب اخر اوردر و نضيفه علي رقم السنه الحاليه
// لو لسه مفيش اوردر لسنه معينه يكتب رقم الريتيرن 
// و هنستخدم الفانكشن دي في فانكشن البوتيد علشان تضيف رقم للاوردر تلقائي
    public static function getNextOrderNumber()
    {
        // SELECT MAX(number) FROM orders
        // كاربون دي استاتيك ميثود
        $year =  Carbon::now()->year;
        $number = Order::whereYear('created_at', $year)->max('number');
        if ($number) {
            return $number + 1;
        }
        return $year . '0001';
    }
}
