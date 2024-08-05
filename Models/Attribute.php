<?php

namespace Modules\Filter\Models;

use App\Traits\HasSorting;
use App\Traits\HasTable;
use App\Traits\HasTimestamps;
use App\Traits\HasTranslate;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Modules\Category\Models\Category;
use Modules\Seo\Traits\HasSeo;

class Attribute extends Model
{
    use HasFactory;
    use HasTable;
    use HasSorting;
    use HasSeo;
    use HasTimestamps;
    use HasTranslate;

    public const TABLE = 'attributes';

    protected $table = self::TABLE;

    protected $fillable = ['name', 'image'];

    protected $allowedSorts = ['name', 'sorting', 'updated_at'];

    public static function getDb(): string
    {
        return 'attributes';
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'attribute_categories', 'attribute_id', 'category_id');
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'attribute_products', 'attribute_id', 'product_id');
    }
}
