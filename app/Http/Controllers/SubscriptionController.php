<?php

namespace App\Http\Controllers;

use App\Repositories\TipsRepository;
use App\Repositories\TipsterRepository;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{

    private $tipsterRepo,$tipsRepo;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(TipsterRepository $tipsterRepo,TipsRepository $tipsRepo)
    {
        $this->tipsterRepo = $tipsterRepo;
        $this->tipsRepo    = $tipsRepo;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function showTipster($id)
    {
        $data['tipster']  = $this->tipsterRepo->getTipster($id);
        $data['free_tips'] = $this->tipsRepo->getTipsterTips($id);
        
        return view('site.subscribe')->with($data);
    }
}
