<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    use HasFactory;

    protected $fillable = ['subject_id', 'name'];

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function subTopics()
    {
        return $this->hasMany(SubTopic::class);
    }
}
