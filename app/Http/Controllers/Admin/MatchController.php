<?php

    /**
     * PHP Version 7.2.19 or newer
     * Functions for dashboard
     * 
     * @category    File
     * @package     Match
     * @author     Nkuke Henry
     * @copyright   henricsanyu@gmail.com
     */

    namespace App\Http\Controllers\Admin;

    use App\Http\Controllers\Controller;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Validator;
    use Carbon\Carbon;

    use App\Models\Game;
    use App\Models\Team;
  
 
    /**
     *  Class contain functions for admin
     *  @category   Class
     *  @package    Match
     *  @author     Henry nkuke
     *  @copyright  Tipostar
     */


    class MatchController 
    {
        /**
         * index
         *
         * @return void
         */
        public function index()
        {
            $matches = Game::all();

            // Format the result for the dashboard
            $matches->map(function($match){
              
                $homeTeam = Team::find($match->home_team);
                $awayTeam = Team::find($match->away_team);
                $match['game'] = $homeTeam->name.' vs '.$awayTeam->name;

                $match['supersingle'] = $match->is_supersingle ? 'supersingle' : '';

                $odds = explode(',',$match->odd_type);
             
                $match['match_date'] = Carbon::parse($match->match_date)->format('d-m-Y H:i');
                return $match;
            });


            // Return the result to jquery datatables
            if(request()->ajax())
            {
                return datatables()->of($matches)
                        ->addIndexColumn()
                        ->addColumn('action', function($row){
                            $btn = '<a href="javascript:void(0)"
                                    data-toggle="tooltip"  
                                    data-id="'.$row->id.'" 
                                    data-original-title="Edit" 
                                    class="edit btn btn-primary btn-sm btn-flat editMatch">
                                    Edit</a>';

                            $btn .= '<a href="javascript:void(0)" 
                                    data-toggle="tooltip"  data-id="'.$row->id.'" 
                                    data-original-title="Delete" 
                                    class="btn btn-danger btn-sm btn-flat deleteMatch">
                                    Delete</a>';

                            return $btn;
                        })
                        ->rawColumns(['action'])
                        ->make(true);
            }

            return view('admin.matches.index');  
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
            $id = $request->match_id;
            $match = Game::find($id);
            return response()->json($match);
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
            $match_id = $request->match_id;

            if($match_id)
            {
                $match = Game::find($match_id);
                $success_message = 'League updated successfully';

                $validation_rules = [
                    'outcome' => 'required|string',
                    'tag' => 'required|string'
                ];
            }

            else
            {
                $match = new Match();
                $success_message = 'Match added successfully';

                $validation_rules = [
                    'match-date' => 'required',
                    'home-team' => 'required|integer',
                    'away-team' => 'required|integer|different:home-team',
                    'odds' => 'required',
                    'outcome' => 'required|string',
                    'tag' => 'required|string'
                ];

            }

            $validator = Validator::make($request->all(), $validation_rules);

            if ($validator->fails()) 
            {
                return response()->json(['errors'=>$validator->errors()->all()]);
            }

            if($match_id)
            {
                $match->outcome = $request->input('outcome');
                $match->tag = $request->input('tag');  
            }
            else
            {
                $match_date = Carbon::parse($request->input('match-date'))->format('Y-m-d H:i:s');
                
                $odd_type = '';
                $odds = $request->input('odds');
                foreach($odds as $odd)
                {
                    $odd_type .= $odd .',';
                }
                $odd_type = substr($odd_type, 0, -1);

                $match->home_team = $request->input('home-team');
                $match->away_team = $request->input('away-team');
                $match->odd_type = $odd_type;
                $match->match_date = $match_date;
                $match->outcome = $request->input('outcome');
                $match->tag = $request->input('tag');
            }
            $match->save();

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
            $id = $request->match_id;
            if(!empty($id))
            {   
                Game::find($id)->delete();
                return response()->json(['success'=>'Match deleted']);
            }
            else 
            {
                return response()->json(['errors'=>'Match not deleted']);
            } 
        }


        /**
         * deleteSelected
         *
         * @param  mixed $request
         *
         * @return void
         */
        public function deleteSelected(Request $request)
        {
            foreach($request->matches as $matchId)
            {
                Game::find($matchId)->delete();
            }
            return response()->json(['success'=>'Matches deleted']);
        }

        
        /**
         * makeSupersingle
         *
         * @param  mixed $request
         *
         * @return void
         */
        public function makeSupersingle(Request $request)
        {
            foreach($request->matches as $matchId)
            {
                $match = Game::find($matchId);
                if($match->is_supersingle === (int)1) 
                {
                    $match->is_supersingle = 0;
                    $success_message = 'Supersingle removed successfully.';
                } 
                else 
                {
                    $match->is_supersingle = 1;
                    $success_message = 'Supersingle added successfully';
                } 
                $match->save();
            }
            return response()->json(['success'=>$success_message]);
        }
    }

   