<?php

use App\Models\TipsterBadge;

if(!function_exists('get_tipster_badges')){

 function get_tipster_badges($tipster_id){

    $badges = TipsterBadge::where('tipster_id',$tipster_id)->get();

    $badges->map(function($tip_badge){

        $tip_badge->badge_class = $tip_badge->badge->badge_class;
        $tip_badge->badge_color = $tip_badge->badge->badge_color;
        $tip_badge->svg_image   = $tip_badge->badge->svg_image;
      });

      return $badges;
  }

}


