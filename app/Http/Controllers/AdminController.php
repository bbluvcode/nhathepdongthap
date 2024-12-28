<?php

namespace App\Http\Controllers;
use App\Mail\OTPMail;
use App\Models\Account;
use App\Models\Feedback;
use App\Models\Outstanding;
use App\Models\PanelJobImage;
use App\Models\Quote;
use Hash;
use Session;
use Carbon\Carbon;

use App\Models\IntroBenefit;
use App\Models\IntroHome;
use App\Models\IntroVideo;
use App\Models\PanelJob;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
class AdminController extends Controller
{
    public function admin()
    {

        return view("admin.dashboard");
    }
    public function login()
    {
        // $password =  Hash::make("123");
        // dd($password );
        return view("admin.login");
    }
    public function checkLogin(Request $request)
    {
        try {
            // Giả sử bạn đã xác thực người dùng và lấy được $user
            $account = Account::where("email", $request->email)->first();
            // dd($account);
            if ($account != null) {
                if ($account && Hash::check($request->password, $account->password)) {
                    // Lưu user_id vào session
                    $request->session()->put('accountLogin', $account);
                    // Redirect người dùng đến trang chủ
                    $OTPCode = Str::upper(Str::random(6));
                    Mail::to($account->email)->send(new OTPMail($OTPCode));
                    $account->update([
                        "otp" => $OTPCode,
                        "expireotp" => Carbon::now()->addMinutes(5)
                    ]);
                    return redirect('/login/otp');
                }
            }

            // Xử lý khi thông tin đăng nhập không đúng
            return redirect('/login')->with('message', 'Tên đăng nhập hoặc mật khẩu không đúng');
        } catch (\Throwable $th) {
            return redirect('/login')->with('message', 'opp! something went wrong');
        }
    }
    public function viewOTP()
    {
        $accountLogin = Session::get('accountLogin');
        if ($accountLogin) {
            return view("admin.otp");
        } else {
            return redirect('/login')->with('message', 'Chưa xác thực bước 1 login');
        }
    }
    public function checkOTP(Request $request)
    {
        $currentTime = Carbon::now();
        $accountInfo = Session::get('accountLogin');
        // Truy vấn User theo OTP và time_otp lớn hơn hoặc bằng thời gian hiện tại
        if ($request->otp == $accountInfo->otp) {
            if ($accountInfo->expireotp >= $currentTime) {
                $request->session()->put('accountConfirmOTP', $accountInfo);
                return redirect('/admin');
            }
            return redirect('/login/otp')->with('message', 'Mã OTP het ha');
        }
        return redirect('/login/otp')->with('message', 'Mã OTP không hợp lệ');

    }

