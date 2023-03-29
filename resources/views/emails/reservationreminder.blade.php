<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>予約リマインダー</title>
</head>

<body>
  <p> {{ $reserve->user->name }} 様</p>
  <p>本日の{{ date('H:i', strtotime($reserve->time)) }}に予約されていることをお知らせいたします。</p>
  <p>ご予約の詳細については、サイト上で確認してください。</p>
  <p>何かご不明な点がございましたら、お気軽にお問い合わせください。</p>
</body>

</html>