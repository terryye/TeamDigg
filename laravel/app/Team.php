<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    /**
     * fillable fields for an Article.
     *
     * @var array
     */
    protected $fillable = [
        'team_name',
        'team_intro'
    ];

    /**
     * Additional fields to treat as Carbon instances.
     *
     * @var array
     */
    protected $dates = [];

    /**
     * An article is owned by a user.
     *
     * @return \Illuminate\Datebase\Eloquent\Relations\BelongsTo
     */
    public function users()
    {
        return $this->hasMany('App\User');
    }

}
