@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">council_meeting_subject {{ $council_meeting_subject->id }}</div>
                    <div class="card-body">

                        <a href="{{ url('/admin/council_meeting_subject') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/admin/council_meeting_subject/' . $council_meeting_subject->id . '/edit') }}" title="Edit council_meeting_subject"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                        <form method="POST" action="{{ url('admin/council_meeting_subject' . '/' . $council_meeting_subject->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete council_meeting_subject" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $council_meeting_subject->id }}</td>
                                    </tr>
                                    <tr><th> Council Definition </th><td> {{ $council_meeting_subject->council_definition }} </td></tr><tr><th> Council Meeting Id </th><td> {{ $council_meeting_subject->council_meeting_id }} </td></tr><tr><th> Subject Description </th><td> {{ $council_meeting_subject->subject_description }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
