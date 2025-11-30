<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Petition extends Model
{

    protected $fillable = ['title', 'description', 'destinatary', 'signeds', 'status'];
    public function category(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo('App\Models\Category');
    }

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo('App\Models\User');
    }

    public function signedUsers(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany('App\Models\User', 'petition_user');
    }

    public function file(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne('App\Models\File');
    }

}
