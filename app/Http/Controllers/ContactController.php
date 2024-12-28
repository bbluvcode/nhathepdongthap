<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use App\Models\Contact;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
  public function contact()
  {
    $nav_active = "lienhe";
    $contact = Contact::first();
    return view("client.contact", compact("contact","nav_active"));
  }
  //admin
  public function index()
  {
    $contact = Contact::first();
    $messages = Message::orderBy('created_at', 'desc')->get();
    return view("admin.contact.index", compact("contact","messages"));
  }
  public function edit($id)
  {
    $contact = Contact::find($id);
    return view('admin.contact.edit', compact('contact'));
  }

  public function update(Request $request, Contact $contact)
  {
    $request->validate([
      'logo' => 'image|mimes:jpeg,png,webp,jpg,gif|max:2048',
      'phone' => 'required',
      'address1' => 'required',
      'email' => 'required',
      'person' => 'required'
    ]);
    try {
      // Kiểm tra xem checkbox có được chọn hay không
      $filename = "";
      if ($request->hasFile('logo')) {
        $existingImagePath = public_path($contact->logo);
        if (File::exists($existingImagePath)) {
          File::delete($existingImagePath);
        }
        $filename = uniqid() . '.' . $request->logo->getClientOriginalName();
        $request->logo->move(public_path("projectImages"), $filename);
        $image = '/projectImages/' . $filename;
      } else {
        $image = $request->imageExisting;
      }
      $contact->update([
        'phone' => $request->phone,
        'address1' => $request->address1,
        'address2' => $request->address2,
        'email' => $request->email,
        'person' => $request->person,
        'logo' => $image
      ]);
      return redirect()->route('admin.contact.index')->with('success', 'contact updated successfully.');
    } catch (\Throwable $th) {
      $existingImagePath = public_path('/projectImages/' . $filename);
      if (File::exists($existingImagePath)) {
        File::delete($existingImagePath);
      }
      return redirect()->back()->with('info', 'Opp error serve.' . $th);
    }

  }
  public function messageMail(Request $request)
  {
    $request->validate([
      "name" => "required",
      "email" => "required|email",
      "phone" => "required|digits_between:10,15",
      "message" => "required",
    ]);
    $data = [
      "message"=>$request->message,
      "phone"=>$request->phone,
      "name"=>$request->name
    ];
    try {
      Mail::to($request->email)->send(new ContactMail($data));
      Message::create($request->all());
      return redirect()->back()->with("message", "Gửi mail thành công. Bô phận A&C sẽ sơm liên hệ bạn.");
    } catch (\Throwable $th) {
      return redirect()->back()->with("message", "Opp! có lỗi xảy ra. vui long thử lại");
    }
 
  }
  public function delete($id)
  {
    $mesage = Message::find($id);
    $mesage->delete();
    return redirect()->back()->with("message", "Xóa message thành công");
  }

}

