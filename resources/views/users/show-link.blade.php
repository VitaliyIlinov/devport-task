<?php
/**
 * @var \App\Models\UserLink $link
 */

?>
@extends('layout')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-7 text-center">
            <h2>Link user auth</h2>
            <p>
                <a href="{{$link->full_url}}" class="btn btn-outline-success" target="_blank">
                    {{$link->full_url}}
                </a>
            </p>
        </div>
    </div>
@endsection
