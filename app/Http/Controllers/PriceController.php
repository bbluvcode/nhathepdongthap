<?php

namespace App\Http\Controllers;

use App\Models\Ads;
use App\Models\Contact;
use App\Models\News;
use App\Models\NotePrice;
use App\Models\Price;
use App\Models\ProcessSup;
use Illuminate\Http\Request;
use PDF;

class PriceController extends Controller
{
  public function price()
  {
    $list = Price::all();
    $notePrice = NotePrice::first();
    $processes = ProcessSup::orderBy('order', 'asc')->get();
    $priceAds = Ads::where('type', 'PRICE')->get();
    return view("client.price", compact("list","notePrice","processes","priceAds"));
  }
  //admin
  public function index()
  {
    $list = Price::all();
    $notePrice = NotePrice::first();
    return view("admin.price.index", compact("list","notePrice"));
  }
  public function createPrice()
  {
    return view("admin.price.create");
  }
  public function storePrice(Request $request)
  {

    $request->validate([
      "package" => 'required',
      "timew" => 'required',
      "timed" => 'required',
      "cost" => 'required',
      "note" => 'required',
    ]);
    Price::create($request->all());
    return redirect()->route("admin.price.index")->with('success', 'price created successfully.');

  }
  public function editPrice($id)
  {

    $price = Price::find($id);
    return view("admin.price.edit", compact("price"));

  }
  public function updatePrice(Request $request, Price $price)
  {

    $request->validate([
      "package" => 'required',
      "timew" => 'required',
      "timed" => 'required',
      "cost" => 'required',
      "note" => 'required',
    ]);
    $price->update($request->all());
    return redirect()->route("admin.price.index")->with('success', 'price updated successfully.');

  }
  public function deletePrice($id)
  {

    $price = Price::find($id);
    $price->delete();
    return redirect()->route("admin.price.index")->with('success', 'price deleted successfully.');

  }

  //note des
  public function storeDesNote(Request $request)
    {

      $request->validate([
        'desNote' => 'required|string',
    ]);
    NotePrice::create($request->all());
    return redirect()->route("admin.price.index")->with('success', 'note price created successfully.');

    }
    public function editDesnote($id)
    {
        $notePrice = NotePrice::find($id);
        return view("admin.price.edit", compact("notePrice"));
    }
    public function updateDesnote(Request $request, NotePrice $notePrice)
    {
        // Xử lý logic cập nhật
        $request->validate([
            'desNote' => 'required|string',
        ]);
        $notePrice->update($request->desNote);
        return redirect()->route("admin.price.index")->with('success', 'note price update successfully.');

    }
    public function downloadPriceList()
    {
        // Lấy dữ liệu báo giá từ database
        $prices = Price::all();
        $notePrice = NotePrice::first();
        $contact = Contact::first();
        // Tạo PDF từ view
        $pdf = PDF::loadView('pdf.price-list', ['prices' => $prices,'notePrice'=>$notePrice,'contact'=>$contact]);
        // Trả về file PDF để tải xuống
        
        return $pdf->download('bao-gia.pdf');
    }
}
