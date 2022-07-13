<?php

    /**
     * PHP Version 7.2.19 or newer
     * Functions for dashboard
     * 
     * @category    File
     * @package     Team
     * @author     Nkuke Henry
     * @copyright   henricsanyu@gmail.com
     */

    namespace App\Http\Controllers\Admin;

    use App\Http\Controllers\Controller;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Validator;

    use App\Models\Tipster;
    use Carbon\Carbon;
    use App\Repositories\TipsterRepository;

    /**
     *  Class contain functions for admin
     *  @category   Class
     *  @package    Team
     *  @author     Henry nkuke
     *  @copyright  Tipostar
     */

    class TipsterController
    {
        private $tipsterRepo;

        public function __construct(TipsterRepository $tipsterRepo)
        {
            $this->tipsterRepo = $tipsterRepo;
        }
        /**
         * index
         *
         * @return void
         */

        public function index(Request $request)
        {
            $data['tipsters'] = $this->tipsterRepo->getTipsters($request);
            return view('admin.tipsters.index')->with($data);
        }




    }