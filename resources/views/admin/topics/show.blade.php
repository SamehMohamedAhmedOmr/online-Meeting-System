@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">topic {{ $topic->id }}</div>
                    <div class="card-body">

                        <a href="{{ url('topics') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>

                        <form method="POST" action="{{ url('topics' . '/' . $topic->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete topic" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $topic->id }}</td>
                                    </tr>
                                    <tr><th> Council Meeting Subject Id </th><td> {{ $topic->council_meeting_subject_id }} </td></tr><tr><th> Faculty Member </th><td> {{ $topic->faculty_member }} </td></tr><tr><th> Council Member ID </th><td> {{ $topic->council_member_ID }} </td></tr>

                                    <tr><th> Job </th><td>
                                        @if($topic->job ==0)
                                        Supervisor
                                        @elseif($topic->job==1)
                                        Rapporteur
                                        @else
                                        Member
                                        @endif

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
@endsection
