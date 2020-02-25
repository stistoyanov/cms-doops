@extends('layouts.app')

<style>
    iframe{
        margin-top: -1.5rem;
        height: 97%;
        width: 100%;
        position: fixed;
    }
</style>

@section('content')
<iframe src="/logs-viewer" frameborder="0"></iframe>
@endsection