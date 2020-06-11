<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    protected $table = 'languages';
    protected $fillable = [
        'name', 'abbr', 'locale','direction','active'
    ];

    public function scopeActive($query){
        return $query->where('active',1);
    }
    public function getActive(){
        return   $this -> active == 1 ? 'مفعل'  : 'غير مفعل';
      }
    public function getDirection(){
        return   $this -> direction == 'ltr' ? 'من اليسار لليمين'  : 'من اليمين لليسار';
      }
  

}
