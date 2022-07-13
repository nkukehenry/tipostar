<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tip extends Model
{
    use HasFactory;

    public function tipster(){
        return $this->belongsTo(Tipster::class);
    }

    public function game(){
        return $this->belongsTo(Game::class,'match_id','id');
    }

    public function outcome(){
        return $this->belongsTo(Outcome::class,'outcome_id','id');
    }
    
}
