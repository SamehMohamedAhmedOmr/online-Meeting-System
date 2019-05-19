@extends('layouts.app')

@section('styles')
<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/tables.css') }}" />
@endsection

@section('content')
<div class="main-panel">
    <div class="content-wrapper">

        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="card">
                    <div class="card-header top-card">
                        <span class="name">{{ $member->name }}</span>
                        <span>Data</span>
                    </div>

                    <div class="card-body">
                        <div class="mb-3">
                            <a style='text-decoration:none;' href="{{ url('users') }}" title="Back">
                                <button class="btn btn-warning btn-sm" style="color:#fff;">
                                    <i class="fa fa-arrow-left" style="font-size: 0.875rem" aria-hidden="true"></i> Back
                                </button>
                            </a>
                        </div>

                        <div class="table-responsive view-data">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th> Name </th>
                                        <td> {{ $member->name }} </td>
                                    </tr>
                                    <tr>
                                        <th> Email </th>
                                        <td> {{ $member->email }} </td>
                                    </tr>
                                    <tr>
                                        <th> Type </th>
                                        <td> {{ $cas }} </td>
                                    </tr>

                                    <tr>
                                        <th> Faculty </th>

                                        <td> {{ \App\Faculty::where(['id' => $faculty_member->faculty_id])->pluck('faculty_name')->first() }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th> Department </th>

                                        <td> {{ \App\Department::where(['id' => $faculty_member->department_id])->pluck('department_name')->first() }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th> Position </th>

                                        <td> {{ \App\Position::where(['id' => $faculty_member->position_id])->pluck('position_name')->first() }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th> Rank </th>

                                        <td> {{ \App\Rank::where(['id' => $faculty_member->rank_id])->pluck('rank_name')->first() }}
                                        </td>
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
