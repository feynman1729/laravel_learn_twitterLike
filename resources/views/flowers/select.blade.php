<?php

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>好きな花を3つ選んでください</h1>

        <form action="{{ route('select.flowers') }}" method="POST">
            @csrf
            <div class="row">
                @foreach ($flowers as $flower)
                    <div class="col-md-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="flowers[]" value="{{ $flower->id }}" id="flower{{ $flower->id }}">
                            <label class="form-check-label" for="flower{{ $flower->id }}">
                                {{ $flower->name }} - {{ $flower->symbol }}
                            </label>
                        </div>
                    </div>
                @endforeach
            </div>

            <button type="submit" class="btn btn-primary mt-3">選択を完了</button>
        </form>
    </div>
@endsection