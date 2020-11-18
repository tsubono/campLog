@php
    $isAccessCode = true;
@endphp

@extends('layouts.app')

@section('content')
    <section>
        <div class="content">
            <div class="login-form">
                <h2>認証コードを入力してください</h2>

                <form method="POST" action="{{ route('access-code.check') }}">
                    @csrf

                    <div class="form-content">
                        <div class="form-group">
                            <input id="code" type="text" class="@error('code') is-invalid @enderror" name="code" value="{{ old('code') }}">
                            <label class="form-label" for="code">認証コード</label>

                            @error('code')
                            <div class="text-error my-5">
                                <strong>{{ $message }}</strong>
                            </div>
                            @enderror
                        </div>

                        <div class="form-buttons">
                            <button class="btn primary-btn" type="submit">認証する</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
