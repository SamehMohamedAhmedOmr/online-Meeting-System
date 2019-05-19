@extends('layouts.app')

@section('styles')
<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/specialFileInput.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/tables.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/meeting.css') }}" />
@endsection

@section('content')
<iframe src ="{{ asset('/storage/subject_att/209/209_GPs_evaluation_18-19_2.pdf') }}" width="1000px" height="600px"></iframe>

@endsection


