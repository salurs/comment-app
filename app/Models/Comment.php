<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
//    protected $table = 'comments';
    protected $fillable = ['post_id', 'parent_id', 'name', 'body'];

    public function children() {
        return $this->hasMany(self::class, 'parent_id','id');
    }
    public function allChildren()
    {
        return $this->children()->with('allChildren');
    }
}
