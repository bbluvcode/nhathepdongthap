<?php

namespace App\Http\Controllers;

use App\Models\Ads;
use App\Models\IntroTvgs;
use App\Models\News;
use App\Models\ProcessSup;
use App\Models\Quote;
use App\Models\SpecialAds;
use Illuminate\Http\Request;
use Session;

class TVGSController extends Controller
{
    private $nav_active = "thietke-thicong";
    public function tvgs()
    {    
        $introtvgs = IntroTvgs::first();

        // $newsTVSG = News::where('type', 'TVGS')->orderByDesc("timestamps")->get();
        $newsTVSG = News::where('type', 'TVGS')->orderByDesc("created_at")->get();

        $newsStandountTVSG = News::where('type', 'TVGSAT')->get();
        $specialAds = SpecialAds::first();
        $quote = Quote::where('type', 'TVGS')->first();
        return view("client.tvgs", compact(
            "introtvgs",
            "newsTVSG",
            "newsStandountTVSG",
            "specialAds",
            "quote"
        ))->with('nav_active', $this->nav_active);
    }
    public function newsDetail($slug)
    {
        $parts = explode('-', $slug);
        // Lấy phần tử cuối cùng trong mảng
        $lastPartId = (int) end($parts);
        $newsDetail = News::find($lastPartId);
        $cleanDescription = $this->cleanDescription($newsDetail->description);
        $newsOther = News::where('id', '!=', $lastPartId)->get();
        $adsDetail = Ads::where('type', 'DETAILNEWS')->get();
        return view("client.detailNews", compact("newsDetail", "newsOther", "adsDetail", "cleanDescription"))->with('nav_active', $this->nav_active);
    }
    // Hàm làm sạch description
    private function cleanDescription($description)
    {
        // 1. Giải mã HTML entities (ví dụ: &agrave; thành à)
        $description = html_entity_decode($description);

        // 2. Loại bỏ tất cả thẻ HTML
        $description = strip_tags($description);

        // 3. Cắt bỏ khoảng trắng thừa ở đầu và cuối
        $description = trim($description);

        // Trả về mô tả đã làm sạch
        return $description;
    }
    //admin
    public function viewTvsg()
    {
        $introTVSG = IntroTvgs::first();
        $newsTVSG = News::where('type', 'TVGS')->get();
        $adsTVSG = Ads::where('type', 'TVGS')->get();
        $specialAds = SpecialAds::first();
        return view("admin.tvgs.index", compact("introTVSG", "newsTVSG", "adsTVSG", "specialAds"))->with('nav_active', $this->nav_active);
    }
    public function createIntroTVSG(Request $request)
    {
        $request->validate([
            "description" => 'required',
        ]);
        IntroTvgs::create([
            "description" => $request->description,
        ]);
        return redirect()->back()->with('message', 'intro created successfully.');

    }
    public function updateIntroTVSG(Request $request, IntroTvgs $introTVSG)
    {
        $request->validate([
            "description" => 'required',
        ]);
        $introTVSG->update([
            "description" => $request->description,
        ]);
        return redirect()->back()->with('message', 'intro updated successfully.');

    }

    public function process()
    {
        $isUpdateProcess = Session::get('isUpdateProcess', null);
        $processes = ProcessSup::orderBy('order', 'asc')->get();
        return view("admin.process.index", compact('processes'));
    }
    public function storeProcess(Request $request)
    {
        $request->validate([
            "title" => 'required',
        ]);
        $maxOrder = ProcessSup::max('order'); // Lấy order lớn nhất
        $newOrder = $maxOrder + 1; // Tăng thêm 1
        ProcessSup::create([
            "title" => $request->title,
            "order" => $newOrder,
        ]);
        return redirect()->back()->with('message', 'process item created successfully.');
    }
    public function updateOrder(Request $request)
    {
        $order = $request->input('order'); // Nhận dữ liệu từ AJAX

        foreach ($order as $item) {
            // Cập nhật thứ tự mới vào database
            ProcessSup::where('id', $item['id'])->update(['order' => $item['position']]);
        }

        return response()->json(['message' => true]);
    }
    // Cập nhật item
    public function updateProcess(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string'
        ]);

        $item = ProcessSup::findOrFail($id);
        $item->title = $request->title;
        $item->save();
        return redirect()->back()->with('message', 'process item update successfully.');
    }
    // delete item process
    public function deleteItemProcess($id)
    {
        try {
            $item = ProcessSup::find($id);
            $item->delete();
            return redirect()->back()->with('message', 'process item deleted successfully.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('message', 'opp something went wrong.');
        }

    }
}
