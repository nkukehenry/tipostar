<?php

    /**
     * PHP Version 7.2.19 or newer
     * Functions for dashboard
     * 
     * @category    File
     * @package     Odd
     * @author     Nkuke Henry
     * @copyright   henricsanyu@gmail.com
     */

    namespace App\Http\Controllers\Admin;

    use App\Http\Controllers\Controller;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Validator;

    use App\Odd;

    /**
     *  Class contain functions for admin
     *  @category   Class
     *  @package    Odd
     *  @author     Henry nkuke
     *  @copyright  Tipostar
    */

    class OddController 
    {
        /**
         * index
         *
         * @return void
         */
        public function index()
        {
            $odds = Odd::all();

              // Return the result to jquery datatables
              if(request()->ajax())
              {
                  return datatables()->of($odds)
                          ->addIndexColumn()
                          ->addColumn('action', function($row){
                              $btn = '<a href="javascript:void(0)"
                                      data-toggle="tooltip"  
                                      data-id="'.$row->id.'" 
                                      data-original-title="Edit" 
                                      class="edit btn btn-primary btn-sm btn-flat editOdd">
                                      Edit</a>';
  
                              $btn .= '<a href="javascript:void(0)" 
                                      data-toggle="tooltip"  data-id="'.$row->id.'" 
                                      data-original-title="Delete" 
                                      class="btn btn-danger btn-sm btn-flat deleteOdd">
                                      Delete</a>';
  
                              return $btn;
                          })
                          ->rawColumns(['action'])
                          ->make(true);
              }
            return view('admin.odds.index'); 
        }

        
         /**
         * edit
         *
         * @param  mixed $request
         *
         * @return void
         */
        public function edit(Request $request)
        {
            $id = $request->odd_id;
            $odd = Odd::find($id);
            return response()->json($odd);
        }


        /**
         * store
         *
         * @param  mixed $request
         *
         * @return void
         */
        public function store(Request $request)

        {
            $odd_id = $request->odd_id;

            if($odd_id)
            {
                $odd = Odd::find($odd_id);
                $success_message = 'Odd updated successfully';

                $validation_rules = [
                    'name' => 'required|string|max:100|unique:odds,name,'.$odd->id,
                    'description' => 'required'
                ];
            }
            else
            {
                $odd = new Odd();
                $success_message = 'odd added successfully';

                $validation_rules = [
                    'name' => 'required|string|max:100|unique:odds',
                    'description' => 'required'
                ]; 
            }

            $validator = Validator::make($request->all(), $validation_rules);

            if ($validator->fails()) 
            {
                return response()->json(['errors'=>$validator->errors()->all()]);
            }
            
            $odd->name = $request->input('name');
            $odd->description = $request->input('description');
            $odd->save();

            return response()->json(['success' => $success_message]);
        }


         /**
         * delete
         *
         * @param  mixed $request
         *
         * @return void
         */
        public function delete(Request $request)
        {
            $id = $request->odd_id;
            if(!empty($id))
            {   
                Odd::find($id)->delete();
                return response()->json(['success'=>'Odd deleted successfully']);
            }
            else 
            {
                return response()->json(['errors'=>'Odd not deleted successfully']);
            } 
        }


        /**
         * getData
         *
         * @param  mixed $request
         *
         * @return void
         */
        public function getData(Request $request)
        {
            $odds = Odd::all();
            return response()->json($odds);
        }

    }