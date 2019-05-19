@extends('layouts.app')

@section('content')

<!------ Include the above in your HEAD tag ---------->
<link rel="stylesheet" href="{{ URL::asset('css/login.css') }}">
    <div class="container">
        <div class="row">
                <div class="wrapper fadeInDown">
                        <div id="formContent">
                          <!-- Tabs Titles -->

                          <!-- Icon -->
                          <div class="fadeIn first">
                               Login
                          </div>

<!-- Login Form -->
<form action="{{ url('councilDefinition/' . $id) }}">
    <input type="text" id="login" class="fadeIn second" name="user_name" placeholder="login">
    <input type="password" id="password" class="fadeIn third" name="password" placeholder="password">
    <input type="submit" id="click" class="fadeIn fourth" value="Log In" >
  </form>




                        </div>
                      </div>

            @endsection
