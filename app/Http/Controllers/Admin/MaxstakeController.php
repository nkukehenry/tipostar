<?php

    /**
     * PHP Version 7.2.19 or newer
     * Functions for dashboard
     * 
     * @category    File
     * @package     Maxstake
     * @author     Nkuke Henry
     * @copyright   henricsanyu@gmail.com
    */

    namespace App\Http\Controllers\Admin;

    use App\Http\Controllers\Controller;
    use Illuminate\Http\Request;
    use Carbon\Carbon;

    use App\Models\MaxStakeMatch;
    use App\Models\Match;
    use App\Models\Team;
    use App\Models\Odd;

    class MaxstakeController
    {

        /**
         * MaxstakeMatches
         *
         * @return void
         */
        public static function MaxstakeMatches()
        {
            $matches = Match::whereNotNull('maxstake_id')->get();

            // Format the result for the dashboard
            $matches->map(function($match){
              
                $homeTeam = Team::find($match->home_team);
                $awayTeam = Team::find($match->away_team);
                $match['game'] = $homeTeam->name.' vs '.$awayTeam->name;

                $odds = explode(',',$match->odd_type);
                $oddTypeNames = '';
                foreach($odds as $odd)
                {
                    $oddTypeName = Odd::find($odd);
                    $oddTypeNames .= $oddTypeName->name .',';
                }
                $oddTypeNames= substr($oddTypeNames, 0, -1);
                $match['odd_type'] = $oddTypeNames;

                $maxstake = MaxStakeMatch::find($match->maxstake_id);
                $maxstakeName = $maxstake->name;
                $match['maxstakeName'] = $maxstakeName;
                
                $match['match_date'] = Carbon::parse($match->match_date)->format('d-m-Y H:i');
                return $match;
            });

            return $matches; 
        }

        /**
         * index
         *
         * @return void
         */
        public function index()
        {
           
            $matches = self::MaxstakeMatches();
            
            // Return the result to jquery datatables
            if(request()->ajax())
            {

                return datatables()->of($matches)
                        ->addIndexColumn()
                        ->addColumn('action', function($row){
                             $btn = '<a href="javascript:void(0)" 
                                        data-toggle="tooltip"  data-id="'.$row->id.'" 
                                        data-original-title="Delete" 
                                        class="btn btn-danger btn-sm btn-flat delete-from-maxstake">
                                        Delete</a>';
                            return $btn;
                        })
                        ->rawColumns(['action'])
                        ->make(true);
            }
            return view('admin.maxstake.index');  
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
            $count = MaxStakeMatch::count();
            $count === 0 ? $name = 'MaxStake #1' : $name = 'MaxStake #'.(string)($count+1); 
            $MaxStake = MaxStakeMatch::create([
                'name' => $name
            ]);
            if($MaxStake)
            {
                foreach($request->matches as $matchId)
                {
                    $match = Match::find($matchId);
                    $match->maxstake_id = $MaxStake->id;
                    $match->save();
                }
                return response()->json(['success'=>'Maxstake created successfully']);            }
            else 
            {
                return response()->json(['errors'=>'Maxstake not created']); 
            }
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
            $match = Match::find($request->match_id);
            $maxstake_id = $match->maxstake_id;
            $count = Match::where('maxstake_id', '=', $maxstake_id)->count();
            $match->maxstake_id = NULL;
            $match->save();
            if ($count === 1)
            {
                MaxStakeMatch::find($maxstake_id)->delete();
            }
            return response()->json(['success'=> 'Match removed from maxstake']);
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
            foreach($request->matches as $match_id)
            {
                $match = Match::find($match_id);
                $match->maxstake_id = NULL;
                $match->save();
            }
         
            $matches = Match::whereNotNull('maxstake_id')->get();
            $count = $matches->count();
            /**
             * No match has maxStake. Therefore empty the maxStakes table
             */
            if($count === 0) 
            {
                MaxStakeMatch::whereNotNull('id')->delete();
            }
            /**
             * Some matches have maxStakes and we therefore delete only the maxStakes with no match
             */
            else
            {   
                $safe_ids = [];  // ids not to delete
                $remove_ids = []; // ids to delete

                foreach($matches as $match){
                    array_push($safe_ids, $match->maxstake_id);
                }
                $safe_ids = array_unique($safe_ids);

                $maxStakes = MaxStakeMatch::all();
                foreach ($maxStakes as $maxStake) 
                {
                    if(!in_array($maxStake->id, $safe_ids))
                    {
                        array_push($remove_ids, $maxStake->id);
                    }
                }
                
                foreach ($remove_ids as $id) 
                {
                    MaxStakeMatch::find($id)->delete();
                }
            }
            return response()->json(['success'=>'Deletion Successful']);
        }

    }