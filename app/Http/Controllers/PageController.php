<?php

namespace App\Http\Controllers;

class PageController extends Controller
{
    /**
     * 利用手順
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function guide()
    {
        return view('guide');
    }

    /**
     * 利用規約
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function rules()
    {
        return view('rules');
    }

    /**
     * プライバシーポリシー
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function privacyPolicy()
    {
        return view('privacy-policy');
    }
}
