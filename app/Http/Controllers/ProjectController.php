<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Quote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProjectController extends Controller
{
  public function project()
  {
    $nav_active = "gioithieu";
    $projects = Project::all();
    $quote = Quote::where('type', 'DUAN')->first();
    return view("client.project", compact("projects","quote","nav_active"));
  }
  public function index()
  {
    $projects = Project::all();
    return view("admin.project.index", compact("projects"));
  }
  public function create()
  {
    return view("admin.project.create");
  }
  public function store(Request $request)
  {
    $request->validate([
      'image' => 'required|image|mimes:jpeg,png,webp,jpg,gif|max:2048',
      'title' => 'required',
      'type' => 'required',
      'year' => 'required',
      'owner' => 'required',
      'area' => 'required'
    ]);
    $filename = "";
    try {
      if ($request->hasFile('image')) {
        $filename = uniqid() . '.' . $request->image->getClientOriginalName();
        $request->image->move(public_path("projectImages"), $filename);
        Project::create([
          'title' => $request->title,
          'year' => $request->year,
          'type' => $request->type,
          'owner' => $request->owner,
          'area' => $request->area,
          'image' => '/projectImages/' . $filename,
        ]);
      }
      return redirect()->route('admin.project.index')->with('success', 'project created successfully.');
    } catch (\Throwable $th) {
      $existingImagePath = public_path('/projectImages/' . $filename);
      if (File::exists($existingImagePath)) {
        File::delete($existingImagePath);
      }
      return redirect()->back()->with('info', 'Opp error serve.' . $th);
    }
  }
  public function edit($id)
  {
    $project = Project::find($id);
    return view('admin.project.edit', compact('project'));
  }

  public function update(Request $request, Project $project)
  {
    $request->validate([
      'image' => 'image|mimes:jpeg,png,webp,jpg,gif|max:2048',
      'title' => 'required',
      'type' => 'required',
      'year' => 'required',
      'owner' => 'required',
      'area' => 'required'
    ]);
    try {
      // Kiểm tra xem checkbox có được chọn hay không
      $filename = "";
      if ($request->hasFile('image')) {
        $existingImagePath = public_path($project->image);
        if (File::exists($existingImagePath)) {
          File::delete($existingImagePath);
        }
        $filename = uniqid() . '.' . $request->image->getClientOriginalName();
        $request->image->move(public_path("projectImages"), $filename);
        $image = '/projectImages/' . $filename;
      } else {
        $image = $request->imageExisting;
      }
      $project->update([
        'title' => $request->title,
        'year' => $request->year,
        'type' => $request->type,
        'owner' => $request->owner,
        'area' => $request->area,
        'image' => $image
      ]);
      return redirect()->route('admin.project.index')->with('success', 'project updated successfully.');
    } catch (\Throwable $th) {
      $existingImagePath = public_path('/projectImages/' . $filename);
      if (File::exists($existingImagePath)) {
        File::delete($existingImagePath);
      }
      return redirect()->back()->with('info', 'Opp error serve.' . $th);
    }
  }
  public function delete($id)
  {
    $project = Project::find($id);
    if ($project != null) {
      // $imagePath = str_replace('storage', 'public', project->image);
      $imagePath = public_path($project->image);
      if (File::exists($imagePath)) {
        File::delete($imagePath);
      }
      $project->delete();

    }
    return redirect()->route("admin.project.index")->with("success", "delete project successfully");
  }
}