    public function formChangePass()
    {
        // Xóa thông tin người dùng khỏi session
        return view("admin.changePass");
    }
    public function changePass(Request $request)
    {
        // Kiểm tra mật khẩu cũ có đúng không
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|min:6|confirmed',
            'new_password_confirmation' => 'required|min:6'
        ]);
        $accountInfo = Session::get('accountLogin');
        $account = Account::where("email", $accountInfo->email)->first();
        if (!Hash::check($request->old_password, $account->password)) {
            return back()->with(['message' => 'Mật khẩu cũ không đúng']);
        }
        // Cập nhật mật khẩu mới
        $account->password = Hash::make($request->new_password);
        $account->save();
        return back()->with(['message' => 'Mật khẩu đã được thay đổi thành công']);
    }
    public function logout()
    {
        // Xóa thông tin người dùng khỏi session
        session()->forget('accountConfirmOTP');
        session()->forget('accountLogin');
        return redirect('/login')->with('message', 'Đăng xuất thành công!');
    }
    public function homeIntro()
    {
        $intro = IntroHome::first();
        $benefits = IntroBenefit::all();
        return view("admin.intros.intro", compact("intro", "benefits"));

    }
    public function storeHomeIntro(Request $request)
    {

        $request->validate([
            'title' => 'required',
            'image' => 'required|image|mimes:jpeg,png,webp,jpg,gif|max:2048',
            "description" => 'required',
        ]);
        $filename = "";
        try {
            if ($request->hasFile('image')) {
                $filename = uniqid() . '.' . $request->image->getClientOriginalName();
                $request->image->move(public_path("introImages"), $filename);
                IntroHome::create([
                    'title' => $request->title,
                    'image' => '/introImages/' . $filename,
                    'description' => $request->description,
                ]);
            }
            return redirect()->route('admin.homeIntro')->with('success', 'intro images created successfully.');
        } catch (\Exception $th) {
            $existingImagePath = public_path('/introImages/' . $filename);
            if (File::exists($existingImagePath)) {
                File::delete($existingImagePath);
            }
            return redirect()->back()->with('info', 'Opp error serve.');
        }
    }
    public function updateIntro(Request $request, IntroHome $intro)
    {
        $request->validate([
            'title' => 'required',
            'image' => 'image|mimes:jpeg,png,webp,jpg,gif|max:2048',
            "description" => 'required',
        ]);
        try {
            // Kiểm tra xem checkbox có được chọn hay không
            $filename = "";
            $image = "";
            if ($request->hasFile('image')) {
                $existingImagePath = public_path($intro->image);
                if (File::exists($existingImagePath)) {
                    File::delete($existingImagePath);
                }
                $filename = uniqid() . '.' . $request->image->getClientOriginalName();
                $request->image->move(public_path("introImages"), $filename);
                $image = '/introImages/' . $filename;
            } else {
                $image = $request->imageExisting;
            }
            $intro->update([
                'title' => $request->title,
                'image' => $image,
                'description' => $request->description,
            ]);
            return redirect()->route('admin.homeIntro')->with('success', 'intro updated successfully.');
        } catch (\Throwable $th) {
            $existingImagePath = public_path('/introImages/' . $filename);
            if (File::exists($existingImagePath)) {
                File::delete($existingImagePath);
            }
            return redirect()->route('admin.homeIntro')->with('success', 'Opp error serve');
        }
    }
    public function storeIntroBenefit(Request $request)
    {
        $request->validate([
            'title' => 'required',
        ]);
        $benefit = IntroBenefit::create($request->all());
        return response()->json($benefit, 201);
    }
    public function editIntroBenefit($id)
    {
        $benefit = IntroBenefit::findOrFail($id);
        return response()->json($benefit, 201);
    }
    public function updateIntroBenefit(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
        ]);
        $itemUpdate = IntroBenefit::findOrFail($id);
        $itemUpdate->update([
            'title' => $request->title,
        ]);
        return response()->json($itemUpdate, 200);
    }
    public function deleteIntroBenefit($id)
    {
        $benefit = IntroBenefit::findOrFail($id);
        $benefit->delete();
        return redirect()->route('admin.homeIntro')->with('successBenefit', 'Delete item successfully');
    }
    //video url home
    public function introVideo()
    {
        $introMovie = IntroVideo::first();
        return view("admin.intros.video", compact("introMovie"));
    }
    public function storeVideoIntro(Request $request)
    {

        $request->validate([
            'title' => 'required',
            'urlVideo' => 'required',
            "description" => 'required',
        ]);
        IntroVideo::create($request->all());
        return redirect()->route('admin.introVideo')->with('success', 'create item successfully');
    }
    public function updateVideoIntro(Request $request, IntroVideo $introMovie)
    {

        $request->validate([
            'title' => 'required',
            'urlVideo' => 'required',
            "description" => 'required',
        ]);
        $introMovie->update([
            'title' => $request->title,
            'urlVideo' => $request->urlVideo,
            "description" => $request->description
        ]);
        return redirect()->route('admin.introVideo')->with('success', 'update item successfully');
    }
    public function panelJob()
    {

        $panelJob = Session::get('panelJob', null);
        $panels = PanelJob::all();
        return view("admin.panels.index", compact("panels", 'panelJob'));
    }
    public function createPanelJob(Request $request)
    {
        $request->validate([
            'title' => 'required',
            "description" => 'required',
            "type" => 'required',
        ]);
        $status = $request->status == null ? false : true;
        PanelJob::create([
            "title" => $request->title,
            "description" => $request->description,
            "type" => $request->type,
            "status" => $status,
        ]);
        return redirect()->route('admin.panelJob.index')->with('success', 'create job successfully');

    }
    public function editPanelJob($id)
    {
        $panelJob = PanelJob::findOrFail($id);
        Session::put('panelJob', $panelJob);
        return redirect()->route('admin.panelJob.index')->with('success', 'create job successfully');

    }
    public function updatePanelJob(Request $request, PanelJob $panelJob)
    {
        $request->validate([
            'title' => 'required',
            "description" => 'required',
            "type" => 'required',
        ]);
        $status = $request->status == null ? false : true;
        $panelJob->update([
            "title" => $request->title,
            "description" => $request->description,
            "type" => $request->type,
            "status" => $status,
        ]);
        Session::put('panelJob', null);
        return redirect()->route('admin.panelJob.index')->with('success', 'create job successfully');

    }

    public function canelForm($id)
    {
        Session::put('panelJob', null);
        Session::put('panelJobImage', null);
        Session::put('outstanding', null);
        Session::put('feedback', null);
        return redirect()->back()->with('info', 'cancel successfully.');

    }
    public function deletePanelJob($id)
    {
        $panelJob = PanelJob::findOrFail($id);
        $panelJob->delete();
        return redirect()->route('admin.panelJob.index')->with('success', 'create job successfully');

    }
    public function detailPanelJob($id)
    {
        $panelJob = PanelJob::findOrFail($id);
        $panelJobImages = $panelJob->panelJobImages;
        $panelJobImage = Session::get('panelJobImage', null);
        return view("admin.panels.detail", compact("panelJob", "panelJobImages", "panelJobImage"));

    }
    public function editPanelJobImage($id)
    {
        $panelJobImage = PanelJobImage::find($id);
        Session::put('panelJobImage', $panelJobImage);
        return redirect()->back();

    }
    public function storePanelJobImage(Request $request)
    {
        $request->validate([
            'image' => 'required',
            'panel_id' => 'required',
        ]);
        $filename = "";
        $status = $request->status == null ? false : true;
        try {
            if ($request->hasFile('image')) {
                $filename = uniqid() . '.' . $request->image->getClientOriginalName();
                $request->image->move(public_path("panelJobImages"), $filename);
                PanelJobImage::create([
                    'status' => $status,
                    'image' => '/panelJobImages/' . $filename,
                    'panel_id' => $request->panel_id,
                ]);
            }
            return redirect()->back()->with('success', 'panel images created successfully.');
        } catch (\Exception $th) {
            $existingImagePath = public_path('/panelJobImages/' . $filename);
            if (File::exists($existingImagePath)) {
                File::delete($existingImagePath);
            }
            return redirect()->back()->with('info', 'Opp error serve.');
        }
    }
    public function updatePanelJobImage(Request $request, PanelJobImage $panelJobImage)
    {
        $request->validate([
            'image' => 'required',
            'panel_id' => 'required',
        ]);
        try {
            // Kiểm tra xem checkbox có được chọn hay không
            $filename = "";
            $image = "";
            $status = $request->status == null ? false : true;
            if ($request->hasFile('image')) {
                $existingImagePath = public_path($panelJobImage->image);
                if (File::exists($existingImagePath)) {
                    File::delete($existingImagePath);
                }
                $filename = uniqid() . '.' . $request->image->getClientOriginalName();
                $request->image->move(public_path("panelJobImages"), $filename);
                $image = '/panelJobImages/' . $filename;
            } else {
                $panelJobImage = $request->imageExisting;
            }
            $panelJobImage->update([
                'status' => $status,
                'image' => $image,
                'panel_id' => $request->panel_id
            ]);
            Session::put('panelJobImage', null);
            return redirect()->back()->with('info', 'updated panel job image successfully');
        } catch (\Throwable $th) {
            $existingImagePath = public_path('/panelJobImages/' . $filename);
            if (File::exists($existingImagePath)) {
                File::delete($existingImagePath);
            }
            return redirect()->back()->with('info', 'Opp error serve.');
        }
    }

    public function deletePanelJobImage($id)
    {
        $panelJob = PanelJobImage::findOrFail($id);
        $existingImagePath = $panelJob->image;
        $panelJob->delete();
        if (File::exists($existingImagePath)) {
            File::delete($existingImagePath);
        }
        return redirect()->back()->with('success', 'panel images deleted successfully.');
    }
    //outstandings
    public function outstanding()
    {
        $outstandings = Outstanding::all();
        $outstanding = Session::get('outstanding', null);
        return view("admin.outstanding.index", compact("outstandings", "outstanding"));
    }
    public function storeOutstanding(Request $request)
    {
        $request->validate([
            'image' => 'image|mimes:jpeg,png,webp,jpg,gif|max:2048',
            'title' => 'required',
        ]);
        $filename = "";
        $status = $request->status == null ? false : true;
        try {
            if ($request->hasFile('image')) {
                $filename = uniqid() . '.' . $request->image->getClientOriginalName();
                $request->image->move(public_path("outStandingImages"), $filename);
                Outstanding::create([
                    'status' => $status,
                    'image' => '/outStandingImages/' . $filename,
                    'title' => $request->title,
                ]);
            }
            return redirect()->back()->with('success', 'panel images created successfully.');
        } catch (\Exception $th) {
            $existingImagePath = public_path('/outStandingImages/' . $filename);
            if (File::exists($existingImagePath)) {
                File::delete($existingImagePath);
            }
            return redirect()->back()->with('info', 'Opp error serve.');
        }
    }
    public function editOutstanding($id)
    {
        $outstanding = Outstanding::find($id);
        Session::put('outstanding', $outstanding);
        return redirect()->back();
    }
    public function updateOutstanding(Request $request, Outstanding $outstanding)
    {
        $request->validate([
            'image' => 'image|mimes:jpeg,png,webp,jpg,gif|max:2048',
            'title' => 'required',
        ]);
        try {
            // Kiểm tra xem checkbox có được chọn hay không
            $filename = "";
            $image = "";
            $status = $request->status == null ? false : true;
            if ($request->hasFile('image')) {
                $existingImagePath = public_path($outstanding->image);
                if (File::exists($existingImagePath)) {
                    File::delete($existingImagePath);
                }
                $filename = uniqid() . '.' . $request->image->getClientOriginalName();
                $request->image->move(public_path("outStandingImages"), $filename);
                $image = '/outStandingImages/' . $filename;
            } else {
                $outstanding = $request->imageExisting;
            }
            $outstanding->update([
                'status' => $status,
                'image' => $image,
                'title' => $request->title
            ]);
            Session::put('outstanding', null);
            return redirect()->back()->with('info', 'updated outstanding job image successfully');
        } catch (\Throwable $th) {
            $existingImagePath = public_path('/outStandingImages/' . $filename);
            if (File::exists($existingImagePath)) {
                File::delete($existingImagePath);
            }
            return redirect()->back()->with('info', 'Opp error serve.');
        }
    }
    //feedback
    public function feedback()
    {
        $feedbacks = Feedback::all();
        $feedback = Session::get('feedback', null);
        return view("admin.feedbacks.index", compact("feedbacks", "feedback"));
    }
    public function storeFeedback(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,webp,jpg,gif|max:2048',
            'name' => 'required',
            'description' => 'required',
        ]);
        $filename = "";
        $status = $request->status == null ? false : true;
        try {
            if ($request->hasFile('image')) {
                $filename = uniqid() . '.' . $request->image->getClientOriginalName();
                $request->image->move(public_path("feedbackImages"), $filename);
                Feedback::create([
                    'status' => $status,
                    'image' => '/feedbackImages/' . $filename,
                    'name' => $request->name,
                    'description' => $request->description,
                ]);
            }
            return redirect()->back()->with('success', 'panel images created successfully.');
        } catch (\Exception $th) {
            $existingImagePath = public_path('/feedbackImages/' . $filename);
            if (File::exists($existingImagePath)) {
                File::delete($existingImagePath);
            }
            return redirect()->back()->with('info', 'Opp error serve.');
        }
    }
    public function editFeedback($id)
    {
        $feedback = Feedback::find($id);
        Session::put('feedback', $feedback);
        return redirect()->back();
    }
    public function updateFeedback(Request $request, Feedback $feedback)
    {
        $request->validate([
            'image' => 'image|mimes:jpeg,png,webp,jpg,gif|max:2048',
            'name' => 'required',
            'description' => 'required',
        ]);
        try {
            // Kiểm tra xem checkbox có được chọn hay không
            $filename = "";
            $image = "";
            $status = $request->status == null ? false : true;
            if ($request->hasFile('image')) {
                $existingImagePath = public_path($feedback->image);
                if (File::exists($existingImagePath)) {
                    File::delete($existingImagePath);
                }
                $filename = uniqid() . '.' . $request->image->getClientOriginalName();
                $request->image->move(public_path("feedbackImages"), $filename);
                $image = '/feedbackImages/' . $filename;
            } else {
                $feedback = $request->imageExisting;
            }
            $feedback->update([
                'status' => $status,
                'image' => $image,
                'name' => $request->name,
                'description' => $request->description
            ]);
            Session::put('feedback', null);
            return redirect()->back()->with('info', 'updated feddback job image successfully');
        } catch (\Throwable $th) {
            $existingImagePath = public_path('/feedbackImages/' . $filename);
            if (File::exists($existingImagePath)) {
                File::delete($existingImagePath);
            }
            return redirect()->back()->with('info', 'Opp error serve.');
        }
    }
    public function deleteFeedback($id)
    {
        $feedback = Feedback::findOrFail($id);
        $existingImagePath = $feedback->image;
        $feedback->delete();
        if (File::exists($existingImagePath)) {
            File::delete($existingImagePath);
        }
        return redirect()->back()->with('success', 'feedback deleted successfully.');
    }
    public function listQuote()
    {
        $quotes = Quote::all();
        return view("admin.quote.index", compact("quotes"));
    }
    public function createQuote()
    {
        return view("admin.quote.create");
    }
    public function storeQuote(Request $request)
    {
        $request->validate([
            'type' => 'required',
            'author' => 'required',
            'description' => 'required',
        ]);
        Quote::create($request->all());
        return redirect()->route("admin.quote.index")->with('success', 'quote created successfully.');
    }
    public function editQuote($id)
    { 
    $quote = Quote::find($id);
    return view("admin.quote.edit",compact("quote"));
    }
    public function updateQuote(Request $request,Quote $quote)
    {
        $request->validate([
            'type' => 'required',
            'author' => 'required',
            'description' => 'required',
        ]);
        $quote->update($request->all());
        return redirect()->route("admin.quote.index")->with('success', 'quote updated successfully.');
    }
    public function deleteQuote($id)
    { 
    $quote = Quote::find($id);
    $quote->delete();
    return redirect()->route("admin.quote.index")->with('success', 'quote deleted successfully.');
    }
}

