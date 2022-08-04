<?php

namespace App\Http\Controllers;
use App\Models\Players;
use App\Models\Team;
use App\Models\Achieve;
use App\Models\Career;
use App\Models\Social;
use App\Models\Sponsor;
use App\Models\GameCategory;
use App\Models\Signature;
use Illuminate\Http\Request;
use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Pagination\Paginator;

class CreatorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $players = [
            'dota' => Players::where('game','dota')->where('talent','creator')->orderBy('sort_no')->take(3)->get(),
            'mlbb' => Players::where('game','mlbb')->where('talent','creator')->orderBy('sort_no')->take(3)->get(),
            'aov' => Players::where('game','aov')->where('talent','creator')->orderBy('sort_no')->take(3)->get(),
            'valorant' => Players::where('game','valorant')->where('talent','creator')->orderBy('sort_no')->take(3)->get(),
            'lol' => Players::where('game','lol')->where('talent','creator')->orderBy('sort_no')->take(3)->get(),
            'csgo' => Players::where('game','csgo')->where('talent','creator')->orderBy('sort_no')->take(3)->get()
        ];

        // $data = [];

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
        
        $result = [
            'data' => $players
        ];
        return response([
            'result' => $players,
            'statusCode' => 200,
            'message' => 'Success'
        ]);
        
    }

    public function showByGame($name)
    {
        $players = Players::where('talent','creator')->select('id','name','team_id','player_image','cover_image','game','location')->orderBy('sort_no')->paginate();

        $data = [];

        if($name != 'all')
        {
            $players = Players::where('talent','creator')->where('game',$name)->select('id','name','player_image','cover_image','game','location')->orderBy('sort_no')->get();
        }

        foreach($players as $player)
        {
            $data[] = [
                'id' => $player['id'],
                'name' => $player['name'],
                'player_image' => $player['player_image'],
                'cover_image' => $player['cover_image'],
                'game' => GameCategory::where('talent_id',$player['id'])->get(),
                'location' => $player['location']
            ];
        }
        
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
        if(!Players::where('talent','creator')->where('id',$id)->first())
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

        $stats = Players::where('id',$id)->first();
        $social = Social::where('player_id',$id)->get();
        $sponsor = Sponsor::where('player_id',$id)->get();
        $game = GameCategory::where('talent_id',$id)->get();
        $achieve = Achieve::where('player_id',$id)->get();
        $career = Career::where('player_id',$id)->get();
        $data = [
            'stats' => $stats,
            'social_link' => $social,
            'sponsor' => $sponsor,
            'games' => $game,
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

    public function showByGameFilter($name, $filter)
    {   

        if(!Players::where('talent','creator')->where('game',$name)->first())
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
        $result = [
            'data' => Players::where('talent','creator')->where('game',$name)->paginate()
        ];

        if ($filter != 'all')
        {
            $result = [
                'data' => Players::where('talent','creator')->where('game',$name)->where('status',$filter)
                ->paginate()
            ];
        }
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
