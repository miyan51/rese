<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rese</title>
    @vite('resources/css/app.css')
</head>

<body class="m-8 ">
    <div class="m-4 text-4xl text-gray-600 ">
        ご登録ありがとうございます。 開始する前に、メールでお送りしたリンクをクリックして、メールアドレスを確認してください。 メールが届かない場合は、別のメールをお送りします。
    </div>

    @if (session('status') == 'verification-link-sent')
    <div class="mb-4 font-medium text-sm text-green-600">
        登録時に指定したメールアドレスに新しい確認リンクが送信されました
    </div>
    @endif

    <div class="mt-4 flex items-center justify-between">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf

            <div>
                <x-button>
                    {{ __('Resend Verification Email') }}
                </x-button>
            </div>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900">
                {{ __('Log Out') }}
            </button>
        </form>
    </div>
</body>

</html>