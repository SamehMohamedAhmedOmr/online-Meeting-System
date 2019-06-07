@extends('layouts.app')

@section('pageTitle')
    {{ __('pageTitle.home Page') }}
@endsection

@section('content')
      <!-- partial -->
      <div class="main-panel">
          @if(Auth::user()->type==0)
            <div class="content-wrapper">
                    <div class="row">
                            <div class="col-md-12 grid-margin stretch-card">
                                    <div class="card">
                                            <div class="card-body dashboard-tabs p-0">

                                        <button class="col-md-4 btn btn-danger mt-2 mt-xl-0" style="float:right;text-align: center;"  data-toggle="modal" data-target="#deletechatModal">{{__("home.Delete All Chat Rooms Messages")}}</button>
                                        <button class="col-md-4 btn btn-danger mt-2 mt-xl-0" data-toggle="modal" data-target="#cleanModal">{{__("home.Clean Slate Protocol")}}</button>
                                        <button class="col-md-4 btn btn-danger mt-2 mt-xl-0" style="float: left;text-align: center;"  data-toggle="modal" data-target="#notifyModal">{{__("home.Delete Notification")}}</button>

                                  </div>
                             </div>
                         </div>
                    </div>
@endif
                @if (Auth::user()->type==0)
          <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body dashboard-tabs p-0">
                  <ul class="nav nav-tabs px-4" role="tablist">
                    <li class="nav-item">
                      <a class="nav-link active" id="overview-tab" data-toggle="tab" href="#overview" role="tab" aria-controls="overview" aria-selected="true">{{__("home.Admin")}}</a>
                    </li>
                  </ul>
                  <div class="tab-content py-0 px-0">
                  <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview-tab">
                    <div class="d-flex flex-wrap justify-content-xl-between">
                      <div class="d-none d-xl-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                            <i class="mdi mdi-counter mr-3 icon-lg text-warning"></i>
                            <div class="d-flex flex-column justify-content-around">
                          <small class="mb-1 text-muted">{{ __('admin.Users') }}</small>
                          <div class="dropdown">
                            <h5 class="mb-0 d-inline-block">{{$usercount}}</h5>


                          </div>
                        </div>
                      </div>
                      <div class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                        <i class="mdi mdi-home-variant mr-3 icon-lg text-danger"></i>
                        <div class="d-flex flex-column justify-content-around">
                          <small class="mb-1 text-muted">{{ __('admin.faculties') }} </small>
                        <h5 class="mr-2 mb-0">{{$faculty}}</h5>
                        </div>
                      </div>
                      <div class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                        <i class="mdi mdi-format-section mr-3 icon-lg text-success"></i>
                        <div class="d-flex flex-column justify-content-around">
                          <small class="mb-1 text-muted">{{ __('admin.Departments') }}</small>
                          <h5 class="mr-2 mb-0">{{$depratment}}</h5>
                        </div>
                      </div>
                      <div class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                            <i class="mdi mdi-counter mr-3 icon-lg text-warning"></i>
                        <div class="d-flex flex-column justify-content-around">
                          <small class="mb-1 text-muted">{{__("Staff.Councildefinitions")}}</small>
                          <h5 class="mr-2 mb-0">{{$Council}}</h5>
                        </div>
                      </div>
                    </div>
                  </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!--member view -->
          @elseif(Auth::user()->type==2)
          <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                  <div class="card">
                    <div class="card-body dashboard-tabs p-0">
                      <ul class="nav nav-tabs px-4" role="tablist">
                        <li class="nav-item">
                          <a class="nav-link active" id="sales-tab" data-toggle="tab" href="#sales" role="tab" aria-controls="sales" aria-selected="false">{{__("admin.member")}}</a>
                        </li>
                      </ul>
                      <div class="tab-content py-0 px-0">

                        <div class="tab-pane fade show active" id="sales" role="tabpanel" aria-labelledby="sales-tab">
                          <div class="d-flex flex-wrap justify-content-xl-between">
                            <div class="d-none d-xl-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                                    <i class="mdi mdi-counter mr-3 icon-lg text-warning"></i>
                                    <div class="d-flex flex-column justify-content-around">
                                <small class="mb-1 text-muted">{{__("admin.Total Meeting Your in")}} </small>
                                <div class="dropdown">
                                  <h5 class="mb-0 d-inline-block">{{$total}}</h5>
                                </div>
                              </div>
                            </div>
                            <div class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                                    <i class="mdi mdi-book-open mr-3 icon-lg text-success"></i>
                                    <div class="d-flex flex-column justify-content-around">
                                <small class="mb-1 text-muted">{{__("admin.Opened Meetings")}}</small>
                                <h5 class="mr-2 mb-0">{{$openmeetingscount}}</h5>
                              </div>
                            </div>
                            <div class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                                    <i class="mdi mdi-checkbox-blank mr-3 icon-lg text-danger"></i>
                                    <div class="d-flex flex-column justify-content-around">
                                <small class="mb-1 text-muted">{{__("admin.Closed Meetings")}}</small>
                              <h5 class="mr-2 mb-0">{{$colsedmeetingscount}}</h5>
                              </div>
                            </div>
                            <div class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                                    <i class="mdi mdi-calendar-heart icon-lg mr-3 text-primary"></i>
                                    <div class="d-flex flex-column justify-content-around">
                                <small class="mb-1 text-muted">{{__("admin.Nearset Meeting Number/Date")}}</small>
                              <h5 class="mr-2 mb-0">{{$upcoming_birthdays->meeting_number}}/{{$upcoming_birthdays->meeting_date}}</h5>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!--staff view -->
              @else
              <div class="row">
                    <div class="col-md-12 grid-margin stretch-card">
                      <div class="card">
                        <div class="card-body dashboard-tabs p-0">
                          <ul class="nav nav-tabs px-4" role="tablist">

                                <li class="nav-item">
                    <a class="nav-link active" id="purchases-tab" data-toggle="tab" href="#purchases" role="tab" aria-controls="purchases" aria-selected="false">{{__("home.Staff")}}</a>
                  </li>
                  <li class="nav-item">
                        <a class="nav-link " id="sales-tab" data-toggle="tab" href="#sales" role="tab" aria-controls="sales" aria-selected="false">{{__("admin.member")}}</a>
                      </li>
                </ul>
                <div class="tab-content py-0 px-0">

                  <div class="tab-pane fade show active " id="purchases" role="tabpanel" aria-labelledby="purchases-tab">
                    <div class="d-flex flex-wrap justify-content-xl-between">
                      <div class="d-none d-xl-flex border-md-right flex-grow-1 align-items-center justify-content-center p-2 item">
                            <i class="mdi mdi-counter mr-3 icon-lg text-warning"></i>
                            <div class="d-flex flex-column justify-content-around">
                          <small class="mb-1 text-muted">{{__("Staff.Ranks")}}</small>
                          <div class="dropdown">
                          <h5 class="mb-0 d-inline-block">{{$rank}}</h5>
                          </div>
                        </div>
                      </div>
                      <div class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-2 item">
                            <i class="mdi mdi-counter mr-3 icon-lg text-warning"></i>
                            <div class="d-flex flex-column justify-content-around">
                          <small class="mb-1 text-muted">{{__("Staff.Positions")}}</small>
                        <h5 class="mr-2 mb-0">{{$position}}</h5>
                        </div>
                      </div>
                      <div class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-2 item">
                            <i class="mdi mdi-counter mr-3 icon-lg text-warning"></i>
                            <div class="d-flex flex-column justify-content-around">
                          <small class="mb-1 text-muted">{{__("home.Subject")}}</small>
                        <h5 class="mr-2 mb-0">{{$subjects}}</h5>
                        </div>
                      </div>
                      <div class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-2 item">
                            <i class="mdi mdi-counter mr-3 icon-lg text-warning"></i>
                            <div class="d-flex flex-column justify-content-around">
                          <small class="mb-1 text-muted">{{__("Staff.Councildefinitions")}}</small>
                        <h5 class="mr-2 mb-0">{{$i}}</h5>
                        </div>
                      </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="sales" role="tabpanel" aria-labelledby="sales-tab">
                        <div class="d-flex flex-wrap justify-content-xl-between">
                          <div class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-2 item">
                                <i class="mdi mdi-counter mr-3 icon-lg text-warning"></i>
                                <div class="d-flex flex-column justify-content-around">
                                  <small class="mb-1 text-muted">{{__("admin.Total Meeting Your in")}}</small>
                                <h5 class="mr-2 mb-0">{{$total}}</h5>
                                </div>
                              </div>
                        <div class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                          <i class="mdi mdi-book-open mr-3 icon-lg text-success"></i>
                          <div class="d-flex flex-column justify-content-around">
                            <small class="mb-1 text-muted">{{__("admin.Opened Meetings")}}</small>
                            <h5 class="mr-2 mb-0">{{$openmeetingscount}}</h5>
                          </div>
                        </div>
                        <div class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                          <i class="mdi mdi-checkbox-blank mr-3 icon-lg text-danger"></i>
                          <div class="d-flex flex-column justify-content-around">
                            <small class="mb-1 text-muted">{{__("admin.Closed Meetings")}}</small>
                          <h5 class="mr-2 mb-0">{{$colsedmeetingscount}}</h5>
                          </div>
                        </div>
                        <div class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                                <i class="mdi mdi-calendar-heart icon-lg mr-3 text-primary"></i>
                                <div class="d-flex flex-column justify-content-around">
                            <small class="mb-1 text-muted">{{__("admin.Nearset Meeting Number/Date")}}</small>
                          <h5 class="mr-2 mb-0">{{$upcoming_birthdays->meeting_number}}/{{$upcoming_birthdays->meeting_date}}</h5>
                          </div>
                        </div>
                    </div>
                  </div>
            </div>
          </div>
        </div>
                    </div>
              </div>

          @endif


          <div class="row">
            <div class="col-md-12 stretch-card">
              <div class="card">
                <div class="card-body">

                                    @if(Auth::user()->type==0)
                                    <p class="card-title">{{__("Staff.Latest Added Users")}}</p>
                                    <div class="table-responsive">
                                          <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                              <thead>
                                    <tr>
                                    <th>{{ __('admin.Member Name') }}</th>
                                    <th>{{ __('admin.Email') }}</th>


                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $item)

                                <tr>
                                    <td>
                                        {{ $item->name }}
                                    </td>
                                    <td>
                                        {{ $item->email }}
                                    </td>

                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                                @else
                                <p class="card-title">{{__("Staff.Latest Meetings")}}</p>
                                <div class="table-responsive">
                                      <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                          <thead>
                                                <tr>
                                                        <th class="no-sort">{{__("Staff.Meetingnumber")}}</th>
                                                        <th class="no-sort">{{__("Staff.Meetingdate")}}</th>

                                                        <th class="no-sort">{{__("Staff.Meetingtime")}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($last as $item)

                            <tr>
                                <td>
                                    {{ $item->meeting_number }}
                                </td>
                                <td>
                                    {{ $item->meeting_date }}
                                </td>
                                <td>
                                        {{ $item->meeting_time }}
                                    </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

@endif
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
      </div>
      </div>
      <!-- main-panel ends -->
        <!-- Delete Modal -->
        <div class="modal fade" id="deletechatModal" tabindex="-1" role="dialog"
        aria-labelledby="deletechatModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header d-flex justify-content-center">
                    <h5 class="modal-title text-sm-center text-secondary" style="font-size: 14px;"
                        id="exampleModalLabel">
                        {{__("Staff.All Messages will be will Delete Permanently , Are you sure")}}
                    </h5>
                    <input type="hidden" value="" id="RemoveItem">
                </div>
                <div class="modal-footer d-flex justify-content-center" style="border:none">
                    <button type="button" class="btn btn-info"
                        data-dismiss="modal">{{__("home.Close")}}</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal"
                data-backdrop="false" onclick="location.href='deletefirebase'" >{{__("home.Delete")}}</button>
            </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="notifyModal" tabindex="-1" role="dialog"
        aria-labelledby="notifyModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header d-flex justify-content-center">
                    <h5 class="modal-title text-sm-center text-secondary" style="font-size: 14px;"
                        id="exampleModalLabel">
                        {{__("Staff.Notifications be will Delete Permanently , Are you sure?")}}
                    </h5>
                    <input type="hidden" value="" id="RemoveItem">
                </div>
                <div class="modal-footer d-flex justify-content-center" style="border:none">
                    <button type="button" class="btn btn-info"
                        data-dismiss="modal">{{__("home.Close")}}</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal"
                data-backdrop="false" onclick="location.href='deletenotification'" >{{__("home.Delete")}}</button>
            </div>
            </div>
        </div>
    </div>



    <div class="modal fade" id="cleanModal" tabindex="-1" role="dialog"
        aria-labelledby="cleanModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header d-flex justify-content-center">
                    <h5 class="modal-title text-sm-center text-secondary" style="font-size: 14px;"
                        id="exampleModalLabel">
                        {{__("Staff.Website Data will Delete Permanently , Are you sure")}}
                    </h5>
                    <input type="hidden" value="" id="RemoveItem">
                </div>
                <div class="modal-footer d-flex justify-content-center" style="border:none">
                    <button type="button" class="btn btn-info"
                        data-dismiss="modal">{{__("home.Close")}}</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal"
                data-backdrop="false" onclick="location.href='cleanslate'" >{{__("home.Delete")}}</button>
            </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog"
    aria-labelledby="deleteModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header d-flex justify-content-center">
                <h5 class="modal-title text-sm-center text-secondary" style="font-size: 14px;"
                    id="exampleModalLabel">
                    {{__("Staff.Meeting will Delete Permanently , Are you sure ?")}}
                </h5>
                <input type="hidden" value="" id="RemoveItem">
            </div>
            <div class="modal-footer d-flex justify-content-center" style="border:none">
                <button type="button" class="btn btn-info"
                    data-dismiss="modal">{{__("home.Close")}}</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal"
                    data-backdrop="false" onclick="DeleteItem()">{{__("home.Delete")}}</button>
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
