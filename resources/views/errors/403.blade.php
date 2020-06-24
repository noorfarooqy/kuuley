@extends('errors.error_layout')

@section('error-title')
    Access denied
@endsection

@section('error-image')
    <img src="/assets/images/access.jpg" width="100%" alt="">
@endsection

@section('error-text')
    You do not have access to this resource.
    If this is a mistake you are seeing, please contact support for assistance.
@endsection