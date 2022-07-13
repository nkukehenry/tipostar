<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Tip;
use App\Models\Game;
use Carbon\Carbon;

class Tipster extends Model
{
    use HasFactory;

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function subscriptions(){
        return $this->hasMany(Subscription::class)
                    ->where('ends_at','>=',Carbon::now());
    }

    public function tips(){
        return $this->hasMany(Tip::class,'tipster_id','id');
    }

    public function won(){
        return $this->hasMany(Tip::class,'tipster_id','id')
                    ->where('is_win',1);
    }

    public function lost(){
        return $this->hasMany(Tip::class,'tipster_id','id')
                    ->where('is_win',0);
    }

    public function games(){
        return $this->hasManyThrough(Game::class,Tip::class,'match_id','id');
    }

    public function badges(){
        return $this->hasMany(TipsterBadge::class)
                    ->with('badge')
                    ->where('is_active',1);
    }
}
