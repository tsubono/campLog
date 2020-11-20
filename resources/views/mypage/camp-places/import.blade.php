@extends('layouts.app')

@section('content')
    <section class="profile-edit">
        @include('mypage._tab')
        <div class="content">
            <div class="import-form">
                <h2>キャンプ場CSVインポート</h2>
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
