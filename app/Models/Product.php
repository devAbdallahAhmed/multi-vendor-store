<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;



    protected $fillable = [
        'name',
        'slug',
        'description',
        'image',
        'category_id',
        'store_id',
        'price',
        'compare_price',
        'status',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
        'number',
        'image'

        
    ];
    // public function scopeFilter(Builder $builder, $filters)
    // {
    //     $builder->when($filters['name'] ?? false, function ($builder, $value) {
    //         $builder->where('categories.name', "LIKE", "%{$value}%");
    //     });
    //     $builder->when($filters['status'] ?? false, function ($builder, $value) {
    //         $builder->where('categories.status', "=", "{$value}");
    //     });
    // }
    public function scopeActive(Builder $builder)
    {
        $builder->where('status', 'active');
    }

    public static function rules($id = 0)
    {
        return [
            'name' => [
                'required',
                'string',
                'min:3',
                'max:255',
                Rule::unique('categories', 'name')->ignore($id)

            ],
            'parent_id' => [
                'nullable',
                'int',
                'exists:categories,id'
            ],
            'image' => [
                'image',
                'max:1048576',
                'dimensions:min_width=100,min_height=100'
            ],
            'status' => ['in:active,inactive']
        ];
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function tags()
    {
        return $this->belongsToMany(
            Tag::class,
            'product_tag',
            'product_id',
            'tag_id',
            'id',
            'id'

        );
    }


    public function getImageUrlAttribute()
    {
        if (!$this->image) {
            return "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQl25QvOJdNiSdemG-PaXhZwPRVyBRr506ite3y-fSFO8airq14znZ_FxM&amp;s";
        }

        if (Str::startsWith($this->image, ['http//', 'https//'])) {
            return $this->image;
        }
        return asset('storage/' . $this->image);
    }

    public function getSalePercentAttribute()
    {
        if (!$this->compare_price) {
            return 0;
        }
        return  round(100 - (100 * $this->price / $this->compare_price), 1);
    }
    public function cart()
    {
        return $this->hasMany(Cart::class);
    }

    protected static function booted()
    {
        static::creating(function ($product) {
            if (empty($product->slug)) {
                $product->slug = Str::slug($product->name);
            }

            if (empty($product->number)) {
            $product->number = 'PRD-' . strtoupper(Str::random(6));
        }
        });


    }
    public function scopeFilter(Builder $builder,$filters){
        $options = array_merge([
            'store_id' => null,
            'category_id' => null,
            'tag_id' => null,
            'status' => 'active',
        ], $filters);
        $builder->when($options['store_id'], function ($builder, $value) {
            $builder->where('store_id', $value);
        });
        $builder->when($options['category_id'], function ($builder, $value) {
            $builder->where('category_id', $value);
        });
        $builder->when($options['tag_id'] && is_array($options['tags']), function ($builder, $value) {
            $builder->whereExists(function ($query) use ($value) {
                $query->selectRaw('1')
                    ->from('product_tag')
                    ->whereRaw('product_id = products.id')
                    ->whereIn('tag_id', $value);
            });
        });
        $builder->when($options['status'], function ($builder, $value) {
            $builder->where('status', $value);
        });

    }

  protected $appends = ['image_url'];
}

