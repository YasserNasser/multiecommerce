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
    public function scopeSelection($query){
        return $query->select('id','translation_lang','name','slug','photo','active');
    }
    public function getPhotoAttribute($val){
        return $val !== null ? asset('storage/'.$val) : "" ;
        
    }
    public function getActive(){
        return $this->active == 1 ? 'مفعل' : 'غير مفعل'; // arabic languages change the position of the tow choice here please note that
    }
    //get all translation for specific category in the same table 'main{category'
    public function categories(){
        return $this->hasMany(self::class,'translation_of','id');
    }
}
