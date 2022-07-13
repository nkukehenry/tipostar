<?php

    /**
     * PHP Version 7.2.19 or newer
     * Functions for dashboard
     * 
     * @category    File
     * @package     Plan
     * @author     Nkuke Henry
     * @copyright   henricsanyu@gmail.com
     */

    namespace App\Http\Controllers\Admin;

    use App\Http\Controllers\Controller;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Validator;



    /**
     *  Class contain functions for admin
     *  @category   Class
     *  @package    Plan
     *  @author     Henry nkuke
     *  @copyright  Tipostar
     */


    class PlanController 
    {
        /**
         * index
         *
         * @return void
         */
        public function index()
        {
            $plans = app('rinvex.subscriptions.plan')::all();

            $plans->map(function ($plan) {
                $plan['status'] = $plan->is_active ? 'Active' : 'Inactive';
                return $plan;
            });

            // Return the result to jquery datatables
            if(request()->ajax())
            {
                return datatables()->of($plans)
                        ->addIndexColumn()
                        ->addColumn('action', function($row){
                            $btn = '<a href="javascript:void(0)"
                                    data-toggle="tooltip"  
                                    data-id="'.$row->id.'" 
                                    data-original-title="Edit" 
                                    class="edit btn btn-primary btn-sm btn-flat editPlan">
                                    Edit</a>';

                            $btn .= '<a href="javascript:void(0)" 
                                    data-toggle="tooltip"  data-id="'.$row->id.'" 
                                    data-original-title="Delete" 
                                    class="btn btn-danger btn-sm btn-flat deletePlan">
                                    Delete</a>';

                            return $btn;
                        })
                        ->rawColumns(['action'])
                        ->make(true);
            }

            return view('admin.plans.index');
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
            $id = $request->plan_id;
            $plan = app('rinvex.subscriptions.plan')::find($id);
            return response()->json($plan);
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
            $plan_id = $request->plan_id;

            if($plan_id)
            {
                $plan =  app('rinvex.subscriptions.plan')::find($plan_id);
                $success_message = 'Plan updated successfully';

                $validation_rules = [
                    'name' => 'required|string|max:255',
                    'description' => 'nullable|string|max:10000',
                    'price' => 'required|numeric',
                    'invoice-days' => 'required|numeric',
                    'status' => 'required'
                ]; 
            }
            else
            {
                $success_message = 'Plan added successfully';

                $validation_rules = [
                    'name' => 'required|string|max:255',
                    'description' => 'nullable|string|max:10000',
                    'price' => 'required|numeric',
                    'invoice-days' => 'required|numeric',
                    'status' => 'required'
                ]; 
            }

            $validator = Validator::make($request->all(), $validation_rules);

            if ($validator->fails()) 
            {
                return response()->json(['errors'=>$validator->errors()->all()]);
            }


            if($plan_id)
            {
                $plan->name = $request->input('name');
                $plan->description = $request->input('description');
                $plan->is_active = $request->input('status');
                $plan->price = $request->input('price');
                $plan->invoice_period = $request->input('invoice-days');
                $plan->save();
            }

            if(!$plan_id){
                app('rinvex.subscriptions.plan')->create([
                    'name' => $request->input('name'),
                    'description' => $request->input('description'),
                    'is_active' => $request->input('status'),
                    'price' => $request->input('price'),
                    'signup_fee' => 0.00,
                    'invoice_period' => $request->input('invoice-days'),
                    'invoice_interval' => 'day',
                    'sort_order' => 1,
                    'currency' => 'USD',
                ]);
            }

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
            $id = $request->plan_id;
            if(!empty($id))
            {   
                $plan = app('rinvex.subscriptions.plan')::find($id);
                if($plan->slug == 'basic')
                {
                    return response()->json(['errors'=>'A basic plan can not be deleted']);
                }      
                $plan->delete();
                return response()->json(['success'=>'The plan deleted successfully']);
            }
            else 
            {
                return response()->json(['errors'=>'The plan not deleted']);
            } 
        }
    }

