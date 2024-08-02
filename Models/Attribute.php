<?php

namespace Modules\Filter\Models;

use App\Traits\HasSorting;
use App\Traits\HasTable;
use App\Traits\HasTimestamps;
use App\Traits\HasTranslate;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
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

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'product_id');
    }
}
