@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">{{ __('Staff.Votes') }} {{ $vote->id }}</div>
                    <div class="card-body">

                        <a href="{{ url('/admin/votes') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i>  {{ __('home.Back') }}</button></a>
                        <a href="{{ url('/admin/votes/' . $vote->id . '/edit') }}" title="Edit vote"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Ed {{ __('home.Edit') }}it</button></a>

                        <form method="POST" action="{{ url('admin/votes' . '/' . $vote->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete vote" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i>  {{ __('home.Delete') }}</button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $vote->id }}</td>
                                    </tr>
                                    <tr><th> {{ __('Staff.Councilmembers') }}</th><td> {{ $vote->council_member_id }} </td></tr><tr><th> {{ __('Staff.Votes') }} </th><td> {{ $vote->vote }} </td></tr><tr><th> {{ __('Staff.Subject') }} </th><td> {{ $vote->subject_type_id }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
