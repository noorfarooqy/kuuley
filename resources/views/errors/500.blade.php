@extends('errors.error_layout')

@section('error-title')
    Server error
@endsection

@section('error-image')
    <img src="/assets/images/error.jpg" width="100%" alt="">
@endsection

@section('error-text')
    Something went wrong with server while processing your request.
    Please contact support to report the cause of this error.
@endsection