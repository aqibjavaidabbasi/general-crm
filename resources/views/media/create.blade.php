@extends('layouts.app')

@section('page-title', 'Media')
@section('content')


<x-media :files=$files :fileTypes=$fileTypes :dates=$dates/>

@endsection
