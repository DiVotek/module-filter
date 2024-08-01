<?php

namespace Modules\Filter\Models;

use App\Traits\HasSorting;
use App\Traits\HasTable;
use App\Traits\HasTimestamps;
use App\Traits\HasTranslate;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Seo\Traits\HasSeo;

class Attribute extends Model
{
    use HasFactory;
    use HasTable;
    use HasTimestamps;
    use HasSorting;
    use HasTimestamps;
    use HasSeo;
    use HasTranslate;

    public const TABLE = 'attributes';

    protected $table = self::TABLE;

    protected $fillable = ['image'];

    protected $allowedSorts = ['name', 'sorting', 'updated_at'];

    public static function getDb(): string
    {
        return 'attributes';
    }
}
