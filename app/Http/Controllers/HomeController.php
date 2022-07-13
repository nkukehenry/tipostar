<?php

namespace App\Http\Controllers;

use App\Repositories\TipsRepository;
use App\Repositories\TipsterRepository;
use Illuminate\Http\Request;

class HomeController extends Controller
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
    public function index(Request $request)
    {
        $data['tipsters']  = $this->tipsterRepo->getTipsters($request);
        $data['free_tips'] = $this->tipsRepo->getFreeTips();
        
        return view('site.home')->with($data);
    }
}
