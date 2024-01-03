$(document).ready(function () {
    $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
        }
    });

    $("#event-start-date").datepicker();

    $("#event-start-time").timepicker({
      timeFormat: 'HH:mm'
    });
  
    $("#event-end-date").datepicker();
    
    $("#event-end-time").timepicker({
      timeFormat: 'HH:mm'
    });
  
    loadCalendar();
});

$('#event-room').select2({
    dropdownParent: $('#modalPenjadwalan'),
    placeholder: 'Pilih Ruangan',
    // allowClear: true,
    ajax: {
        type: 'GET',
        url: '/selectRoom',
        data: function(params) {
            let query = {
                search: params.term,
                page: params.page || 1
            }
  
            return query;
        },
        delay: 500
    }
  });

const clearFormPenjadwalan = () => {
    $('#formAddPenjadwalan').trigger('reset');
    $('#idPenjadwalan').val('');
}

const showFormPenjadwalan = () => {
    clearFormPenjadwalan();
    $('#modalPenjadwalan').modal('show');
}

const hideModalPenjadwalan = () => {
    $('#modalPenjadwalan').modal('hide');
}

const clearPreviewPenjadwalan = () => {
    $('#preview-event-header').removeClass().addClass('modal-header');
    $('#preview-event-title').text('');
    $('#preview-event-start').text('');
    $('#preview-event-end').text('');
    $('#preview-event-description').text('');
    $('#idPenjadwalanPreview').val('');
} 

const showPreviewPenjadwalan = (id_penjadwalan) => {
    $.ajax({
        type: 'GET',
        url: '/gtPenjadwalan',
        data: {
            id: id_penjadwalan
        },
        dataType: 'JSON',
        async: false,
        cache: false,
        success: function (response) {
            clearPreviewPenjadwalan();

            $('#modalPreviewPenjadwalan').modal('show');

            $('#idPenjadwalanPreview').val(response.id);
            $('#preview-event-header').addClass(response.warna);
            $('#preview-event-title').text(response.title);
            $('#preview-event-start').text(response.convert_start);
            $('#preview-event-end').text(response.convert_end);
            $('#preview-event-description').text(response.description);
            $('#preview-event-room').text(response.ruangan);
        },
    });
}

  
const loadCalendar = () => {
  
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        timeZone: 'local',
        initialView : 'dayGridMonth',
        themeSystem: 'bootstrap',
        headerToolbar: {
            left: 'title prev,next',
            center: null,
            right: 'today dayGridMonth,timeGridWeek,timeGridDay,listWeek'
        },
        events: '/gtCalendarPenjadwalan',
        height: 800,
        eventRender: [], 
        contentHeight: 780,
        aspectRatio: 3,
        editable: true,
        droppable: true,
        views: {
            dayGridMonth: {
                dayMaxEventRows: 2
            }
        },
        selectable: true,
        select: function (res) {
            // console.log(res);
            $('#modalPenjadwalan').modal('show'); 
            $('#event-start-date').val(res.startStr);
            $('#event-end-date').val(res.startStr);
            $('#event-start-time').val('00:00');
            $('#event-end-time').val('00:00');
        },
        eventDrop: function (res) {
            // console.log(res);
            Swal.fire({
                title: 'Apakah Anda Yakin ?',
                text: "Anda akan memindahkan jadwal",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "/processJadwal",
                        type : "POST",
                        data :{
                            id: res.event._def.publicId,
                            days: res.delta.days,
                            eventtype: 'drop'
                        },
                        dataType : "json",
                        success: function(response) {
                            Swal.fire({
                                icon: 'success',
                                title: response.message,
                                timer: 2000,
                                showCancelButton: false,
                                showConfirmButton: false,
                                allowOutsideClick: false
                            });
                        },
                        error: function (error) {
                            Swal.fire({
                                title: 'Terjadi kesalahan saat menyimpan data!',
                                text: error.responseText, 
                                icon: 'error',
                                showConfirmButton: false
                            });
                        }
                    });
                } else {
                    loadCalendar();
                }
            });
        },
        eventClick: function (res) {
            showPreviewPenjadwalan(res.event._def.publicId);
        }
    });
    calendar.render();
}

const deleteJadwal = () => {
    $('#modalPreviewPenjadwalan').modal('hide');
    Swal.fire({
        title: 'Apakah Anda Yakin ?',
        text: "Anda akan menghapus jadwal",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: "/deleteJadwal",
                type : "POST",
                data :{
                    id: $('#idPenjadwalanPreview').val()
                },
                dataType : "json",
                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: response.message,
                        timer: 2000,
                        showCancelButton: false,
                        showConfirmButton: false,
                        allowOutsideClick: false
                    });
                    loadCalendar();
                },
                error: function (error) {
                    Swal.fire({
                        title: 'Terjadi kesalahan saat menyimpan data!',
                        text: error.responseText, 
                        icon: 'error',
                        showConfirmButton: false
                    });
                }
            });
        } else {
            $('#modalPreviewPenjadwalan').modal('show');
        }
    });
}

const editJadwal = () => {
    $.ajax({
        type: 'GET',
        url: '/gtPenjadwalan',
        data: {
            id: $('#idPenjadwalanPreview').val()
        },
        dataType: 'JSON',
        async: false,
        cache: false,
        success: function (response) {
            $('#modalPreviewPenjadwalan').modal('hide');
            showFormPenjadwalan();

            $('#idPenjadwalan').val($('#idPenjadwalanPreview').val());

            $('#event-title').val(response.title);
            $('#event-description').val(response.description);

            $('#event-start-date').val(response.start_date);
            $('#event-start-time').val(response.start_time);
            $('#event-end-date').val(response.end_date);
            $('#event-end-time').val(response.end_time);

            $("#event-room").val(response.id_room).trigger("change");
            
            $('input.warna-checkbox[value="'+response.warna+'"]').prop('checked', true);
        
        },
    });
}

$('#formAddPenjadwalan').submit(function(event) {
    $('#btnAddEvent').prop('disabled', true);
    $('#btnAddEvent').html('...Menyimpan');
    event.preventDefault();
    formData = new FormData($(this)[0]);
    $.ajax({
        url: "/processJadwal",
        type: "post",
        data: formData,
        async: false,
        cache: false,
        dataType: "json",
        contentType: false,
        processData: false,
        beforeSend: function () {
            Swal.showLoading();
        },
        complete: function () {
            Swal.hideLoading();
        },
        success: function (response) {
            Swal.fire({
                icon: 'success',
                title: response.message,
                timer: 2000,
                showCancelButton: false,
                showConfirmButton: false,
                allowOutsideClick: false,
                onAfterClose: () => {
                    $('#modalPenjadwalan').modal('hide');
                    $('#btnAddEvent').prop('disabled', false);
                    $('#btnAddEvent').html('<em class="icon ni ni-save"></em><span>Simpan Data</span>');
                }
            });
            loadCalendar();
        },
        error: function (error) {
            Swal.fire({
                title: 'Terjadi kesalahan saat menyimpan data!',
                text: error.responseText, 
                icon: 'error',
                showConfirmButton: false
            });
        }
  });
  return false;
});