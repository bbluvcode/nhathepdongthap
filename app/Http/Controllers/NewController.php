<?php

namespace App\Http\Controllers;

use App\Models\Ads;
use App\Models\News;
use Illuminate\Http\Request;

class NewController extends Controller
{
      //client
      public function news()
      {
        $news = News::where('type', 'NEWS')->get();
        $adsNews = Ads::where('type', 'NEWS')->get();
          return view("client.news",compact("news","adsNews"));
      }
  
  public function newsDetail()
  {
      // $newsDetail = News::find($id);
      // return view("client.newDetail",compact("newsDetail"));
      return view("client.detailNews");
  }
}
