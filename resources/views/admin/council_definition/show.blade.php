@extends('layouts.app')

@section('styles')
<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/tables.css') }}" />
@endsection

@section('content')
<div class="main-panel">
    <div class="content-wrapper">

        <div class="row">
            <div class="col-md-12 grid-margin">
                @include('messages')
                <div class="card">
                    <div class="card-header top-card">
                        <span class="name">{{ $council_definition->council_name }}</span>
                        <span>Data</span>
                    </div>

                    <div class="card-body">
                        <div class="mb-3">
                            <a style='text-decoration:none;' href="{{ url('councilDefinition') }}" title="Back">
                                <button class="btn btn-warning btn-sm" style="color:#fff;">
                                    <i class="fa fa-arrow-left" style="font-size: 0.875rem" aria-hidden="true"></i> Back
                                </button>
                            </a>
                        </div>

                        <div class="table-responsive view-data">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th> Council Name </th>
                                        <td> {{ $council_definition->council_name }} </td>
                                    </tr>
                                    <tr>
                                        <th> Number Of Members </th>
                                        <td> {{ $council_definition->number_of_members }} </td>
                                    </tr>
                                    <tr>
                                        <th> Faculty </th>
                                        <td> {{ $council_definition->Faculty->faculty_name }} </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>

        <script data-lang="{{ App::getLocale() }}" id='dataTableAjaxScript'>
            $(function () {
                var lang = $('#dataTableAjaxScript').data('lang');
                if(lang == 'ar'){
                    var arabicLanguage = {
                        "sProcessing": "جارٍ التحميل...",
                        "sLengthMenu": "أظهر _MENU_ مدخلات",
                        "sZeroRecords": "لم يعثر على أية سجلات",
                        "sInfo": "إظهار _START_ إلى _END_ من أصل _TOTAL_ مدخل",
                        "sInfoEmpty": "يعرض 0 إلى 0 من أصل 0 سجل",
                        "sInfoFiltered": "(منتقاة من مجموع _MAX_ مُدخل)",
                        "sInfoPostFix": "",
                        "sSearch": "ابحث:",
                        "sUrl": "",
                        "oPaginate": {
                        "sFirst": "الأول",
                        "sPrevious": "السابق",
                        "sNext": "التالي",
                        "sLast": "الأخير"
                        }
                    };
                }
                else{
                    var arabicLanguage = {};
                }
                $('#dataTables-example').dataTable({
                    "language": arabicLanguage,
                });
            });

        </script>

        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header top-card">Council Member</div>
                    <div class="card-body">
                        @if (Auth::user()->type == 0)
                        <div class="row">
                            @if ($allowMembers != 0)
                                <div class="col-6 d-flex">
                                    <a href="{{ url('councilmember/create/'.$council_definition->id) }}"
                                        class="btn btn-success btn-sm" title="Add New councilmember"
                                        style="line-height:20px">
                                        <i class="fa fa-plus" aria-hidden="true"></i> Add New Council Member
                                    </a>
                                </div>
                            @endif

                            @if ($chairman < 1 && $chairman >=0)
                                <div class="col-6 d-flex">
                                    <a href="{{ url('councilChairman/create/'.$council_definition->id) }}"
                                        class="btn btn-success btn-sm" title="Add Chairman of Council"
                                        style="line-height:20px">
                                        <i class="fa fa-plus" aria-hidden="true"></i> Add Chairman of Council
                                    </a>
                                </div>
                            @endif

                        </div>
                        @endif

                        <br />
                        <br />
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>Faculty Member</th>
                                        <th>Type</th>
                                        <th>Start Date Of Membership</th>
                                        <th>End Date Of Membership</th>
                                        @if (Auth::user()->type == 0)
                                        <th>Actions</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($councilmember as $item)

                                    <tr>
                                        <td>
                                            {{ $item->Faculty_member->User->name }}
                                        </td>
                                        <td>
                                            @if ($item->type == 0 )
                                                Chairman
                                            @else
                                                Member
                                            @endif
                                        </td>
                                        <td>
                                            {{ $item->start_date_of_membership }}
                                        </td>
                                        <td>
                                            {{ $item->end_date_of_membership }}
                                        </td>
                                        @if (Auth::user()->type == 0)
                                        <td>
                                            <a href="{{ url('councilmember/' . $item->id . '/edit') }}"
                                                title="Edit councilmember" class="btn btn-sm btn-info text-white ml-2">
                                                <i class="fas fa-marker" aria-hidden="true"></i>
                                            </a>

                                            <a class="btn btn-sm btn-danger text-white" data-toggle="modal"
                                                data-target="#deleteMemberModal{{ $item->id }}">
                                                <i class="far fa-trash-alt" aria-hidden="true"></i>
                                            </a>

                                            @include('admin.council_definition.deleteMember')

                                        </td>
                                        @endif
                                    </tr>
                                    @endforeach
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
