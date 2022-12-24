<?php

namespace App\Http\Controllers;
use App\Models\Team;
use App\Models\Players;
use App\Models\Team_player;
use App\Models\FormerPlayer;
use App\Models\Rosters;
use App\Models\Achieve;
use App\Models\Social;
use App\Models\Sponsor;
use App\Models\Signature;
use Illuminate\Http\Request;
use Illuminate\Contracts\Support\Jsonable;



class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $teams = Team::where('visable','1')->select('id','team_name','team_image','cover_image','game','location','city','sort_no')->orderBy('sort_no','DESC')->orderBy('team_name')->paginate();
        
        if($request->gameType!='')
        {
            $teams = Team::where('visable','1')->where('game',$request->gameType)->select('id','team_name','team_image','cover_image','game','location','city','sort_no')->orderBy('sort_no','DESC')->orderBy('team_name')->paginate();
            
            if($request->status!='')
            {   

                    if ($request->gameType=='all' && $request->status =='all')
                    {
                        $teams = Team::where('visable','1')->select('id','team_name','team_image','cover_image','game','location','city','sort_no')->orderBy('sort_no','DESC')->orderBy('team_name')->paginate();
                    }
                    elseif($request->gameType=='all')
                    {
                        $teams = Team::where('status',$request->status)->where('visable','1')->select('id','team_name','team_image','cover_image','game','city','location','sort_no')->orderBy('sort_no','DESC')->orderBy('team_name')->paginate();
                    }
                    elseif($request->status=='all')
                    {
                        $teams = Team::where('game',$request->gameType)->where('visable','1')->select('id','team_name','team_image','cover_image','game','location','city','sort_no')->orderBy('sort_no','DESC')->orderBy('team_name')->paginate();
                    }
                    else
                    {
                        $teams = Team::where('game',$request->gameType)->where('visable','1')->where('status',$request->status)->select('id','team_name','team_image','cover_image','game','city','location','sort_no')->orderBy('sort_no','DESC')->orderBy('team_name')->paginate();
                    }
            }

        }
        $pagination = [
            'lastPage' => $teams->lastPage(),
            'currentPage' => $teams->currentPage(),
            'perPage' => $teams->count(),
            'totalItems' => $teams->total()
        ];
        $result = [
            'data' => $teams->items(),
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
        if(!Team::where('game',$name)->first())
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

        $teams = Team::where('game',$name)->select('id','team_name','team_image','cover_image','game','location')->orderBy('sort_no')->paginate();
        $pagination = [
            'lastPage' => $teams->lastPage(),
            'currentPage' => $teams->currentPage(),
            'perPage' => $teams->count(),
            'totalItems' => $teams->total()
        ];
        $result = [
            'data' => $teams->items(),
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

        if(!Team::where('game',$name)->first())
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
        
        $teams = Team::where('game',$name)->where('status',$filter)->select('id','team_name','team_image','cover_image','game','location')->orderBy('sort_no')->paginate();
        if ($filter != 'all')
        {
            $teams = Team::where('game',$name)->where('status',$filter)->select('id','team_name','team_image','cover_image','game','location')->orderBy('sort_no')->paginate();
        }
        $pagination = [
            'lastPage' => $teams->lastPage(),
            'currentPage' => $teams->currentPage(),
            'perPage' => $teams->count(),
            'totalItems' => $teams->total()
        ];

        $result = [
            'data' => $teams->items(),
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
        if(!Team::where('id',$id)->first())
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

        $stats = Team::where('id',$id)->first();
        $social = Social::where('team_id',$id)->get();
        if($social->isEmpty())
        {
            $social = NULL; 
        }
        $statsOverall = [
            'detail' => $stats,
            'social' => $social
        ];

        $sponsor = Sponsor::where('team_id',$id)->orderBy('sort_no','DESC')->get();
        $achieve = Achieve::where('team_id',$id)->where('player_id','-')->where('as','team')->select('tour_name','tour_logo','tier','place','sort_no')->orderBy('sort_no','DESC')->get();
        $formers = FormerPlayer::join('players','former_players.player_id','=','players.id')
                                ->where('former_players.team_id','=',$id)
                                ->join('teams','players.team_id','=','teams.id')
                                ->select('players.id','players.talent','players.name','players.player_image','players.game','players.location','players.city','former_players.from_time','former_players.to_time','teams.team_image')
                                ->orderBy('former_players.sort_no','DESC')
                                ->orderBy('players.name')
                                ->get();
        
        $players = NULL;
        
        $player = Team_player::where('team_id',$id)->first();
        $rostercheck = Rosters::where('team_id',$id)->first();
        
        if ($rostercheck)
        {
        $headcoach = NULL;
        $asistcoach = NULL;
        $tdirector = NULL;
        $analyst = NULL;
        $roster = NULL;
        if($player)
        {
            
        $headcoach = Players::where('id',$player['head_coach_id'])->first();
        $analyst = Players::where('id',$player['analyst_id'])->first();
        $asistcoach = Players::where('id',$player['a_coach_id'])->first();
        $tdirector = Players::where('id',$player['t_director_id'])->first();
        
        
    
        if($headcoach == '')
        {
            $headcoach = NULL;
        }
        
        if($asistcoach == '')
        {
            $asistcoach = NULL;
        }
        
        if($tdirector == '')
        {
            $tdirector = NULL;
        }

        
        if($analyst == '')
        {
            $analyst = NULL;
        }
        
        }
        
        $roster = Rosters::join('players','rosters.player_id','=','players.id')
                            ->where('rosters.team_id','=',$id)
                            ->select('players.id','players.name','players.talent','players.player_image','players.game','players.location','players.city')
                            ->orderBy('players.name')
                            ->get();
        if($roster->isEmpty())
        {
            $roster = NULL;
        }
        
        $players = [
            'headcoach' => $headcoach,
            'asistcoach' => $asistcoach,
            'technicaldirector' => $tdirector,
            'analyst' => $analyst,
            'roster' => $roster
        ];
        }
        
        if($sponsor->isEmpty())
        {
            $sponsor = NULL; 
        }
        if($achieve->isEmpty())
        {
            $achieve = NULL; 
        }
        if($formers->isEmpty())
        {
            $formers = NULL; 
        }
        $data = [
            'stats' => $statsOverall,
            'player' => $players,
            'former_player' => $formers,
            'sponsor' => $sponsor,
            'achieve' => $achieve
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
