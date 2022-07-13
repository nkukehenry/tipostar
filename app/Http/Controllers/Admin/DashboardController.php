<?php
    /**
     * PHP Version 7.2.19 or newer
     * Functions for dashboard
     * 
     * @category    File
     * @package     Dashboard
     * @author     Nkuke Henry
     * @copyright   henricsanyu@gmail.com
     */

    namespace App\Http\Controllers\Admin;

    use App\Http\Controllers\Controller;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Validator;
    use DB;
    use Illuminate\Support\Facades\Input;
    use Illuminate\Support\Facades\Storage;
    use Image;
    use SiteHelpers;
    

    /**
     *  Class contain functions for admin
     *  @category   Class
     *  @package    Dashboard
     *  @author     Henry Nkuke
     *  @copyright  henricsanyu@gmail.com
     */

    class DashboardController extends Controller
    {
        /**
         * Function to display the dashboard contents for admin
         * 
         * @param array $request All input values from form
         * 
         * @return contents to display in dashboard
         */

        public function index()
        {
            return view('admin.dashboard.index');
        }
    }
