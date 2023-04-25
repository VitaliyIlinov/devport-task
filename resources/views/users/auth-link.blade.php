<?php
/**
 * @var  \Illuminate\Support\Collection<\App\Models\UserLink>$links
 */

?>
@extends('layout')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-7">
            <h2 class="text-center">Link form</h2>
            @include('includes.form-builder',['action' => route('users.store')])
        </div>
    </div>
@endsection
