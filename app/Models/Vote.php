<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function division(){
        return $this->belongsTo(Division::class);
    }
    public function poll(){
        return $this->belongsTo(Poll::class);
    }
    public function choice(){
        return $this->belongsTo(Choice::class);
    }
    
}
