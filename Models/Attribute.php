<?php

namespace Modules\Filter\Models;

use App\Traits\HasSorting;
use App\Traits\HasTable;
use App\Traits\HasTimestamps;
use App\Traits\HasTranslate;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Category\Models\Category;
use Modules\Product\Models\Product;
use Modules\Seo\Traits\HasSeo;
use Nwidart\Modules\Facades\Module;

class Attribute extends Model
{
    use HasFactory;
    use HasTable;
    use HasSorting;
    use HasSeo;
    use HasTimestamps;
    use HasTranslate;

    protected $fillable = ['name', 'image'];

    public static function getDb(): string
    {
        return 'attributes';
    }

    public function categories()
    {
        if (Module::find('Category') && Module::find('Category')->isEnabled()) {
            return $this->belongsToMany(Category::class, 'attribute_categories', 'attribute_id', 'category_id');
        }
    }

    public function products()
    {
        if (Module::find('Product') && Module::find('Product')->isEnabled()) {
            return $this->belongsToMany(Product::class, 'attribute_products', 'attribute_id', 'product_id')->withPivot('language_id', 'value');
        }
    }
}
