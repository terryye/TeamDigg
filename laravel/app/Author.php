<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    //
    /**
     * fillable fields for an Article.
     *
     * @var array
     */
    protected $fillable = [
        'author_name',
    ];

    /**
     * Additional fields to treat as Carbon instances.
     *
     * @var array
     */
    protected $dates = [];

    /**
     * An author belongs to many teams.
     *
     * @return \Illuminate\Datebase\Eloquent\Relations\BelongsTo
     */
    public function teams()
    {
        return $this->belongsToMany('App\Team');
    }
}
