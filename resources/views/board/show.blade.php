@extends('layouts.app')

@section('content')
<h4>{{$board->name}}</h4>
<board id="{{$board->id}}"></board>
@endsection
