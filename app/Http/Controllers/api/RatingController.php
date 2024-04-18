<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Rating;
use Illuminate\Http\Request;

use function PHPUnit\Framework\isEmpty;

class RatingController extends Controller
{
    public function index(){
        if(isset($_GET['user_id']) && isset($_GET['movie_id']) && isEmpty($_GET['user_id']) && isEmpty($_GET['movie_id']) && is_numeric($_GET['user_id']) && is_numeric($_GET['movie_id'])){
            $rating = Rating::where('user_id', $_GET['user_id'])->where('movie_id', $_GET['movie_id'])->first();
            if($rating){
                return response()->json([
                    'data'=>[
                        'Ratings'=>$rating->movie->getRatingAttribute(),
                        'Rating'=>$rating->rating,
                    ],
                     'Response' => 'True'
                ]);
            }

        }
        return response()->json([
            'message'=>'Invalid Request',
             'Response' => 'False'
        ]);
    }
    public function store(Request $request){
        $validatedData = $request->validate([
            'movie_id' => 'required|integer',
            'user_id' => 'required|integer',
            'rating' => 'required|integer',


        ]);
        $rating = Rating::where('user_id', $request->user_id)->where('movie_id', $request->movie_id)->first();
        if(!$rating){
            $rating =new Rating();
            $rating->movie_id = $request->movie_id;
            $rating->user_id = $request->user_id;
            $rating->rating = $request->rating;
            $rating->save();
        }else{
            $rating->rating=$request->rating;
            $rating->save();
        }


        return response()->json([
            'Ratings'=>$rating->movie->getRatingAttribute(),
            'message'=>'process is  done successfully',
            'Response' => 'True'
        ]);



    }
}
