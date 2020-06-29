<?php

namespace App\Models;
use App\Models\MainCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Vendor extends Model
{
    use Notifiable;
    protected $table = 'vendors';
    protected $fillable = [
        'name', 'email', 'mobile','address','photo','active','category_id','created_at','updated_at'
    ];

    protected $hidden = ['category_id'];

    public function scopeActive($query){
        return $query->where('active',1);
    }

    public function scopeSelection($query){
        return $query->select('id','name','category_id','photo','address','mobile','email','active');
    }

    public function getPhotoAttribute($val){
        return $val !== null ? asset('storage/'.$val) : "" ;
        
    }

    public function getActive(){
        return $this->active == 1 ? 'مفعل' : 'غير مفعل'; 
    }
    public function category(){
        return $this->belongsTo(MainCategory::class,'category_id','id');
    }
}
