@extends('layouts.app')

@section('content')
    <section class="profile-edit">
        @include('mypage._tab')
        <div class="content">
            <div class="access-code-form">
                <form method="POST" action="{{ route('mypage.access-code.update', ['access_code' => $accessCode]) }}">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="is_valid" value="{{ !$accessCode->is_valid }}"/>
                    @if ($accessCode->is_valid)
                        <button class="btn danger-btn" type="submit">無効にする</button>
                    @else
                        <button class="btn primary-btn" type="submit">有効にする</button>
                    @endif
                </form>

                @if ($accessCode->is_valid)
                    <div class="form-content">
                        <h3>認証コード</h3>
                        <div class="access-code" id="accessCode">
                            {{ $accessCode->code }}
                        </div>
                        <a class="btn default-btn copy" onclick="copyToClipboard('accessCode')">コピーする</a>
                    </div>
                @endif
            </div>
        </div>
    </section>
@endsection
