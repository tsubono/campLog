@extends('layouts.app')

@section('content')
    <section>
        @if (session('status'))
            <div class="flash-message">
                {{ session('status') }}
            </div>
        @endif
        <div class="content">
            <div class="login-form">
                <h2>パスワード再設定</h2>

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <div class="form-content">
                        <div class="form-group">
                            <input id="email" type="text" class="@error('email') is-invalid @enderror" name="email"
                                   value="{{ old('email') }}" autocomplete="email" autofocus>
                            <label class="form-label" for="email">{{ __('E-Mail Address') }}</label>

                            @error('email')
                            <div class="text-error my-5">
                                <strong>{{ $message }}</strong>
                            </div>
                            @enderror
                        </div>

                        <div class="form-buttons">
                            <button class="btn primary-btn" type="submit">パスワード再設定メール送信</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    </div>
@endsection
