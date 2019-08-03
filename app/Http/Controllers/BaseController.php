<?php
/**
 * Created by PhpStorm.
 * User: kelvin_david
 * Date: 7/6/19
 * Time: 3:55 AM
 */

namespace App\Http\Controllers;






use App\Matches;
use Illuminate\Support\Facades\View;

class BaseController extends Controller
{
    public function __construct()
    {
//        $confirmed_recent_activity =  Matches::where(['initator'=>Auth::user()->id,'confirmed'=>'1'])->where('recipient', '!=', Auth::user()->id )->latest()->limit(6)->get();
//
//        // Sharing is caring
//        View()->share('confirmed_recent_activity',  $confirmed_recent_activity);

    }

}