<?php

namespace App\Http\Controllers;

use App\Models\Ads;
use App\Models\News;
use App\Models\SpecialAds;
use Illuminate\Http\Request;
use DOMDocument;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{
   
    //post news admin
    public function create()
    {
        return view("admin.post.create");
    }
    public function store(Request $request)
    {
        // Xác thực dữ liệu đầu vào
        $request->validate([
            'title' => 'required',
            'image' => 'required|image|nullable|max:1999',
            'description' => 'required',
            'type' => 'required'
        ]);
        $filename = "";
        try {
            // Kiểm tra nếu có tệp ảnh được tải lên
            if ($request->hasFile('image')) {
                // Tạo tên tệp ảnh độc nhất
                $filename = uniqid() . '.' . $request->image->getClientOriginalName();
                // Lưu ảnh vào thư mục 'public/knowImages'
                $request->image->move(public_path("postsImages"), $filename);
                // Xử lý nội dung editor
                $description = $request->input('description');
                // Làm sạch HTML
                $description = $this->cleanHtml($description);
                $dom = new DOMDocument('1.0', 'UTF-8');
                libxml_use_internal_errors(true); // Bỏ qua các lỗi không quan trọng

                // Tải HTML vào DOMDocument
                $dom->loadHTML(mb_convert_encoding($description, 'HTML-ENTITIES', 'UTF-8'), LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
                libxml_clear_errors(); // Xóa các lỗi đã xảy ra
                // Xử lý các ảnh base64 trong nội dung
                $images = $dom->getElementsByTagName('img');
                foreach ($images as $img) {
                    $src = $img->getAttribute('src');
                    // Chỉ xử lý ảnh base64
                    if (preg_match('/^data:image\/(\w+);base64,/', $src)) {
                        $data = substr($src, strpos($src, ',') + 1);
                        $data = base64_decode($data);
                        $image_name = time() . '_' . uniqid() . '.png';
                        $path = public_path('postsImages/' . $image_name);
                        // Lưu file vào storage
                        file_put_contents($path, $data);
                        // Cập nhật đường dẫn ảnh trong nội dung
                        $img->removeAttribute('src');
                        $img->setAttribute('src', '/postsImages/' . $image_name);
                    }
                }
                $description = $dom->saveHTML();

                // Tạo bản ghi mới trong cơ sở dữ liệu
                News::create([
                    'title' => $request->title,
                    'description' => $description,
                    'type' => $request->type,
                    'status' => false,
                    'image' => '/postsImages/' . $filename,
                ]);
            } else {
                // Nếu không có ảnh tải lên, chuyển hướng về trang danh sách với thông báo lỗi
                return redirect()->back()->with('info', 'image is required.');
            }

            // Chuyển hướng về trang danh sách với thông báo thành công
            return redirect()->back()->with('info', 'create post successfully.');
        } catch (\Exception $th) {
            $existingImagePath = public_path('/postsImages/' . $filename);
            if (File::exists($existingImagePath)) {
                File::delete($existingImagePath);
            }
            return redirect()->back()->with('info', `Opp error serve.`);
        }
    }
    public function edit($id)
    {
        $news = News::find($id);
        return view("admin.post.edit", compact("news"));
    }

    public function updatePost(Request $request, News $news)
    {
        // Xác thực dữ liệu đầu vào
        $request->validate([
            'title' => 'required',
            'image' => 'image|nullable|max:1999',
            'description' => 'required',
            'type' => 'required'
        ]);

        try {
            // Xử lý tải ảnh thumbnail
            if ($request->hasFile('thumbnail')) {
                // Tạo tên tệp ảnh độc nhất
                $filename = uniqid() . '.' . $request->image->getClientOriginalExtension();
                // Lưu ảnh vào thư mục 'public/knowImages'
                $request->image->move(public_path("postsImages"), $filename);
                $image = "/postsImages/" . $filename;
                $imagePath = public_path($request->thumbnailExisted);
                if (File::exists($imagePath)) {
                    File::delete($imagePath);
                }
            } else {
                // Giữ nguyên thumbnail cũ nếu không có ảnh mới
                $image = $request->input('imageExisted');
            }

            // Lấy và xử lý nội dung mô tả
            $description = $request->input('description');
            $deletedImages = json_decode($request->input('deleted_images'), true);
            // Xóa các ảnh đã được đánh dấu để xóa
            if ($deletedImages) {
                foreach ($deletedImages as $image) {
                    $parsedUrl = parse_url($image, PHP_URL_PATH);
                    $imagePathUrl = ltrim($parsedUrl, '/');
                    $imagePath = public_path($imagePathUrl);
                    if (file_exists($imagePath)) {
                        unlink($imagePath); // Xóa file khỏi public
                    }
                }
            }
            // Làm sạch và xử lý các ảnh base64 trong nội dung
            $description = $this->cleanHtml($description);
            $dom = new DOMDocument('1.0', 'UTF-8');
            libxml_use_internal_errors(true); // Bỏ qua các lỗi không quan trọng

            // Tải HTML vào DOMDocument
            $dom->loadHTML(mb_convert_encoding($description, 'HTML-ENTITIES', 'UTF-8'), LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
            libxml_clear_errors(); // Xóa các lỗi đã xảy ra

            $images = $dom->getElementsByTagName('img');

            foreach ($images as $img) {
                $src = $img->getAttribute('src');
                // Xử lý chỉ các ảnh base64
                if (preg_match('/^data:image\/(\w+);base64,/', $src)) {
                    $data = substr($src, strpos($src, ',') + 1);
                    $data = base64_decode($data);
                    $image_name = time() . '_' . uniqid() . '.png';
                    $path = public_path('postsImages/' . $image_name);

                    // Lưu tệp vào storage
                    file_put_contents($path, $data);

                    // Cập nhật đường dẫn ảnh trong nội dung HTML
                    $img->removeAttribute('src');
                    $img->setAttribute('src', '/postsImages/' . $image_name);
                }
            }

            $description = $dom->saveHTML();
            $status = $request->status == null ? false : true;
            // Cập nhật bản ghi Knowledge
            $news->update([
                'title' => $request->title,
                'description' => $description,
                'type' => $request->type,
                'status' => $status,
                'image' => $image,
            ]);

            // Chuyển hướng về trang danh sách với thông báo thành công
            return redirect()->back()->with('info', 'update post successfully.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('info', 'Opp error serve.');
        }
    }
    protected function cleanHtml($html)
    {
        // Danh sách các thẻ không hợp lệ
        $invalid_tags = ['canvas', 'script', 'iframe']; // Thêm các thẻ không hợp lệ khác nếu cần

        foreach ($invalid_tags as $tag) {
            // Loại bỏ các thẻ không hợp lệ
            $html = preg_replace('/<' . $tag . '[^>]*>.*?<\/' . $tag . '>/', '', $html);
            $html = preg_replace('/<' . $tag . '[^>]*>/', '', $html);
        }

        return $html;
    }

    public function deletePost($id)
    {
        // Tìm đối tượng Knowledge theo ID hoặc hiển thị lỗi 404 nếu không tìm thấy
        $news = News::find($id);
        $imagePath = public_path($news->image);
        if (File::exists($imagePath)) {
            File::delete($imagePath);
        }
        // Xóa các hình ảnh liên quan từ mô tả
        $dom = new DOMDocument('1.0', 'UTF-8');
        libxml_use_internal_errors(true); // Bỏ qua các cảnh báo từ HTML không hợp lệ
        $dom->loadHTML(mb_convert_encoding($news->description, 'HTML-ENTITIES', 'UTF-8'), LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        libxml_clear_errors();
        $images = $dom->getElementsByTagName('img');
        foreach ($images as $img) {
            $src = $img->getAttribute('src');
            // Xử lý URL của hình ảnh
            $parsedUrl = parse_url($src, PHP_URL_PATH);
            $imagePath = public_path(ltrim($parsedUrl, '/')); // Đường dẫn file từ public

            // Xóa tệp hình ảnh nếu tồn tại
            if (file_exists($imagePath)) {
                unlink($imagePath); // Xóa file
            }
        }
        // Xóa bài viết khỏi cơ sở dữ liệu
        $news->delete();
        // Chuyển hướng về trang trước đó với thông báo thành công
        return redirect()->back()->with('success', 'Post deleted successfully!');
    }
    
    public function createAds()
    {
        return view("admin.post.create_ads");
    }
    public function storeAds(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,webp,jpg,gif|max:2048',
            "title"=>"required",
            "type"=>"required"
        ]);
        $filename = "";
        try {
            if ($request->hasFile('image')) {
                $filename = uniqid() . '.' . $request->image->getClientOriginalName();
                $request->image->move(public_path("adsImages"), $filename);
                Ads::create([
                    'image' => '/adsImages/' . $filename,
                    'title' => $request->title,
                    'type' => $request->type,
                ]);
            }
            return redirect()->back()->with('info', 'create ads successfully.');
        } catch (\Throwable $th) {
            $existingImagePath = public_path('/adsImages/' . $filename);
            if (File::exists($existingImagePath)) {
                File::delete($existingImagePath);
            }
            return redirect()->back()->with('info', 'Opp error serve.'.$th);
        }
    }
    public function editAds($id)
    {
        $ads = Ads::find($id);
        return view("admin.post.edit_ads",compact('ads'));
    }
    public function updateAds(Request $request, Ads $ads)
    {
        $request->validate([
            'image' => 'image|mimes:jpeg,png,jpg,gif,webp|max:2048',
             "title"=>"required",
            "type"=>"required"
        ]);
        try {
            // Kiểm tra xem checkbox có được chọn hay không
            $filename = "";
            if ($request->hasFile('image')) {
                $existingImagePath = public_path($ads->image);
                if (File::exists($existingImagePath)) {
                    File::delete($existingImagePath);
                }
                $filename = uniqid() . '.' . $request->image->getClientOriginalName();
                $request->image->move(public_path("adsImages"), $filename);
                $image = '/adsImages/' . $filename;
            } else {
                $image = $request->imageExisting;
            }
            $ads->update([
                'image' => $image,
                'title' => $request->title,
                'type' => $request->type,
            ]);
            return redirect()->back()->with('info', 'update ads successfully.');
        } catch (\Throwable $th) {
            $existingImagePath = public_path('/adsImages/' . $filename);
            if (File::exists($existingImagePath)) {
                File::delete($existingImagePath);
            }
            return redirect()->back()->with('info', 'Opp error serve.'.$th);
        }
    }
    public function deleteAds($id)
    {
        $ads = Ads::find($id);
        if ($ads != null) {
            $imagePath = public_path($ads->image);
            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }
            $ads->delete();

        }
        return redirect()->back()->with('info', 'upddeleteate ads successfully.');
    }

    //special ads
    public function storeSpecAds(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,webp,jpg,gif|max:2048',
            "title"=>"required",
            "sortDes"=>"required"
        ]);
        $filename = "";
        try {
            if ($request->hasFile('image')) {
                $filename = uniqid() . '.' . $request->image->getClientOriginalName();
                $request->image->move(public_path("adsImages"), $filename);
                SpecialAds::create([
                    'image' => '/adsImages/' . $filename,
                    'title' => $request->title,
                    'sortDes' => $request->sortDes,
                ]);
            }
            return redirect()->back()->with('info', 'create ads successfully.');
        } catch (\Throwable $th) {
            $existingImagePath = public_path('/adsImages/' . $filename);
            if (File::exists($existingImagePath)) {
                File::delete($existingImagePath);
            }
            return redirect()->back()->with('info', 'Opp error serve.'.$th);
        }
    }
    public function updateSpecAds(Request $request, SpecialAds $specialAds)
    {
        $request->validate([
            'image' => 'image|mimes:jpeg,png,jpg,gif,webp|max:2048',
             "title"=>"required",
            "sortDes"=>"required"
        ]);
        try {
            // Kiểm tra xem checkbox có được chọn hay không
            $filename = "";
            if ($request->hasFile('image')) {
                $existingImagePath = public_path($specialAds->image);
                if (File::exists($existingImagePath)) {
                    File::delete($existingImagePath);
                }
                $filename = uniqid() . '.' . $request->image->getClientOriginalName();
                $request->image->move(public_path("adsImages"), $filename);
                $image = '/adsImages/' . $filename;
            } else {
                $image = $request->imageExisting;
            }
            $specialAds->update([
                'image' => $image,
                'title' => $request->title,
                'sortDes' => $request->sortDes,
            ]);
            return redirect()->back()->with('infoSpecial', 'update ads successfully.');
        } catch (\Throwable $th) {
            $existingImagePath = public_path('/adsImages/' . $filename);
            if (File::exists($existingImagePath)) {
                File::delete($existingImagePath);
            }
            return redirect()->back()->with('infoSpecial', 'Opp error serve.');
        }
    }

}
