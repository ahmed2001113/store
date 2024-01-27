<?php
// ده الانترفيس
namespace App\Repositories\Cart;

use App\Models\Cart;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;

class CartModelRepository implements CartRepository
{
    // هنعمل ايتم ونخزن فيها البيانات علشان الموقع يرجع البيانات مره واحده و يخزنها بعد كده 
//  وكوليكشن دي علشان يحول اراي الايتم لكوليكشن
    protected $items;
    public function __construct()
    {
        $this->items = collect([]);
    }

    public function get() : Collection
    {
        if (!$this->items->count()) {
            $this->items = Cart::with('product')->get();
        }

        return $this->items;
    }

    public function add(Product $product, $quantity = 1)
    {
        // هنعمل كونديشن علشان لو ضيفنا منتج في الكارد متضاف قبل كده ميضيفش ثاني بس يعدل علي الكميه
        $item =  Cart::where('product_id', '=', $product->id)
            ->first();
        
        if (!$item) {
            $cart = Cart::create([
                'user_id' => Auth::id(),
                'product_id' => $product->id,
                'quantity' => $quantity,
            ]);
            // لما يضيف منتج يضيفه في فانكشن الجيت علي الكوليكشن 
            $this->get()->push($cart);
            return $cart;
        }
// انكريمنت دي فانكشن ديفولت بتعدل علي الكميه 
        return $item->increment('quantity', $quantity);
    }

    public function update($id, $quantity)
    {
        Cart::where('id', '=', $id)
            ->update([
                'quantity' => $quantity,
            ]);
    }

    public function delete($id)
    {
        Cart::where('id', '=', $id)
            ->delete();
    }

    public function empty()
    {
        Cart::query()->delete();
    }

    public function total() : float
    {
        // الجوين بديل العلاقه في الموديل
        /*return (float) Cart::join('products', 'products.id', '=', 'carts.product_id')
            ->selectRaw('SUM(products.price * carts.quantity) as total')
            ->value('total');*/
// بدل ما يروح علي الداتابيز يعد المنتجات هنستدعي فانكشن جيت و نعد المنتجات الي فيها و نجمع سعرهم
        return $this->get()->sum(function($item) {
            return $item->quantity * $item->product->price;
        });
    }
}