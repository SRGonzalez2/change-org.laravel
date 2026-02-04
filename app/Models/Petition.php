<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Petition extends Model
{
    protected $fillable = [
        'title',
        'description',
        'destinatary',
        'signeds',
        'status',
        'category_id',
        'user_id'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'categoria_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function firmas()
    {
        return $this->belongsToMany(User::class, 'petition_user');
    }

    public function files()
    {
        return $this->hasMany(File::class);
    }
}
