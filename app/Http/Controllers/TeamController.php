<?php

namespace App\Http\Controllers;
use App\Models\Team;
use App\Models\Players;
use App\Models\Team_player;
use App\Models\FormerPlayer;
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
    public function index()
    {
        $data = [
            'dota' => Team::where('game','dota')->select('id','team_name','team_image','cover_image','game','location','sort_no')->orderBy('sort_no')->take(3)->get(),
            'mlbb' => Team::where('game','mlbb')->select('id','team_name','team_image','cover_image','game','location','sort_no')->orderBy('sort_no')->take(3)->get(),
            'aov' => Team::where('game','aov')->select('id','team_name','team_image','cover_image','game','location','sort_no')->orderBy('sort_no')->take(3)->get(),
            'csgo' => Team::where('game','csgo')->select('id','team_name','team_image','cover_image','game','location','sort_no')->orderBy('sort_no')->take(3)->get(),
            'valorant' => Team::where('game','valorant')->select('id','team_name','team_image','cover_image','game','location','sort_no')->orderBy('sort_no')->take(3)->get(),
            'lol' => Team::where('game','lol')->select('id','team_name','team_image','cover_image','game','location','sort_no')->orderBy('sort_no')->take(3)->get()


        ];
        return response([
            'result' => $data,
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
        $sponsor = Sponsor::where('team_id',$id)->get();
        $achieve = Achieve::where('team_id',$id)->get();
        $former = FormerPlayer::where('team_id',$id)->get();
        $player = Team_player::where('team_id',$id)->first();

        $coach = 'n/a';
        if($player['coach_id'] != '-')
        {
            $coach = Players::where('id',$player['coach_id'])->first();
        }

        $analyst = 'n/a';
        if($player['coach_id'] != '-')
        {
            $analyst = Players::where('id',$player['analyst_id'])->first();
        }
        
        $roster = [
            'roster1' => Players::where('id',$player['pos1_id'])->first(),
            'roster2' => Players::where('id',$player['pos2_id'])->first(),
            'roster3' => Players::where('id',$player['pos3_id'])->first(),
            'roster4' => Players::where('id',$player['pos4_id'])->first(),
            'roster5' => Players::where('id',$player['pos5_id'])->first()

        ];

        $players = [
            'coach' => $coach,
            'analyst' => $analyst,
            'rosters' => $roster
        ];
        $data = [
            'stats' => $stats,
            'social_link' => $social,
            'player' => $players,
            'former_player' => $former,
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
