<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CardApplication extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];
    protected $casts = [
        'id' => 'integer',
        'category_id' => 'integer',
        'user_id' => 'integer'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function cardCategory()
    {
        return $this->belongsTo(CardCategory::class,);
    }

}
