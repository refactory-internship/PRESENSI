@extends('errors.illustrated-layout')

@section('title', 'Forbidden')
@section('code', '403')
@section('message', $exception->getMessage() ?: 'Sorry, you are forbidden from accessing this page.')
