@extends('errors.error_layout')

@section('error-title')
    Not found
@endsection

@section('error-image')
    <img src="/assets/images/404.png" width="100%" alt="">
@endsection

@section('error-text')
    The resource you are trying to access could not be found.
    If this is a mistake you are seeing, please contact support for assistance.
@endsection