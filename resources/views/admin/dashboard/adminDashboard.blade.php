@extends('admin.include.layout')

@section('after_styles')

@endsection

@php
    $appo=App\Helpers\UserHelper::totalAppoinment();
    $pend=App\Helpers\UserHelper::pendingAppoinment();
    $phy=App\Helpers\UserHelper::totalPhysicalAppoinment();
    $phyappo=App\Helpers\UserHelper::pendingPhysicalAppoinment();
    $vir=App\Helpers\UserHelper::totalVirtualAppoinment();
    $virappo=App\Helpers\UserHelper::pendingVirtualAppoinment();
   $user=App\Helpers\UserHelper::user();
@endphp

@section('body')

    <div class="row">
        <div class="col-12 grid-margin">
            <div class="row">
                <div class="col-md-3 grid-margin">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex flex-row align-items-top">
                                <i class="icon-pin text-facebook icon-md"></i>
                                <div class="ml-3">
                                    <h6 class="text-facebook text-md">{{$appo}}</h6>
                                    <p class="mt-2 text-muted card-text"> <a href="{{url('admin/inquiry-list')}}">Total appointment</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 grid-margin">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex flex-row align-items-top">
                                <i class="icon-calendar text-facebook icon-md"></i>
                                <div class="ml-3">
                                    <h6 class="text-facebook">{{$phy}}</h6>
                                    <p class="mt-2 text-muted card-text"><a href="{{url('admin/inquiry-list')}}">Physical appointment</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 grid-margin">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex flex-row align-items-top">
                                <i class="icon-layers text-facebook icon-md"></i>
                                <div class="ml-3">
                                    <h6 class="text-facebook">{{$vir}}</h6>
                                    <p class="mt-2 text-muted card-text"><a href="{{url('admin/inquiry-list')}}">Virtual appointment</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 grid-margin">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex flex-row align-items-top">
                                <i class="icon-refresh text-facebook icon-md"></i>
                                <div class="ml-3">
                                    <h6 class="text-facebook">{{$user}}</h6>
                                    <p class="mt-2 text-muted card-text"><a href="{{url('admin/user-list')}}">Users</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 grid-margin">
            <div class="row">
                <div class="col-md-3 grid-margin">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex flex-row align-items-top">
                                <i class="icon-pin text-facebook icon-md"></i>
                                <div class="ml-3">
                                    <h6 class="text-facebook text-md">{{$pend}}</h6>
                                    <p class="mt-2 text-muted card-text">Pending appointment</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 grid-margin">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex flex-row align-items-top">
                                <i class="icon-calendar text-facebook icon-md"></i>
                                <div class="ml-3">
                                    <h6 class="text-facebook">{{$phyappo}}</h6>
                                    <p class="mt-2 text-muted card-text">Pending Physical appointment</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 grid-margin">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex flex-row align-items-top">
                                <i class="icon-layers text-facebook icon-md"></i>
                                <div class="ml-3">
                                    <h6 class="text-facebook">{{$virappo}}</h6>
                                    <p class="mt-2 text-muted card-text">Pending Virtual appointment</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--<div class="col-md-3 grid-margin">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex flex-row align-items-top">
                                <i class="icon-refresh text-facebook icon-md"></i>
                                <div class="ml-3">
                                    <h6 class="text-facebook">90</h6>
                                    <p class="mt-2 text-muted card-text">Users</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>-->
            </div>
        </div>
    </div>

    <!--old Widgets -->
    <!--<div class="row">
        <div class="col-12 grid-margin">
            <div class="card card-statistics">
                <div class="card-body p-0">
                    <div class="row">
                        <div class="col-md-6 col-lg-3">
                            <div class="d-flex justify-content-between border-right card-statistics-item">
                                <div>
                                    <h1>{{$appo}}</h1>
                                    <p class="text-muted mb-0">Total Appointment</p>
                                </div>
                                <i class="icon-pin text-primary icon-lg"></i>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <div class="d-flex justify-content-between border-right card-statistics-item">
                                <div>
                                    <h1>{{$phy}}</h1>
                                    <p class="text-muted mb-0">Physical Appointment</p>
                                </div>
                                <i class="icon-calendar text-primary icon-lg"></i>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <div class="d-flex justify-content-between border-right card-statistics-item">
                                <div>
                                    <h1>{{$vir}}</h1>
                                    <p class="text-muted mb-0">Virtual Appointment</p>
                                </div>
                                <i class="icon-layers text-primary icon-lg"></i>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>-->
    <!-- /Widget -->

    <!--<div class="row">
        <div class="col-12 grid-margin">
            <div class="card card-statistics">
                <div class="card-body p-0">
                    <div class="row">
                        <div class="col-md-6 col-lg-3">
                            <div class="d-flex justify-content-between border-right card-statistics-item">
                                <div>
                                    <h1>{{$pend}}</h1>
                                    <p class="text-muted mb-0">Pending Appointment</p>
                                </div>
                                <i class="icon-pin text-primary icon-lg"></i>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <div class="d-flex justify-content-between border-right card-statistics-item">
                                <div>
                                    <h1>{{$phyappo}}</h1>
                                    <p class="text-muted mb-0">Pending Physical Appointment</p>
                                </div>
                                <i class="icon-calendar text-primary icon-lg"></i>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <div class="d-flex justify-content-between border-right card-statistics-item">
                                <div>
                                    <h1>{{$virappo}}</h1>
                                    <p class="text-muted mb-0">Pending Virtual Appointment</p>
                                </div>
                                <i class="icon-layers text-primary icon-lg"></i>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>-->


@endsection


@section('after_scripts')


@endsection




