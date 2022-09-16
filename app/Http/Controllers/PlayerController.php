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
                            ->join('teams','players.team_id','=','teams.id')
                            ->select('players.*','teams.team_name','teams.team_image')
                            ->paginate();

        if($request->gameType!='')
        {
            $players = Players::where('talent','player')
                            ->where('game',$request->gameType)
                            ->join('teams','players.team_id','=','teams.id')
                            ->select('players.*','teams.team_name','teams.team_image')
                            ->paginate();
            if($request->status!='')
                {
                    $players = Players::where('talent','player')
                                    ->where('game',$request->gameType)
                                    ->where('status',$request->status)
                                    ->join('teams','players.team_id','=','teams.id')
                                    ->select('players.*','teams.team_name','teams.team_image')
                                    ->paginate();
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
            ->orderBy('players.sort_no')
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

        $stats = Players::where('id',$id)->first();
        $statsOverall = [
            'detail' => $stats,
            'signature' => $signature,
            'social' => $social
        ];
        
        $social = Social::where('player_id',$id)->get();
        $signature = Signature::where('player_id',$id)->get();
        $sponsor = Sponsor::where('player_id',$id)->get();
        $achieve = Achieve::where('player_id',$id)->get();
        $career = Career::where('player_id',$id)->get();
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
