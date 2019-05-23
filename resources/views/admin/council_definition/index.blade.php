@extends('layouts.app')

@section('styles')
<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/tables.css') }}" />

@endsection

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div id="SuccessDelete" class="flash-message "
            style="display: none;width: 50%; margin: auto;box-shadow: 1px 1px 2px #fff , -1px -1px 1px #fff;">
            <p class="alert alert-success text-white" style="text-align: center;"> &nbsp;
                {{ __('admin.Council Deleted Successfully') }} <i class="fas fa-check-double"></i></p>
        </div>

        <div class="row">
            <div class="col-md-12 grid-margin">
                @include('messages')
                <div class="card">
                    <div class="card-header top-card">Council Definition</div>
                    <div class="card-body">
                        @if (Auth::user()->type == 0)
                            <div class="p-3">
                                <a href="{{ url('createCouncilDefinition') }}" class="btn btn-success btn-sm" title="Add New Council Definition">
                                    <i class="fa fa-plus" aria-hidden="true"></i> Add New
                                </a>
                            </div>
                        @endif


                        <!-- Content Row -->
                        <div class="table-responsive m-0 p-0 m-auto p-3">
                            <table class="table col-11 m-auto p-0 table-hover" id="get-data">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Faculty</th>
                                        <th>Number of Members</th>
                                        <th>Number of Meeting</th>
                                        <th class="no-sort">options</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>

                        <!-- Delete Modal -->
                        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog"
                            aria-labelledby="deleteModal" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header d-flex justify-content-center">
                                        <h5 class="modal-title text-sm-center text-secondary" style="font-size: 14px;"
                                            id="exampleModalLabel">
                                            {{ __('admin.delete Council') }}
                                        </h5>
                                        <input type="hidden" value="" id="RemoveItem">
                                    </div>
                                    <div class="modal-footer d-flex justify-content-center" style="border:none">
                                        <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-danger" data-dismiss="modal"
                                            data-backdrop="false" onclick="DeleteItem()">Delete</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')

<script src="{{ URL::asset('js/ajax/getCouncilDefintion.js') }}"
    id='scriptDefinition' data-type="{{ Auth::user()->type }}" data-lang="{{ App::getLocale() }}" ></script>

@endsection
