@extends('layouts.app')

@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-lg-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                    <h4 class="card-title">Line chart</h4>
                    <canvas id="lineChart"></canvas>
                    </div>
                </div>
                </div>
                <div class="col-lg-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                    <h4 class="card-title">Bar chart</h4>
                    <canvas id="barChart"></canvas>
                    </div>
                </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                    <h4 class="card-title">Area chart</h4>
                    <canvas id="areaChart"></canvas>
                    </div>
                </div>
                </div>
                <div class="col-lg-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                    <h4 class="card-title">Doughnut chart</h4>
                    <canvas id="doughnutChart"></canvas>
                    </div>
                </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 grid-margin grid-margin-lg-0 stretch-card">
                <div class="card">
                    <div class="card-body">
                    <h4 class="card-title">Pie chart</h4>
                    <canvas id="pieChart"></canvas>
                    </div>
                </div>
                </div>
                <div class="col-lg-6 grid-margin grid-margin-lg-0 stretch-card">
                <div class="card">
                    <div class="card-body">
                    <h4 class="card-title">Scatter chart</h4>
                    <canvas id="scatterChart"></canvas>
                    </div>
                </div>
                </div>
            </div>
        </div>

        <footer class="footer">
        <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2018 <a href="https://www.urbanui.com/" target="_blank">Urbanui</a>. All rights reserved.</span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made with <i class="mdi mdi-heart text-danger"></i></span>
        </div>
        </footer>
  </div>
@endsection


@section('scripts')
    <script src="{{ URL::asset('js/chart.js') }}"></script>
@endsection

