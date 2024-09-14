<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Finding extends Model
{
    use HasFactory;

    protected $fillable = ['sub_topic_id', 'findings'];

    public function subTopic()
    {
        return $this->belongsTo(SubTopic::class);
    }

    public function explanations()
    {
        return $this->hasMany(Explanation::class);
    }
}
