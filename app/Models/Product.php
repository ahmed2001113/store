<?php

namespace App\Models;

use App\Models\Scopes\StoreScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'slug', 'description', 'image', 'category_id', 'store_id',
        'price', 'compare_price', 'status',
    ];
// فانكشن علشان نخفي الحاجات دي من الابي اي ولازم يكونوا نفس الاسم ده
    protected $hidden = [
        'image',
        'created_at', 'updated_at', 'deleted_at',
    ];
//  فانكشن علشان ننفزالفانكشن الي اسمها getImageUrlAttribute علي الابي اي بس بنستدعي الاسم الي عملناه
    protected $appends = [
        'image_url',
    ];

    protected static function booted()
    {
        static::addGlobalScope('store', new StoreScope());
// فانكشن علشان يعمل سلج تلقائل لما الاي بي اي يبعت اسم
        static::creating(function(Product $product) {
            $product->slug = Str::slug($product->name);
        });
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function store()
    {
        return $this->belongsTo(Store::class, 'store_id', 'id');
    }

    public function tags()
    {
        return $this->belongsToMany(
            Tag::class,     // Related Model
            'product_tag',  // Pivot table name الجدول الوسيط ال3
            'product_id',   // FK in pivot table for the current model
            'tag_id',       // FK in pivot table for the related model
            'id',           // PK current model
            'id'            // PK related model
        );
    }

    public function scopeActive(Builder $builder)
    {
        $builder->where('status', '=', 'active');
    }

    // Accessors لازم اسم الميثود يبقي زي ما هو مكتوب كده
    // $product->image_url
    public function getImageUrlAttribute()
    {
        // لو مفيش صوره حط اللينك ده
        if (!$this->image) {
            return 'https://www.incathlab.com/images/products/default_product.png';
        }
        // لو الصوره بتبدأ بالكلام ده سيبها
        if (Str::startsWith($this->image, ['http://', 'https://'])) {
            return $this->image;
        }
        // لو فيه صوره في الداتابيز
        return asset('storage/' . $this->image);
    }
// ميثود علشان نعرض نسبه الخصم لو موجوده
    public function getSalePercentAttribute()
    {
        if (!$this->compare_price) {
            return 0;
        }
        return round(100 - (100 * $this->price / $this->compare_price), 1);
    }
// فانكشن للابي اي
    public function scopeFilter(Builder $builder, $filters)
    {
        // اراي ميرج بتحط قيم ديفولت لاكن لو فيه قيم في الفيلتر بتغير القيم الديفولت ليها
        $options = array_merge([
            'store_id' => null,
            'category_id' => null,
            'tag_id' => null,
            'status' => 'active',
        ], $filters);
// بنستخدم البيلدر علشان نخزن القيم في جداول اخري
        $builder->when($options['status'], function ($query, $status) {
            return $query->where('status', $status);
        });

        $builder->when($options['store_id'], function($builder, $value) {
            $builder->where('store_id', $value);
        });
        $builder->when($options['category_id'], function($builder, $value) {
            $builder->where('category_id', $value);
        });
        $builder->when($options['tag_id'], function($builder, $value) {
// الكود ده احسن في البروفورمانس ونفس ناتج الكود الي تحته
            $builder->whereExists(function($query) use ($value) {
                $query->select(1)
                    ->from('product_tag')
                    ->whereRaw('product_id = products.id')
                    ->where('tag_id', $value);
            });
            
            // $builder->whereRaw('id IN (SELECT product_id FROM product_tag WHERE tag_id = ?)', [$value]);
            // $builder->whereRaw('EXISTS (SELECT 1 FROM product_tag WHERE tag_id = ? AND product_id = products.id)', [$value]);
            // $builder->whereHas('tags', function($builder) use ($value) {
            //     $builder->where('id', $value);
            // });
        });
    }
}
