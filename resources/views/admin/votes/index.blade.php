@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header"> {{ __('Staff.Votes') }}</div>
                    <div class="card-body">
                        <a href="{{ url('/admin/votes/create') }}" class="btn btn-success btn-sm" title="Add New vote">
                            <i class="fa fa-plus" aria-hidden="true"></i> {{ __('home.add') }}
                        </a>

                        <form method="GET" action="{{ url('/admin/votes') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right" role="search">
                            <div class="input-group">
                                <input type="text" class="form-control" name="search" placeholder="Search..." value="{{ request('search') }}">
                                <span class="input-group-append">
                                    <button class="btn btn-secondary" type="submit">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                        </form>

                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th><th>{{ __('Staff.Councilmembers') }}</th><th>{{ __('Staff.Votes') }}</th><th>{{ __('Staff.Subject') }}</th><th>{{ __('home.Actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($votes as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->council_member_id }}</td><td>{{ $item->vote }}</td><td>{{ $item->subject_type_id }}</td>
                                        <td>
                                            <a href="{{ url('/admin/votes/' . $item->id) }}" title="View vote"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> {{ __('home.View') }}</button></a>
                                            <a href="{{ url('/admin/votes/' . $item->id . '/edit') }}" title="Edit vote"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> {{ __('home.Edit') }}</button></a>

                                            <form method="POST" action="{{ url('/admin/votes' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-sm" title="Delete vote" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> {{ __('home.Delete') }}</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $votes->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
