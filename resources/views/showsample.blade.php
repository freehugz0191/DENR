@extends('layouts.app')

@section('content')
    <h2>{{$data->title}}</h2>
    <p><iframe src="{{url('storage/'.$data->file)}}" frameborder="0" style="height: 500px; width: 500px"></iframe></p>
@endsection