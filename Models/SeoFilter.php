<?php

namespace Modules\Filter\Models;

use App\Traits\HasStatus;
use App\Traits\HasTable;
use App\Traits\HasTimestamps;
use App\Traits\HasTranslate;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Seo\Traits\HasSeo;

class SeoFilter extends Model
{
    use HasFactory;
    use HasTable;
    use HasStatus;
    use HasSeo;
    use HasTranslate;
    use HasTimestamps;

    protected $fillable = ['name', 'old_url', 'new_url'];

    public static function getDb(): string
    {
        return 'seo_filters';
    }
}
