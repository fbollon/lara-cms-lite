<?php

namespace Fbollon\LaraCmsLite\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Content extends Model // implements HasMedia
{
    // use HasMediaTrait;

    protected $fillable = [
        'name',
        'description',
        'route',
        'creator_id',
        'displayed',
        'display_title',
        'display_footer',
        'weight',
    ];

    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb')
            ->width(205)
            ->height(115)
            ->sharpen(10)
            ->performOnCollections('images');
    }

    public function getNameLinkAttribute()
    {
        $title = __('app.show_detail_title', [
            'name' => $this->name, 'type' => __('content.content'),
        ]);
        $link = '<a href="'.route('contents.show', $this).'"';
        $link .= ' title="'.$title.'">';
        $link .= $this->name;
        $link .= '</a>';

        return $link;
    }


    /**
     * get content for context
     *
     * Undocumented function long description
     *
     * @param $content_type
     * @return $contents
     * @throws conditon
     **/
    public static function getContextualContent($paginate = true, $nb = 10)
    {
        $contents = Content::where('displayed', '=', 1)
            ->where('route', '=', \Route::currentRouteName())
            ->orderBy('weight', 'desc')
            ->orderBy('created_at', 'desc')
            ->paginate($nb);

        return $contents;
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'creator_id', 'id');
    }

    public function  getUserDisplayName()
    {
        return $this->user->{config('lara-cms-lite.user.displayFieldName')};
    }

}

