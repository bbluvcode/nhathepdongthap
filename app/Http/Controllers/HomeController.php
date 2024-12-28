<?php

namespace App\Http\Controllers;

use App\Models\Ads;
use App\Models\Carausel;
use App\Models\Feedback;
use App\Models\IntroBenefit;
use App\Models\IntroHome;
use App\Models\IntroTvgs;
use App\Models\IntroVideo;
use App\Models\Outstanding;
use App\Models\PanelJob;
use App\Models\PanelJobImage;
use Illuminate\Http\Request;

class HomeController extends Controller
{
  public function home()
  {
    $nav_active = "home";

    $carausels = Carausel::all();
    $homeIntro = IntroHome::first();
    $benefitItems = IntroBenefit::all()->toArray();;
    $features_chunks = array_chunk($benefitItems, count($benefitItems) / 2);
    $introVideo = IntroVideo::first();
    $panelJobs = PanelJob::all();
    $outstandings = Outstanding::all();
    $feedbacks = Feedback::all();
    return view("client.home",compact("homeIntro",
    "features_chunks","carausels","introVideo",
    "panelJobs","outstandings","feedbacks","nav_active"));
  }

}
