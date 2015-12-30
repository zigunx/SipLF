@extends('backend/templates/index')
@section('js')
<script src='{{asset('assets/js/controller/admin-jurusan.js')}}'></script>
@stop
@section('content')
<div class="main-content" ng-controller="jurusan">
    <!-- end: SPANEL CONFIGURATION MODAL FORM -->
    <div class="container">
        <!-- start: PAGE HEADER -->
        <div class="row">
            <div class="col-sm-12">
{!! Breadcrumbs::render('jurusan'); !!}
                <div class="page-header">
                    <h1>
                        {{$title}} <br />
                        <small>Menambahkan jurusan di situs website SiP LF Wonosobo</small>
                    </h1>
                </div>
                <!-- end: PAGE TITLE & BREADCRUMB -->
            </div>
        </div>
        <!-- end: PAGE HEADER -->
        <!-- start: PAGE CONTENT -->
        <div class="row">
            <div class="col-md-12">
                <!-- start: BASIC TABLE PANEL -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                    </div>
                    <div class="panel-body">
                        <alert ng-repeat="alert in alerts" type="<%alert.type%>" close="closeAlert($index)"><%alert.msg%></alert>
                        <a class="btn btn-green add-row" href="{{route('admin.jurusan.create')}}">
                            Tambah jurusan <i class="fa fa-plus"></i>
                        </a>
                        <a class="btn btn-green add-row" href="{{route('admin.jurusan.{id}.siswa.create', 1)}}">
                            Tambah Mahasiswa <i class="fa fa-user"></i>
                        </a>
                        <div class="pull-right col-sm-5">
                            <input class="form-control col-md-12" ng-model="query"  placeholder="Search">
                        </div>
                        <table id="sample-table-1" class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Nama jurusan</th>
                                    <th>Tahun Ajaran</th>
                                    <th class="hidden-xs center">Aksi Data</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat="status in data| filter:paginate">
                                    <td><% status['nama_jurusan'] %></td>
                                    <td><% status['tahun_ajaran'] %></td>
                                    <td class="center">
                                        <div class="visible-md visible-lg hidden-sm hidden-xs">
                                            <a data-original-title="Siswa" data-placement="top" class="btn btn-xs btn-success tooltips" href="{{url('admin/jurusan')}}/<% status['id_jurusan']%>/siswa"><i class="fa fa-user"></i> Lihat Data</a>
                                            <a data-original-title="Edit" data-placement="top" class="btn btn-xs btn-teal tooltips" href="{{url('admin/jurusan')}}/<% status['id_jurusan']%>/edit"><i class="fa fa-edit"></i></a>
                                            <a data-original-title="Remove" data-placement="top" class="btn btn-xs btn-bricky tooltips" href="#" ng-click="delete(status['id_jurusan'])"><i class="fa fa-times fa fa-white"></i></a>
                                        </div>
                                        <div class="visible-xs visible-sm hidden-md hidden-lg">
                                            <div class="btn-group">
                                                <a href="#" data-toggle="dropdown" class="btn btn-primary dropdown-toggle btn-sm">
                                                    <i class="fa fa-cog"></i> <span class="caret"></span>
                                                </a>
                                                <ul class="dropdown-menu pull-right" role="menu">
                                                    <li role="presentation">
                                                        <a href="{{url('admin/siswa')}}/<% status['id_data']%>/edit" tabindex="-1" role="menuitem">
                                                            <i class="fa fa-user"></i> Lihat Siswa
                                                        </a>
                                                    </li>
                                                    <li role="presentation">
                                                        <a href="{{url('admin/jurusan')}}/<% status['id_data']%>/edit" tabindex="-1" role="menuitem">
                                                            <i class="fa fa-edit"></i> Edit
                                                        </a>
                                                    </li>
                                                    <li role="presentation">
                                                        <a href="#" tabindex="-1" role="menuitem" ng-click="delete(status['id_jurusan'])">
                                                            <i class="fa fa-times"></i> Remove 
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <pagination total-items="totalItems" ng-model="currentPage"
                                    max-size="10" boundary-links="true"
                                    items-per-page="numPerPage" class="pagination-sm">
                        </pagination>
                    </div>
                </div>
            </div>
        </div>
        <!-- end: BASIC TABLE PANEL -->
    </div>
    @stop