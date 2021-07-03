@php
    $isMypage = true;
@endphp

@extends('layouts.app')

@section('content')
    <section class="import">
        @include('mypage._tab')
        <div class="content">
            <div class="import-form">
                <h3 class="head-with-border small">キャンプ場CSVインポート</h3>

                <div class="form-content">
                    <form method="POST" action="{{ route('mypage.camp-places.import') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="file" name="csv_file" />

                        <div class="form-buttons">
                            <button type="submit" class="btn primary-btn">インポート</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
