{{-- @extends('errors::minimal') --}}
@extends('errors::template')

@section('title', __('Unauthorized'))
@section('code', '401')
@section('message', __('Unauthorized'))
