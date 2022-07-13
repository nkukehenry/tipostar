<?php
namespace App\Repositories;

use Illuminate\Http\Request;
use App\Models\Tip;

class TipsRepository{

  /*
   *Get allfree tips
   */
 public function getAllTips(Request $request){
           
        $tips = Tip::all();
        return $this->formatTips($tips);
  }

  /*
   *Get free tips
   */
  public function getFreeTips()
  {
    $tips = Tip::all();
    return $this->formatTips($tips);
  }

   /*
   *Get tipster's tips
   */
  public function  getTipsterTips($tipster_id)
  {
    $tips = Tip::where('tipster_id',$tipster_id)->get();
    return $this->formatTips($tips);
  }

  /*
   *Format tips to include easy to access fields
   */
  private function formatTips($tips){
     
   $tips->map(function($tip){

        $tip->home_team  = $tip->game->home_team->team_name;
        $tip->away_team  = $tip->game->away_team->team_name;
        $tip->game_date  = $tip->game->game_date;
        $tip->match      = $tip->home_team." Vs ".$tip->away_team ;
        $tip->prediction = $tip->outcome->outcome_name." (".$tip->outcome->outcome_symbol.")";
        
    });

    return $tips;

  }


}