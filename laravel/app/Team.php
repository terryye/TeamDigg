<?php

namespace App;

use App\Libs\Storage;
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
     * @return \Illuminate\Datebase\Eloquent\Relations\HasMany
     */
    public function users()
    {
        return $this->hasMany('App\User');
    }

    /**
     * An article is owned by a user.
     *
     * @return \Illuminate\Datebase\Eloquent\Relations\HasMany
     */
    public function authors()
    {
        return $this->hasMany('App\Author');
    }

    /**
     * Get the icon url address
     *
     * @return array
     */
    public function getIconAttribute()
    {
        return Storage::getUrl('team_icon',$this->team_id . ".png");
    }
}
