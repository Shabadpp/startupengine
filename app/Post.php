<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use GrahamCampbell\Markdown\Facades\Markdown;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

class Post extends Model implements AuditableContract
{
    use SoftDeletes;

    use Auditable;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at', 'published_at'];

    public function bodyHtml()
    {
        return Markdown::convertToHtml($this->body);
    }

    public function category() {
        $category = \App\Category::where('id', '=', $this->category_id)->first();
        return $category;
    }
}
