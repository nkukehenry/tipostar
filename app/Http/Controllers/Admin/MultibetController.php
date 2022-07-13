<?php

    /**
     * PHP Version 7.2.19 or newer
     * Functions for dashboard
     * 
     * @category    File
     * @package     Multibet
     * @author     Nkuke Henry
     * @copyright   henricsanyu@gmail.com
    */

    namespace App\Http\Controllers\Admin;

    use App\Http\Controllers\Controller;
    use Illuminate\Http\Request;
    use Carbon\Carbon;


    use App\Models\MultiBetMatch;
    use App\Models\Match;
    use App\Models\Team;
    use App\Models\Odd;
    

    class MultibetController
    {
        /**
         * multibetMatches
         *
         * @return void
         */
        public static function multibetMatches()
        {
            $matches = Match::whereNotNull('multibet_id')->get();

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

                $multibet = MultiBetMatch::find($match->multibet_id);
                $multibetName = $multibet->name;
                $match['multibetName'] = $multibetName;
                
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
            $matches = self::multibetMatches();

            // Return the result to jquery datatables
            if(request()->ajax())
            {

                return datatables()->of($matches)
                        ->addIndexColumn()
                        ->addColumn('action', function($row){
                             $btn = '<a href="javascript:void(0)" 
                                        data-toggle="tooltip"  data-id="'.$row->id.'" 
                                        data-original-title="Delete" 
                                        class="btn btn-danger btn-sm btn-flat delete-from-multibet">
                                        Delete</a>';
                            return $btn;
                        })
                        ->rawColumns(['action'])
                        ->make(true);
            }
            return view('admin.multibets.index');  
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
            $count = MultiBetMatch::count();
            $count === 0 ? $name = 'Multibet #1' : $name = 'Multibet #'.(string)($count+1); 
            $multiBet = MultiBetMatch::create([
                'name' => $name
            ]);
            if($multiBet)
            {
                foreach($request->matches as $matchId)
                {
                    $match = Match::find($matchId);
                    $match->multibet_id = $multiBet->id;
                    $match->save();
                }
                return response()->json(['success'=>'Multibet created successfully']);
            }
            else 
            {
                return response()->json(['errors'=>'Multibet not created']); 
            }
        }


        /**
         *      delete
         *
         *      @param  mixed $request
         *      Remove match from multibet.
         *      Delete the multibet too if it has zero matches.
         *      @return 
         */
        
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
            $multibet_id = $match->multibet_id;
            $count = Match::where('multibet_id', '=', $multibet_id)->count();
            $match->multibet_id = NULL;
            $match->save();
            if ($count === 1)
            {
                MultiBetMatch::find($multibet_id)->delete();
            }
            return response()->json(['success'=> 'Match removed from multibet']);
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
                $match->multibet_id = NULL;
                $match->save();
            }
         
            $matches = Match::whereNotNull('multibet_id')->get();
            $count = $matches->count();
            /**
             * No match has multibet. Therefore empty the multibets table
             */
            if($count === 0) 
            {
                MultiBetMatch::whereNotNull('id')->delete();
            }
            /**
             * Some matches have multibets and we therefore delete only the multibets with no match
             */
            else
            {   
                $safe_ids = [];  // ids not to delete
                $remove_ids = []; // ids to delete

                foreach($matches as $match){
                    array_push($safe_ids, $match->multibet_id);
                }
                $safe_ids = array_unique($safe_ids);

                $multiBets = MultiBetMatch::all();
                foreach ($multiBets as $multiBet) 
                {
                    if(!in_array($multiBet->id, $safe_ids))
                    {
                        array_push($remove_ids, $multiBet->id);
                    }
                }
                
                foreach ($remove_ids as $id) 
                {
                    MultiBetMatch::find($id)->delete();
                }
            }
            return response()->json(['success'=>'Deletion Successful']);
        }

    }


