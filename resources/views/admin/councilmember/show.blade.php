@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">councilmember {{ $councilmember->id }}</div>
                    <div class="card-body">

                        <a href="{{ url('/councilmember') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/councilmember/' . $councilmember->id . '/edit') }}" title="Edit councilmember"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                        <form method="POST" action="{{ url('/councilmember' . '/' . $councilmember->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete councilmember" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $councilmember->id }}</td>
                                    </tr>
                                    <tr><th> Council Definition Id </th><td> {{ $councilmember->council_definition_id }} </td></tr><tr><th> Faculty Member Id </th><td> {{ $councilmember->faculty_member_id }} </td></tr><tr><th> Start Date Of Membership </th><td> {{ $councilmember->start_date_of_membership }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
