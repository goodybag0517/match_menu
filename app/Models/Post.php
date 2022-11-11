<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function nices() {
        return $this->hasMany(Nice::class);
    }

    protected $fillable = [
        'title',
        'image',
        'user_id',
        'food1',
        'food2',
        'food3',
        'food4',
        'food5',
        'food6',
        'food7',
        'food8',
        'food9',
        'step1',
        'step2',
        'step3',
        'step4',
        'step5',
    ];
}
