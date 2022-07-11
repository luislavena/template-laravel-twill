<?php

namespace App\Twill\Capsules\Pages\Models;

use App\Twill\Capsules\Base\Model;
use A17\Twill\Models\Behaviors\HasSlug;
use A17\Twill\Models\Behaviors\HasBlocks;
use A17\Twill\Models\Behaviors\HasRevisions;
use A17\Twill\Models\Behaviors\HasTranslation;

class Page extends Model
{
    use HasBlocks;
    use HasTranslation;
    use HasSlug;
    use HasRevisions;

    protected $fillable = ['published', 'position'];

    public array $translatedAttributes = ['title', 'active', 'seo_title', 'seo_description'];

    public array $slugAttributes = ['title'];
}
