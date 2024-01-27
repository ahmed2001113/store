<?php

namespace App\Listeners;

use App\Events\OrderCreated;
use App\Facades\Cart;
use App\Models\Product;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;
use Throwable;

class DeductProductQuantity
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     *///ايفينت علشان ننقص الكميه الي اخدناها من المنتج من الكمية الي في الداتابيز
    public function handle(OrderCreated $event)
    {
        $order = $event->order;
        
        // UPDATE products SET quantity = quantity - 1
        try {
            foreach ($order->products as $product) {
                // الكود ده علشان نستخدمه لازم يكون فيه علاقه بين الموديل و الكميه جبناها من الجدول البايفوت
            //    ممكن بدل كلمه اوردر ايتيم نكتب كلمه بايفوت علاشن يرجع الجدول الوسيط يس في الموديل كتبناله اسم
                $product->decrement('quantity', $product->order_item->quantity);
                
                // Product::where('id', '=', $item->product_id)
                //     ->update([
                    // بنكتب ديبي علشان يتعامل مع الكود كا امر مش استرينج
                //         'quantity' => DB::raw("quantity - {$item->quantity}")
                //     ]);
            }
        } catch (Throwable $e) {
            
        }
    }
}
