@extends('errors.error_layout')

@section('error-title')
    You are not enrolled in this course
@endsection

@section('error-image')
    <img src="/assets/images/error.jpg" width="100%" alt="">
@endsection

@section('error-text')
    Please ensure you are enrolled to the course lessons you are trying to access.
    If this is a mistake you are seeing, please contact support for assistance.
@endsection