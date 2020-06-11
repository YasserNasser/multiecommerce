<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MainCategory extends Model
{
    protected $table = 'main_categories';
    protected $fillable = [
        'name', 'translation_lang', 'translation_of','slug','photo','active'
    ];

    public function scopeActive($query){
        return $query->where('active',1);
    }
}
