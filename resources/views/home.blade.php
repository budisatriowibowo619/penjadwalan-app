@extends('layouts.main')

@section('container')

    <!-- content @s -->
    <div class="nk-content nk-content-fluid">
        <div class="container-xl wide-xl">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title">Calendar</h3>
                            </div><!-- .nk-block-head-content -->
                            <div class="nk-block-head-content">
                                <a class="btn btn-primary" data-bs-toggle="modal" href="#addEventPopup"><em class="icon ni ni-plus"></em><span>Add Event</span></a>
                            </div><!-- .nk-block-head-content -->
                        </div><!-- .nk-block-between -->
                    </div><!-- .nk-block-head -->
                    <div class="nk-block">
                        <div class="card card-bordered">
                            <div class="card-inner">
                                <div id="calendar" class="nk-calendar"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- content @e -->

    <!-- Modal Add Event -->
    <!-- End Modal Add Event -->

@endsection