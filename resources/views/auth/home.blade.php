@extends('layouts.auth.main')

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
                            <div class="nk-block-head-content">
                                <a href="#" onClick="showFormPenjadwalan()" class="btn btn-primary"><em class="icon ni ni-plus"></em><span>Tambah Penjadwalan</span></a>
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
    <div class="modal fade" id="modalPenjadwalan">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Penjadwalan</h5>
                    <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <em class="icon ni ni-cross"></em>
                    </a>
                </div>
                <div class="modal-body">
                    <form action="#" id="formAddPenjadwalan" method="POST" class="form-validate is-alter">
                        <input type="hidden" id="idPenjadwalan" name="id">
                        <div class="row gx-4 gy-3">
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label" for="event-title">Judul</label>
                                    <div class="form-control-wrap">
                                        <input type="text" name="title" class="form-control" id="event-title" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="form-label">Tanggal & Jam Mulai</label>
                                    <div class="row gx-2">
                                        <div class="w-55">
                                            <div class="form-control-wrap">
                                                <div class="form-icon form-icon-left">
                                                    <em class="icon ni ni-calendar"></em>
                                                </div>
                                                <input type="text" name="start_date" id="event-start-date" class="form-control date-picker" data-date-format="yyyy-mm-dd" required readonly>
                                            </div>
                                        </div>
                                        <div class="w-45">
                                            <div class="form-control-wrap">
                                                <div class="form-icon form-icon-left">
                                                    <em class="icon ni ni-clock"></em>
                                                </div>
                                                <input type="text" name="start_time" id="event-start-time" data-time-format="HH:mm:ss" class="form-control time-picker" required readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="form-label">Tanggal & Jam Selesai</label>
                                    <div class="row gx-2">
                                        <div class="w-55">
                                            <div class="form-control-wrap">
                                                <div class="form-icon form-icon-left">
                                                    <em class="icon ni ni-calendar"></em>
                                                </div>
                                                <input type="text" name="end_date" id="event-end-date" class="form-control date-picker" data-date-format="yyyy-mm-dd" required readonly>
                                            </div>
                                        </div>
                                        <div class="w-45">
                                            <div class="form-control-wrap">
                                                <div class="form-icon form-icon-left">
                                                    <em class="icon ni ni-clock"></em>
                                                </div>
                                                <input type="text" name="end_time" id="event-end-time" data-time-format="HH:mm:ss" class="form-control time-picker" required readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label" for="event-description">Deskripsi</label>
                                    <div class="form-control-wrap">
                                        <textarea class="form-control" name="description" id="event-description" required></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label" for="event-room">Ruangan</label>
                                    <div class="form-control-wrap">
                                        <select name="ruangan" id="event-room" class="form-control" required></select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label" for="event-room">Warna Tampilan</label>
                                    <ul class="custom-control-group g-2 align-center flex-wrap mt-0">
                                        <li>
                                            <div class="custom-control custom-radio custom-control-sm">
                                                <input type="radio" class="custom-control-input warna-checkbox" id="radioWarnaUngu" name="warna_tampilan" value="fc-event-primary-dim" required>
                                                <label for="radioWarnaUngu" class="custom-control-label"><span class="badge badge-dim rounded-pill bg-primary">Ungu</span></label>
                                            </div>
                                        </li>
                                        |
                                        <li>
                                            <div class="custom-control custom-radio custom-control-sm">
                                                <input type="radio" class="custom-control-input warna-checkbox" id="radioWarnaHijau" name="warna_tampilan" value="fc-event-success-dim">
                                                <label for="radioWarnaHijau" class="custom-control-label"><span class="badge badge-dim rounded-pill bg-success">Hijau</span></label>
                                            </div>
                                        </li>
                                        |
                                        <li>
                                            <div class="custom-control custom-radio custom-control-sm">
                                                <input type="radio" class="custom-control-input warna-checkbox" id="radioWarnaJingga" name="warna_tampilan" value="fc-event-warning-dim">
                                                <label for="radioWarnaJingga" class="custom-control-label"><span class="badge badge-dim rounded-pill bg-warning">Jingga</span></label>
                                            </div>
                                        </li>
                                        |
                                        <li>
                                            <div class="custom-control custom-radio custom-control-sm">
                                                <input type="radio" class="custom-control-input warna-checkbox" id="radioWarnaMerah" name="warna_tampilan" value="fc-event-danger-dim">
                                                <label for="radioWarnaMerah" class="custom-control-label"><span class="badge badge-dim rounded-pill bg-danger">Merah</span></label>
                                            </div>
                                        </li>
                                        |
                                        <li>
                                            <div class="custom-control custom-radio custom-control-sm">
                                                <input type="radio" class="custom-control-input warna-checkbox" id="radioWarnaBiru" name="warna_tampilan" value="fc-event-info-dim">
                                                <label for="radioWarnaBiru" class="custom-control-label"><span class="badge badge-dim rounded-pill bg-info">Biru</span></label>
                                            </div>
                                        </li>
                                        |
                                        <li>
                                            <div class="custom-control custom-radio custom-control-sm">
                                                <input type="radio" class="custom-control-input warna-checkbox" id="radioWarnaAbu" name="warna_tampilan" value="fc-event-dark-dim">
                                                <label for="radioWarnaAbu" class="custom-control-label"><span class="badge badge-dim rounded-pill bg-dark">Abu-Abu</span></label>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-12"><hr></div>
                            <div class="col-12">
                                <ul class="d-flex justify-content-between gx-4 mt-1">
                                    <li>
                                        <button id="btnAddEvent" type="submit" class="btn btn-primary"><em class="icon ni ni-save"></em><span>Simpan Data</span></button>
                                    </li>
                                    <li>
                                        <a href="#" data-bs-dismiss="modal" class="btn btn-danger btn-dim">Tutup Form</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Modal Add Event -->

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
                    <ul class="d-flex justify-content-between gx-4 mt-3">
                        <li>
                            <button type="button" onclick="editJadwal()" class="btn btn-primary">Ubah Jadwal</button>
                        </li>
                        <li>
                            <button type="button" onclick="deleteJadwal()" class="btn btn-danger btn-dim">Hapus Jadwal</button>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End Modal Preview Penjadwalan -->

@endsection