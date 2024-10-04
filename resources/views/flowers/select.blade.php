<x-app-layout>
    <div class="container" style="text-align: center; display: flex; flex-direction: column; align-items: center;">
        <!-- フォントサイズを大きくして中央寄せ -->
        <h1 style="font-size: 2rem; font-weight: bold; text-align: center;">好きな花を3つ選んでください</h1>

        <form action="/flower-result" method="POST" id="flower-selection-form">
            @csrf
            <!-- 4列表示、中央寄せ -->
            <div class="row" style="display: flex; flex-wrap: wrap; justify-content: center;">
                @for ($i = 1; $i <= 64; $i++)
                    <div class="col-md-3 col-sm-6 mb-4" style="flex: 0 0 25%; max-width: 25%; text-align: center;">
                        <div class="flower-item text-center">
                            <!-- 画像のファイル名を手動で表示 -->
                            <img 
                                src="{{ asset('images/flowers/' . str_pad($i, 2, '0', STR_PAD_LEFT) . '.jpeg') }}" 
                                alt="Flower {{ $i }}" 
                                class="flower-image" 
                                data-flower-id="{{ $i }}"
                                style="width: 100%; height: auto; border: 2px solid transparent; cursor: pointer;">
                            
                            <input type="checkbox" name="flowers[]" value="{{ $i }}" class="flower-checkbox" id="flower{{ $i }}" hidden>
                            
                            <label for="flower{{ $i }}" class="flower-label">
                                Flower {{ $i }}
                            </label>
                        </div>
                    </div>
                @endfor
            </div>

            <!-- ボタンのフォントサイズを大きくして中央寄せ -->
            <button type="submit" class="btn btn-primary mt-3" style="font-size: 1.5rem; margin-top: 20px;">選択を完了</button>
        </form>
    </div>

    <!-- CSS: 画像が選択されたときのスタイル -->
    <style>
        .flower-image {
            border: 2px solid transparent;
            transition: border-color 0.3s, opacity 0.3s;
        }

        .flower-image.selected {
            border-color: blue;
            opacity: 0.6;
        }

        .flower-item {
            margin-bottom: 20px; /* 各画像の下にスペースを確保 */
        }
    </style>

    <!-- JavaScript: 画像のクリックで選択・解除 -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const flowerImages = document.querySelectorAll('.flower-image');
            const maxSelection = 3;

            flowerImages.forEach(function (img) {
                img.addEventListener('click', function () {
                    const flowerId = img.getAttribute('data-flower-id');
                    const checkbox = document.getElementById('flower' + flowerId);

                    if (checkbox.checked) {
                        checkbox.checked = false;
                        img.classList.remove('selected');
                    } else {
                        const selectedImages = document.querySelectorAll('.flower-image.selected');
                        if (selectedImages.length < maxSelection) {
                            checkbox.checked = true;
                            img.classList.add('selected');
                        } else {
                            alert('You can only select up to ' + maxSelection + ' flowers.');
                        }
                    }
                });
            });
        });
    </script>
</x-app-layout>
