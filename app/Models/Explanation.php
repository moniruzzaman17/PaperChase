<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Explanation extends Model
{
    use HasFactory;

    protected $fillable = ['finding_id', 'details'];

    public function finding()
    {
        return $this->belongsTo(Finding::class);
    }

}
