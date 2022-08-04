<?php

namespace App\Http\Controllers;
use App\Models\Tournament;
use App\Models\GroupStage;
use App\Models\RegularSeason;
use App\Models\TourMvp;
use App\Models\TourPrizePool;
use App\Models\Social;
use App\Models\TourMatch;
use App\Models\TourKill;
use App\Models\TourAsist;
use App\Models\Sponsor;
use Illuminate\Contracts\Support\Jsonable;
use Carbon\Carbon;

use Illuminate\Http\Request;

class TourController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tours = Tournament::orderBy('created_at','desc')->select('name','tour_image','start_date','from_to','prize_pool')->paginate();
        $upcoming = [];
        $complete = [];
        $ongoing = [];


        foreach($tours as $tour)
        {
            if(Carbon::now('Asia/Yangon')->format('d.m.Y') <= $tour['from_to'])
                {
                    $upcoming[] = Tournament::where('from_to',$tour['from_to'])->select('name','tour_image','start_date','from_to','prize_pool')->get();
                }

            if(Carbon::now('Asia/Yangon')->format('d.m.Y') == $tour['from_to'])
                {
                    $ongoing[] = Tournament::where('from_to',$tour['from_to'])->select('name','tour_image','start_date','from_to','prize_pool')->get();
                }
            if(Carbon::now('Asia/Yangon')->format('d.m.Y') >= $tour['from_to'])
                {
                    $complete[] = Tournament::where('from_to',$tour['from_to'])->select('name','tour_image','start_date','from_to','prize_pool')->get();
                }
        }

        $data = [
            'tournament' => $tours,
            'upcoming' => $upcoming,
            'complete' => $complete,
            'ongoing' => $ongoing
        ];

        return response([
            'result' => $data,
            'statusCode' => 200,
            'message' => 'Success'
        ]);
    }

    // public function index()
    // {
    //     $tours = Tournament::orderBy('created_at','desc')->select('name','tour_image','start_date','from_to','prize_pool')->get();
    //     $upcoming = [];
    //     $complete = [];
    //     $ongoing = [];


    //     foreach($tours as $tour)
    //     {
    //         if(Carbon::now('Asia/Yangon')->format('d.m.Y') <= $tour['from_to'])
    //             {
    //                 $upcoming[] = Tournament::where('from_to',$tour['from_to'])->select('name','tour_image','start_date','from_to','prize_pool')->get();
    //             }

    //         if(Carbon::now('Asia/Yangon')->format('d.m.Y') == $tour['from_to'])
    //             {
    //                 $ongoing[] = Tournament::where('from_to',$tour['from_to'])->select('name','tour_image','start_date','from_to','prize_pool')->get();
    //             }
    //         if(Carbon::now('Asia/Yangon')->format('d.m.Y') >= $tour['from_to'])
    //             {
    //                 $complete[] = Tournament::where('from_to',$tour['from_to'])->select('name','tour_image','start_date','from_to','prize_pool')->get();
    //             }
    //     }

    //     $data = [
    //         'tournament' => $tours,
    //         'upcoming' => $upcoming,
    //         'complete' => $complete,
    //         'ongoing' => $ongoing
    //     ];
    //     $result = [
    //         'data' => $data
    //     ];
    //     return response([
    //         'result' => $result,
    //         'statusCode' => 200,
    //         'message' => 'Success'
    //     ]);
    // }

    
    
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
        if(!Tournament::where('id',$id)->first())
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

        $stats = Tournament::where('id',$id)->first();
        $social = Social::where('tour_id',$id)->get();
        $sponsor = Sponsor::where('tour_id',$id)->get();
        $tour_pp = TourPrizePool::where('tour_id',$id)->get();
        $tour_k = TourKill::where('tour_id',$id)->get();
        $tour_a = TourAsist::where('tour_id',$id)->get();
        $tour_mvp = TourMvp::where('tour_id',$id)->get();



        $data = [
            'stats' => $stats,
            'social_link' => $social,
            'sponsor' => $sponsor,
            'tour_prize_pool' => $tour_pp,
            'tour_mvp' => $tour_mvp,
            'tour_kill' => $tour_k,
            'tour_assit' => $tour_a


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
