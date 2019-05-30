@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Topics</div>
                    <div class="card-body">

                        @if(session()->has('error'))
                        <div class="alert alert-danger">
                            {{ session()->get('error') }}
                        </div>
                    @endif
                    @if(session()->has('flash_message'))
                        <div class="alert alert-success">
                            {{ session()->get('flash_message') }}
                        </div>
                    @endif
                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th><th>Faculty Member</th><th>List Of Membership Order</th><th>Job</th><th>Actions</th>
                                    </tr>
                                </thead>
                                <a href="{{ url('meeting/'.$meeting) }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>

                                <tbody>
                                @foreach($topics as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->faculty_member }}</td>
                                        <td>{{App\Position::where('id',$item->list_of_member_order)->pluck('position_name')->first()}}</td>
                                        <td>
                                        @if($item->job ==0)
                                        Supervisor
                                        @elseif($item->job==1)
                                        Rapporteur
                                        @else
                                        Member
                                        @endif
                                        </td>
                                        <td>

                                            <form method="get" action="{{ url('topicsdelete/'. $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-sm" title="Delete topic" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $topics->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
