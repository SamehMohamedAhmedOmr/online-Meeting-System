@extends('layouts.app')

@section('styles')
<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/tables.css') }}" />
@endsection

@section('pageTitle')
    {{ __('admin.faculties') }}
@endsection

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div id="SuccessDelete" class="flash-message "
            style="display: none;width: 50%; margin: auto;box-shadow: 1px 1px 2px #fff , -1px -1px 1px #fff;">
            <p class="alert alert-success text-white" style="text-align: center;"> &nbsp;
                {{ __('admin.Faculty Deleted Successfully') }} <i class="fas fa-check-double"></i></p>
        </div>

        <div class="row">
            <div class="col-md-12 grid-margin">
                @include('messages')
                <div class="card">
                    <div class="card-header top-card">{{ __('admin.faculties') }}</div>
                    <div class="card-body">
                        <div class="p-3 add-new">
                            <a href="{{ url('faculty/create') }}" class="btn btn-success btn-sm" title="{{ __('admin.Add new Faculty') }}">
                                <i class="fa fa-plus" aria-hidden="true"></i> {{ __('admin.Add new Faculty') }}
                            </a>
                        </div>

                        <!-- Content Row -->
                        <div class="table-responsive m-0 p-0 m-auto p-3">
                            <table class="table col-11 m-auto p-0 table-hover" id="get-data">
                                <thead>
                                    <tr>
                                        <th class="no-sort">{{ __('admin.logo') }}</th>
                                        <th>{{ __('admin.Faculty Name') }}</th>
                                        <th class="no-sort">{{ __('admin.options') }}</th>
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
                                            {{ __('admin.delete Faculty') }}
                                        </h5>
                                        <input type="hidden" value="" id="RemoveItem">
                                    </div>
                                    <div class="modal-footer d-flex justify-content-center" style="border:none">
                                        <button type="button" class="btn btn-info" data-dismiss="modal">{{ __('home.Close') }}</button>
                                        <button type="button" class="btn btn-danger" data-dismiss="modal"
                                            data-backdrop="false" onclick="DeleteItem()">{{ __('home.Delete') }}</button>
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

<script src="{{ URL::asset('js/ajax/getfaculty.js') }}" data-lang="{{ App::getLocale() }}" id='dataTableAjaxScript'></script>

@endsection
