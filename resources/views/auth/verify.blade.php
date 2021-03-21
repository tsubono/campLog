@extends('layouts.app')

@section('content')
    <section>
        <div class="content">
            <div class="login-form">
                <h2>メールアドレス認証</h2>
                <br>
                <div class="card-body">
                    @if (session('resent'))
                        <div class="flash-message">
                            認証メールを再送信しました
                        </div>
                    @endif

                    ご登録のメールアドレスに認証メールをお送りしております。<br>
                    メールをご確認の上、記載のリンクから登録を完了させてください。<br>
                    ※メールが届かない場合は、入力したアドレスに間違いがあるか、あるいは迷惑メールフォルダに入っている可能性がありますのでご確認ください。
                    <br><br>
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn primary-btn">認証メールを再送する</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
