{{-- @extends('errors::minimal') --}}
@extends('errors::template')

@section('title', __('Service Unavailable'))
@section('code', '503')
@section('message', __('Service Unavailable'))
