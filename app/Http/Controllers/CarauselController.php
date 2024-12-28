<?php

namespace App\Http\Controllers;

use App\Models\Carausel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CarauselController extends Controller
{
      public function index()
    {
        $carausels = Carausel::all();
        return view('admin.carausels.index', compact('carausels'));
    }

    public function create()
    {
        return view('admin.carausels.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,webp,jpg,gif|max:2048',
        ]);
        $checkStatus = $request->status?true:false;
        $filename = "";
        try {
            if ($request->hasFile('image')) {
                $filename = uniqid() . '.' . $request->image->getClientOriginalName();
                $request->image->move(public_path("carauselImages"), $filename);
                Carausel::create([
                    'status' => $checkStatus,
                    'image' => '/carauselImages/' . $filename,
                ]);
            }
            return redirect()->route('admin.carausels.index')->with('success', 'carausel created successfully.');
        } catch (\Throwable $th) {
            $existingImagePath = public_path('/carauselImages/' . $filename);
            if (File::exists($existingImagePath)) {
                File::delete($existingImagePath);
            }
            return redirect()->back()->with('info', 'Opp error serve.');
        }
    }
    public function edit($id)
    {
        $carausel = Carausel::find($id);
        return view('admin.carausels.edit', compact('carausel'));
    }

    public function update(Request $request, Carausel $carausel)
    {
        $request->validate([
            'image' => 'image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);
        try {
            // Kiểm tra xem checkbox có được chọn hay không
            $checkStatus = $request->status?true:false;
            $filename = "";
            if ($request->hasFile('image')) {
                $existingImagePath = public_path($carausel->image);
                if (File::exists($existingImagePath)) {
                    File::delete($existingImagePath);
                }
                $filename = uniqid() . '.' . $request->image->getClientOriginalName();
                $request->image->move(public_path("carauselImages"), $filename);
                $image = '/carauselImages/' . $filename;
            } else {
                $image = $request->imageExisting;
            }
            $carausel->update([
                'status' => $checkStatus,
                'image' => $image
            ]);
            return redirect()->route('admin.carausels.index')->with('success', 'carausel updated successfully.');
        } catch (\Throwable $th) {
            $existingImagePath = public_path('/carauselImages/' . $filename);
            if (File::exists($existingImagePath)) {
                File::delete($existingImagePath);
            }
            return redirect()->back()->with('info', 'Opp error serve.'.$th);
        }
    }
    public function delete($id)
    {
        $carausel = Carausel::find($id);
        if ($carausel != null) {
            // $imagePath = str_replace('storage', 'public', $carausel->image);
            $imagePath = public_path($carausel->image);
            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }
            $carausel->delete();

        }
        return redirect()->route("admin.carausels.index")->with("success", "delete carausel successfully");
    }
}
