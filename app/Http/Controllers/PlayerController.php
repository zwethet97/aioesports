<?php

namespace App\Http\Controllers;
use App\Models\Players;
use App\Models\Team;
use App\Models\Achieve;
use App\Models\Career;
use App\Models\Social;
use App\Models\Sponsor;
use App\Models\Signature;
use Illuminate\Http\Request;
use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Pagination\Paginator;

class PlayerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        $players = Players::where('talent','player')
                             ->leftJoin('teams',function($join){
                                 $join->on('players.team_id','=','teams.id')
                                        ->whereNotNull('players.team_id');
                                        })
                            ->where('players.visable','=','1')
                            ->select('players.*','teams.team_name','teams.team_image')
                            ->orderBy('players.sort_no','DESC')
                            ->orderBy('players.name')
                            ->paginate();
        if($request->gameType!='')
        {
            $players = Players::where('talent','player')
                            ->leftJoin('teams',function($join){
                                 $join->on('players.team_id','=','teams.id')
                                        ->whereNotNull('players.team_id');
                                        })
                            ->where('players.game','=',$request->gameType)
                            ->where('players.visable','=','1')
                            ->select('players.*','teams.team_name','teams.team_image')
                            ->orderBy('players.sort_no','DESC')
                            ->orderBy('players.name')
                            ->paginate();   
            
            if($request->status!='')
            {   

                    if ($request->gameType=='all' && $request->status =='all')
                    {
                        $players = Players::where('talent','player')
                            ->leftJoin('teams',function($join){
                                 $join->on('players.team_id','=','teams.id')
                                        ->whereNotNull('players.team_id');
                                        })
                            ->where('players.visable','=','1')
                            ->select('players.*','teams.team_name','teams.team_image')
                            ->orderBy('players.sort_no','DESC')
                            ->orderBy('players.name')
                            ->paginate();
                    }
                    elseif($request->gameType=='all')
                    {
                        $players = Players::where('talent','player')
                                    ->leftJoin('teams',function($join){
                                 $join->on('players.team_id','=','teams.id')
                                        ->whereNotNull('players.team_id');
                                        })
                                    ->where('players.status','=',$request->status)
                                    ->where('players.visable','=','1')
                                    ->select('players.*','teams.team_name','teams.team_image')
                                    ->orderBy('players.sort_no','DESC')
                                    ->orderBy('players.name')
                                    ->paginate();
                    }
                    elseif($request->status=='all')
                    {
                        $players = Players::where('talent','player')
                                    ->leftJoin('teams',function($join){
                                 $join->on('players.team_id','=','teams.id')
                                        ->whereNotNull('players.team_id');
                                        })
                                    ->where('players.game','=',$request->gameType)
                                    ->where('players.visable','=','1')
                                    ->select('players.*','teams.team_name','teams.team_image')
                                    ->orderBy('players.sort_no','DESC')
                                    ->orderBy('players.name')
                                    ->paginate();
                    }
                    else
                    {
                        $players = Players::where('talent','player')
                                    ->leftJoin('teams',function($join){
                                 $join->on('players.team_id','=','teams.id')
                                        ->whereNotNull('players.team_id');
                                        })
                                    ->where('players.game','=',$request->gameType)
                                    ->where('players.status','=',$request->status)
                                    ->where('players.visable','=','1')
                                    ->select('players.*','teams.team_name','teams.team_image')
                                    ->orderBy('players.sort_no','DESC')
                                    ->orderBy('players.name')
                                    ->paginate();                              
                    }
            }

        }
        $pagination = [
            'lastPage' => $players->lastPage(),
            'currentPage' => $players->currentPage(),
            'perPage' => $players->count(),
            'totalItems' => $players->total()
        ];
        $result = [
            'data' => $players->items(),
            'pagination' => $pagination
        ];
        return response([
            'result' => $result,
            'statusCode' => 200,
            'message' => 'Success'
        ]);
        
    }

    public function showByGame($name)
    {
        $players = Players::where('talent','player')
                            ->join('teams','players.team_id','=','teams.id')
                            ->where('players.game','=',$name)
                            ->select('players.*','teams.team_name','teams.team_image')
                            ->orderBy('players.sort_no')
                            ->paginate();
        // $data = [];

        // if($name != 'all')
        // {
        //     $players = Players::join('teams','players.team_id','=','teams.id')
        //     ->join('players','players.game','=',$name)
        //     ->join('players','players.talent','=','player')
        //     ->select('players.*','teams.team_name','teams.team_image')
        //     ->paginate();
        // }

        // foreach($players as $player)
        // {
        //     $data[] = [
        //         'id' => $player['id'],
        //         'name' => $player['name'],
        //         'team' => Team::where('id',$player['team_id'])->select('name','team_image')->get(),
        //         'player_image' => $player['player_image'],
        //         'cover_image' => $player['cover_image'],
        //         'game' => $player['game'],
        //         'location' => $player['location']
        //     ];
        // }
        
        $pagination = [
            'lastPage' => $players->lastPage(),
            'currentPage' => $players->currentPage(),
            'perPage' => $players->count(),
            'totalItems' => $players->total()
        ];
        $result = [
            'data' => $players->items(),
            'pagination' => $pagination
        ];
        return response([
            'result' => $result,
            'statusCode' => 200,
            'message' => 'Success'
        ]);
        
    }

    public function showByGameFilter($name, $filter)
    {   

        if(!Players::where('talent','player')->where('game',$name)->first())
        { 
            $result = [
                'data' => ''
            ];
            return response([
                'result' => $result,
                'statusCode' => 404,
                'message' => 'False'
            ]);

        }

        $players = Players::where('talent','player')->join('teams','players.team_id','=','teams.id')
            ->where('players.game','=',$name)
            ->where('players.talent','=',$name)
            ->select('players.*','teams.team_name','teams.team_image')
            ->orderBy('players.sort_no','DESC')
            ->paginate();
        

        if ($filter != 'all')
        {
           $players = Players::where('talent','player')->join('teams','players.team_id','=','teams.id')
                ->where('players.game','=',$name)
                ->where('players.status','=',$filter)
                ->select('players.*','teams.team_name','teams.team_image')
                ->paginate();
        }

        if ($filter == 'noactive')
        {
            $players = Players::where('talent','player')
                ->where('game','=',$name)
                ->where('status','=',$filter)
                ->paginate();
        }

        $pagination = [
            'lastPage' => $players->lastPage(),
            'currentPage' => $players->currentPage(),
            'perPage' => $players->count(),
            'totalItems' => $players->total()
        ];
        $result = [
            'data' => $players->items(),
            'pagination' => $pagination
        ];
        return response([
            'result' => $result,
            'statusCode' => 200,
            'message' => 'Success'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(!Players::where('talent','player')->where('id',$id)->first())
        {   
            $result = [
                'data' => ''
            ];
            return response([
                'result' => $result,
                'statusCode' => 404,
                'message' => 'False'
            ]);
        }
        
        $stats = Players::where('talent','player')->where('id',$id)->first();
        $statsdetail = Players::where('talent','player')->where('id',$id)->first();
        
        if($stats['team_id'] != NULL)
        {
            $statsdetail = Players::where('talent','player')
                            ->join('teams','players.team_id','=','teams.id')
                            ->where('players.id','=',$id)
                            ->select('players.*','teams.team_name','teams.team_image','teams.id')
                            ->first();
        }
        $social = Social::where('player_id',$id)->get();
        $signature = Signature::where('player_id',$id)->get();
        if($social->isEmpty())
        {
            $social = NULL; 
        }
        if($signature->isEmpty())
        {
            $signature = NULL; 
        }
        
        $statsOverall = [
            'detail' => $statsdetail,
            'signature' => $signature,
            'social' => $social
        ];
        
        $sponsor = Sponsor::where('player_id',$id)->orderBy('sort_no','DESC')->get();
        $ascoach = Achieve::where('player_id',$id)->join('teams','achieves.team_id','=','teams.id')
                        ->select('achieves.tour_logo','achieves.tour_name','achieves.as','achieves.tier','achieves.place','achieves.sort_no','teams.team_name','teams.team_image','teams.id')
                        ->where('achieves.as','coach')
                        ->orderBy('achieves.sort_no','DESC')
                        ->get();
        $ascaster = Achieve::where('player_id',$id)
                        ->select('tour_logo','tour_name','as','tier','place','sort_no')
                        ->where('as','caster')
                        ->orderBy('achieves.sort_no','DESC')
                        ->get();
        $asplayer = Achieve::where('player_id',$id)->join('teams','achieves.team_id','=','teams.id')
                        ->select('achieves.tour_logo','achieves.tour_name','achieves.as','achieves.tier','achieves.place','achieves.sort_no','teams.team_name','teams.team_image','teams.id')
                        ->where('achieves.as','player')
                        ->orderBy('achieves.sort_no','DESC')
                        ->get();
        $ascreator = Achieve::where('player_id',$id)->join('teams','achieves.team_id','=','teams.id')
                        ->where('achieves.as','creator')
                        ->select('achieves.tour_logo','achieves.tour_name','achieves.as','achieves.tier','achieves.place','achieves.sort_no','teams.team_name','teams.team_image','teams.id')
                        ->orderBy('achieves.sort_no','DESC')
                        ->get();
        if($ascoach->isEmpty())
        {
            $ascoach = NULL; 
        }
        if($ascaster->isEmpty())
        {
            $ascaster = NULL; 
        }
        if($asplayer->isEmpty())
        {
            $asplayer = NULL; 
        }
        
        $achieve = [
            'as caster' => $ascaster,
            'as coach' => $ascoach,
            'as player' => $asplayer
        
            ];

        $career = Career::where('player_id',$id)->join('teams','careers.team_id','=','teams.id')
                        ->select('careers.from_time','careers.to_time','teams.team_name','teams.team_image','teams.id','teams.city','teams.location')
                        ->orderBy('careers.sort_no','DESC')->get();
        if($career->isEmpty())
        {
            $career = NULL; 
        }
        if($sponsor->isEmpty())
        {
            $sponsor = NULL; 
        }

        $data = [
            'stats' => $statsOverall,
            'sponsor' => $sponsor,
            'achieve' => $achieve,
            'career' => $career
        ];
        $result = [
            'data' => $data
        ];
        return response([
            'result' => $result,
            'statusCode' => 200,
            'message' => 'Success'
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
