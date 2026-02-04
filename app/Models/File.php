<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $fillable = [
        'petition_id',
        'name',
        'file_path'
    ];
    protected $table = 'files';


    public function petition()
    {
        return $this->belongsTo(Petition::class);
    }
}
