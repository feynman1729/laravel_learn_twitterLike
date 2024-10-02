<x-app-layout>
    <div class="container">
        <h1>好きな花を3つ選んでください</h1>
        
        <form action="{{ route('store.flowers') }}" method="POST" id="flower-selection-form">
            @csrf
            <div>
                @foreach ($flowers as $flower)
                    <div style="display: inline-block; margin: 10px;">
                        <div class="flower-item">
                            <!-- 画像のファイル名を花のIDに基づいて表示 -->
                            <img 
                                src="{{ asset('images/flowers/' . str_pad($flower->id, 2, '0', STR_PAD_LEFT) . '.jpeg') }}" 
                                alt="{{ $flower->name }}" 
                                class="flower-image" 
                                data-flower-id="{{ $flower->id }}">
                            <input type="checkbox" name="flowers[]" value="{{ $flower->id }}" class="flower-checkbox" id="flower{{ $flower->id }}" hidden>
                            <label class="form-check-label" for="flower{{ $flower->id }}">
                                {{ $flower->name }} - {{ $flower->symbol }}
                            </label>
                        </div>
                    </div>
                @endforeach
            </div>

            <button type="submit" class="btn btn-primary mt-3">選択を完了</button>z
        </form>
    </div>

    <style>
        .flower-image {
            width: 100px;
            height: 100px;
            cursor: pointer;
            border: 2px solid transparent;
        }

        .flower-image.selected {
            border-color: blue;
            opacity: 0.6;
        }
    </style>

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
