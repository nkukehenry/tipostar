<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

use Session;
use Redirect;
use Carbon\Carbon;

use App\Models\User;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

        //commmon function to display the error both in terminal and browser
    /**
     * return_output
     *
     * @param  mixed $type
     * @param  mixed $status_title
     * @param  mixed $message
     * @param  mixed $redirect_url
     * @param  mixed $status_code
     *
     * @return void
     */
    public function return_output($type, $status_title, $message, $redirect_url, $status_code = '')
    {
        // echo 'test';exit;
        //$type = error/flash - error on form validations, flash to show session values
        //$status_title = success/error/info - change colors in toastr as per the status

        if ($type=='error') 
        {
            if ($redirect_url == 'back') 
            {
                return Redirect::back()->withErrors($message)->withInput();
            } elseif ($redirect_url != '') 
            {
                return Redirect::to($redirect_url)->withErrors($message)->withInput();
            }
        } 
        else 
        {
            if ($redirect_url == 'back') 
            {
                return Redirect::back()->with($status_title, $message);
            } 
            elseif ($redirect_url != '') 
            {
                return Redirect::to($redirect_url)->with($status_title, $message);
            } 
            elseif ($redirect_url == '') 
            {
                return Session::flash($status_title, $message);
            }
        }
        
    }
}
