<?php
namespace App\Repositories;

use Illuminate\Http\Request;
use App\Models\Tipster;

class TipsterRepository{

    public function __construct()
    {
        
    }

   public function getTipsters(Request $request){
           
        $tipsters = Tipster::all();

        $tipsters->map(function($tipster){

            $this->formaTipster($tipster);

        });

        return $tipsters;
  }

  /*
   *Get tipster details
   */
  public function  getTipster($tipster_id)
  {
    $tipster = Tipster::find($tipster_id);
    $tipster = $this->formaTipster($tipster);
    
    return $tipster;
  }

  private function formaTipster($tipster){

            $tipster->name   = $tipster->user->first_name." ".$tipster->user->last_name;
            $tipster->email  = $tipster->user->email;
            $tipster->since  = $tipster->user->created_at->diffForHumans();
            $tipster->tips   = $tipster->tips;
            $tipster->tips_count  = count($tipster->tips);
            $tipster->subscribers = count($tipster->subscriptions);
            $tipster->games       = $tipster->games;
            $tipster->win_rate    = number_format(($tipster->tips_count>0)?(count($tipster->won)/$tipster->tips_count)*100:0,1)."%";
            $tipster->photo       = storage_link("avatars/".$tipster->user->photo);

            $tipster->badges->map(function($tip_badge){
              $tip_badge->badge_class = $tip_badge->badge->badge_class;
              $tip_badge->badge_color = $tip_badge->badge->badge_color;
              $tip_badge->svg_image   = $tip_badge->badge->svg_image;
            });

       
       return $tipster;
  }



}