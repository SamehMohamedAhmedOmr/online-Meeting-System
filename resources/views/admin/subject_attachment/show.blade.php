@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">subject_attachment {{ $subject_attachment->id }}</div>
                    <div class="card-body">

                        <a href="{{ url('/subjectAttachment') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/subjectAttachment/' . $subject_attachment->id . '/edit') }}" title="Edit subject_attachment"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                        <form method="POST" action="{{ url('subjectAttachment' . '/' . $subject_attachment->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete subject_attachment" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $subject_attachment->id }}</td>
                                    </tr>
                                    <tr><th> Meeting Number </th><td> {{ $subject_attachment->meeting_number }} </td></tr><tr><th> Subject Id </th><td> {{ $subject_attachment->subject_id }} </td></tr><tr><th> Attachment Document </th><td> {{ $subject_attachment->attachment_document }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
