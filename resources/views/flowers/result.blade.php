<x-app-layout>
    <div class="container">
        <h1>診断結果</h1>

        <p>あなたのMBTIタイプは: <strong>{{ $mbtiResult }}</strong> です。</p>

        <a href="{{ route('dashboard') }}" class="btn btn-primary">ダッシュボードに戻る</a>
    </div>

    
    <style>
        .container {
            text-align: center;
            margin-top: 50px;
        }

        h1 {
            font-size: 24px;
            margin-bottom: 20px;
        }

        p {
            font-size: 18px;
            margin-bottom: 20px;
        }

        .btn-primary {
            background-color: #3490dc;
            border-color: #3490dc;
            color: #fff;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
        }
    </style>
</x-app-layout>
