<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\URL;

class SitemapController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        $sitemap = App::make("sitemap");

        // Topページ
        $sitemap->add(URL::to('/'), now(), '1.0', 'always');

        // DBのデータを元に動的URL生成
        $users = User::query()->orderBy('updated_at', 'desc')->get();
        foreach ($users as $user) {
            $sitemap->add(route('profile.index', ['userName' => $user->name]), $user->updated_at, '0.8', 'monthly');
        }

        // 出力
        return $sitemap->render('xml');
        // XMLファイルで出力する場合
        // $sitemap->store('xml', 'mysitemap');
    }
}