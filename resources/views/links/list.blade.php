<?php
/**
 * @var \Illuminate\Support\Collection<\App\Models\UserLink> $links
 */

?>
@extends('layout')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-7">
            <form class="needs-validation" method="post" action="{{ route('user-links.store')}}">
                @csrf
                <button class="w-100 btn btn-info btn-lg" type="submit">Generate new link</button>
            </form>
        </div>
        <div class="col-md-5 text-end">
            <a href="{{route('users.logout')}}" class="link-primary" target="_blank">
                Logout
            </a>
        </div>
        @if($links->isNotEmpty())
            <div class="col-md-12 mt-5">
                <table class="table table-hover table-bordered">
                    <thead>
                    <tr>
                        <th scope="col">Lifetime</th>
                        <th scope="col">Link</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($links as $link)
                        <tr>
                            <td>{{$link->lifetime}}</td>
                            <td>
                                <a href="{{$link->full_url}}" class="btn btn-outline-success"
                                   target="_blank">
                                    {{$link->full_url}}
                                </a>
                            </td>
                            <td>
                                <a class=" btn link-secondary"
                                   href="{{ $link->trashed() ?route('user-links.activate',$link->id):route('user-links.deactivate',$link->id)}}">
                                    {{ $link->trashed() ? 'activate' : 'deactivate'}}
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @endif

        <div class="col-md-6">
            <button class="w-100 btn btn-primary btn-lg" id="lucky" type="button">Imfeelinglucky</button>
            <div id="feel_lucky"></div>
        </div>
        <div class="col-md-6">
            <button class="w-100 btn btn-primary btn-lg" id="history" type="button">History</button>
            <div id="show_history"></div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        let localKey = 'lottery_history';

        $('#lucky').on('click', function () {
            let int = getRandomArbitrary(0, 1000);
            let percent, val, data;
            switch (true) {
                case int > 900:
                    percent = 70;
                    break;
                case int > 600:
                    percent = 50;
                    break;
                case int > 300:
                    percent = 30;
                    break;
                default:
                    percent = 10;
            }
            val = Math.ceil((int * percent) / 100);
            data = JSON.parse(localStorage.getItem(localKey)) ?? [];
            if (data.length >= 3) {
                data.pop()
            }
            data.unshift(val)
            localStorage.setItem(localKey, JSON.stringify(data));
            $('#feel_lucky').html('').append(`<p class="alert alert-success">You win: ${val}</p>`);
        })

        $('#history').on('click', function () {
            let v = $("<div></div>"), data = (JSON.parse(localStorage.getItem(localKey))) ?? [];
            for (let key in data) {
                v.append(`<p class="alert alert-dark" >${data[key]}</p>`);
            }
            $('#show_history').html('').prepend(v);

        })

        function getRandomArbitrary(min, max) {
            min = Math.ceil(min);
            max = Math.floor(max);
            return Math.floor(Math.random() * (max - min) + min);
        }
    </script>
@endpush
