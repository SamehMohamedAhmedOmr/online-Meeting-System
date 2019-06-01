@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{__(("Staff.Topics"))}}</div>
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
                        <div class="table-responsive view-data">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                    <th>#</th><th>{{__("Staff.Faculty Member")}}</th><th>{{__("Staff.List Of Membership Order")}}</th><th>{{__("Staff.Job")}}</th><th>{{__("home.Actions")}}</th>
                                    </tr>
                                </thead>
                                <a href="{{ url('meeting/'.$meeting) }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i>{{__("home.Back")}}</button></a>

                                <tbody>
                                @foreach($topics as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->faculty_member }}</td>
                                        <td>{{App\Position::where('id',$item->list_of_member_order)->pluck('position_name')->first()}}</td>
                                        <td>
                                        @if($item->job ==0)
                                        {{__("Staff.Supervisor")}}
                                        @elseif($item->job==1)
                                        {{__("Staff.Rapporteur")}}
                                        @else
                                        {{__("Staff.Member")}}
                                        @endif
                                        </td>
                                        <td>

                                            <form method="get" action="{{ url('topicsdelete/'. $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-sm"  onclick="return confirm(&quot; {{__('Staff.Confirm delete')}}&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> {{__("home.Delete")}}</button>
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
@section('scripts')
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
@endsection

