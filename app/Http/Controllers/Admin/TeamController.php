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

    use App\Models\League;
    use App\Models\Country;
    use App\Models\Team;

    /**
     *  Class contain functions for admin
     *  @category   Class
     *  @package    Team
     *  @author     Henry nkuke
     *  @copyright  Tipostar
     */

    class TeamController
    {
        /**
         * index
         *
         * @return void
         */
        public function index()
        {
            $teams = Team::all();

            // Append the country and league name of the team to the collection result
            $teams->map(function($team){
                $country = Country::find($team->country_id);
                $team['country'] = $country->name;
                return $team;
            });


            // Return the result to jquery datatables
            if(request()->ajax())
            {
                return datatables()->of($teams)
                        ->addIndexColumn()
                        ->addColumn('action', function($row){
                            $btn = '<a href="javascript:void(0)"
                                    data-toggle="tooltip"  
                                    data-id="'.$row->id.'" 
                                    data-original-title="Edit" 
                                    class="edit btn btn-primary btn-sm btn-flat editTeam">
                                    Edit</a>';

                            $btn = '<a href="javascript:void(0)"
                                    data-toggle="tooltip"  
                                    data-id="'.$row->id.'" 
                                    data-original-title="Leagues" 
                                    class="edit btn btn-primary btn-sm btn-flat">
                                    Leagues</a>';

                            $btn .= '<a href="javascript:void(0)" 
                                    data-toggle="tooltip"  data-id="'.$row->id.'" 
                                    data-original-title="Delete" 
                                    class="btn btn-danger btn-sm btn-flat deleteTeam">
                                    Delete</a>';

                            return $btn;
                        })
                        ->rawColumns(['action'])
                        ->make(true);
            }

            return view('admin.teams.index');
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
            $id = $request->team_id;
            $team = Team::find($id);
            return response()->json($team);
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
            $team_id = $request->team_id;

            if($team_id)
            {
                $team = Team::find($team_id);
                $success_message = 'Team updated successfully';

                $validation_rules = [
                    'name' => 'required|string|max:255|unique:teams,name,'.$team->id,
                    'league' => 'required'
                ];
               
            }
            else
            {
                $validation_rules = [
                    'name' => 'required|string|max:255|unique:teams',
                    'league' => 'required'
                ];
                $team = new Team();
                $success_message = 'Team added successfully';
            }

            $validator = Validator::make($request->all(), $validation_rules);

            if ($validator->fails()) 
            {
                return response()->json(['errors'=>$validator->errors()->all()]);
            }

            $team->name = $request->input('name');
            $team->league_id = $request->input('league');
            $team->save();

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
            $id = $request->team_id;
            if(!empty($id))
            {   
                Team::find($id)->delete();
                return response()->json(['success'=>'Team deleted successfully']);
            }
            else 
            {
                return response()->json(['errors'=>'Team not deleted']);
            } 
        }

      
        /**
         * getTeamsUnderLeague
         *
         * @param  mixed $request
         *
         * @return void
         */
        public function getTeamsUnderLeague(Request $request)
        {
            $LeagueId = $request->LeagueId;
            if(!empty($LeagueId))
            {   
                $teams = Team::where('league_id', $LeagueId)->get();
                return response()->json($teams);
            }
        }


    }