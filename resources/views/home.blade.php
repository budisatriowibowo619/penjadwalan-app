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
                                <h3 class="nk-block-title page-title">Kalender Penjadwalan</h3>
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

    <!-- Modal Preview Penjadwalan -->
    <div class="modal fade" id="modalPreviewPenjadwalan">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div id="preview-event-header" class="modal-header">
                    <h5 id="preview-event-title" class="modal-title">Placeholder Title</h5>
                    <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <em class="icon ni ni-cross"></em>
                    </a>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="idPenjadwalanPreview">
                    <div class="row gy-3 py-1">
                        <div class="col-sm-6">
                            <h6 class="overline-title">Tanggal Mulai</h6>
                            <p id="preview-event-start"></p>
                        </div>
                        <div class="col-sm-6" id="preview-event-end-check">
                            <h6 class="overline-title">Tanggal Selesai</h6>
                            <p id="preview-event-end"></p>
                        </div>
                        <div class="col-sm-12" id="preview-event-description-check">
                            <h6 class="overline-title">Deskripsi</h6>
                            <p id="preview-event-description" style="text-align: justify;"></p>
                        </div>
                        <div class="col-sm-12" id="preview-event-room-check">
                            <h6 class="overline-title">Ruangan</h6>
                            <p id="preview-event-room"></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Modal Preview Penjadwalan -->

@endsection