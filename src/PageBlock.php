<?php

namespace Pvtl\VoyagerPageBlocks;

use Illuminate\Support\Facades\Config;
use Illuminate\Database\Eloquent\Model;

class PageBlock extends Model
{
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'data' => 'array',
        'is_hidden' => 'boolean',
        'is_minimized' => 'boolean',
        'is_delete_denied' => 'boolean',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type',
        'filepath',
        'data',
        'is_hidden',
        'is_minimized',
        'is_delete_denied',
        'cache_ttl',
    ];

    public function page()
    {
        return $this->belongsTo('TCG\Voyager\Models\Page');
    }

    // Fetch config for block template
    public function template()
    {
        if ($this->type !== 'template' || empty($this->filepath)) {
            return null;
        }

        $templateKey = substr($this->filepath, 0, strpos($this->filepath, '.'));
        $templateConfig = json_encode(Config::get("page-blocks.$templateKey"));

        return json_decode($templateConfig);
    }

    public function getDataAttribute($value)
    {
        return json_decode($value);
    }
}
