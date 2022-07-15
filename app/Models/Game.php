<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Game extends Model
{
    use HasFactory;
    
    protected $table ="matches";

    public function home_team(){
        return $this->belongsTo(Team::class,'home_team_id','id');
    }

    public function away_team(){
        return $this->belongsTo(Team::class,'away_team_id','id');
    }

    public function outcome(){
        return $this->belongsTo(Outcome::class,'outcome_id','id');
    }

   
}
