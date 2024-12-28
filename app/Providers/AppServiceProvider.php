<?php

namespace App\Providers;

use App\Models\Contact;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Lấy dữ liệu công ty từ bảng Contact
        $companyInfo = Contact::first();  // Giả sử lấy thông tin từ bảng contacts

        // Chia sẻ thông tin công ty cho tất cả các view
        View::share('companyInfo', $companyInfo);
    }
}
