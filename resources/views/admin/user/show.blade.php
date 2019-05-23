@extends('layouts.app')

@section('styles')
<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/tables.css') }}" />
@endsection

@section('pageTitle')
{{ __('admin.Users') }} | {{ __('pageTitle.User Data Details') }}
@endsection

@section('content')
<div class="main-panel">
    <div class="content-wrapper">

        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="card">
                    <div class="card-header top-card">
                        @if (App::getLocale() == 'ar')
                            <span>{{ __('home.data') }}</span>
                        @endif
                        <span class="name">{{ $member->name }}</span>
                        @if (App::getLocale() == 'en')
                            <span>{{ __('home.data') }}</span>
                        @endif
                    </div>

                    <div class="card-body">
                        <div class="mb-3">
                            <a class='back-button' href="{{ url('users') }}" title="Back">
                                <button class="btn btn-warning btn-sm" >
                                    <i class="fa fa-arrow-left" aria-hidden="true"></i> {{ __('home.Back') }}
                                </button>
                           </a>
                        </div>

                        <div class="table-responsive view-data">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th> {{ __('admin.Name') }} </th>
                                        <td> {{ $member->name }} </td>
                                    </tr>
                                    <tr>
                                        <th> {{ __('admin.Email') }} </th>
                                        <td> {{ $member->email }} </td>
                                    </tr>
                                    <tr>
                                        <th> {{ __('admin.type') }} </th>
                                        <td> {{ $cas }} </td>
                                    </tr>

                                    <tr>
                                        <th> {{ __('admin.faculty') }} </th>
                                        @if (isset($faculty_member))
                                            <td>
                                                {{ \App\Faculty::where(['id' => $faculty_member->faculty_id])->pluck('faculty_name')->first() }}
                                            </td>
                                        @else
                                            <td></td>
                                        @endif
                                    </tr>
                                    <tr>
                                        <th> {{ __('admin.Department') }} </th>
                                        @if (isset($faculty_member))
                                            <td>
                                                {{ \App\Department::where(['id' => $faculty_member->department_id])->pluck('department_name')->first() }}
                                            </td>
                                        @else
                                            <td></td>
                                        @endif
                                    </tr>
                                    <tr>
                                        <th> {{ __('admin.Position') }} </th>
                                        @if (isset($faculty_member))
                                            <td>
                                                {{ \App\Position::where(['id' => $faculty_member->position_id])->pluck('position_name')->first() }}
                                            </td>
                                        @else
                                            <td></td>
                                        @endif
                                    </tr>
                                    <tr>
                                        <th> {{ __('admin.Rank') }} </th>
                                        @if (isset($faculty_member))
                                            <td>
                                                {{ \App\Rank::where(['id' => $faculty_member->rank_id])->pluck('rank_name')->first() }}
                                            </td>
                                        @else
                                            <td></td>
                                        @endif
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
