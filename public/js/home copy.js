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

const clearFormPenjadwalan = () => {
    $('#formAddPenjadwalan').trigger('reset');
}

const showFormPenjadwalan = () => {
    clearFormPenjadwalan();
    $('#modalPenjadwalan').modal('show');
}

$('#event-room').select2({
    dropdownParent: $('#modalPenjadwalan'),
    placeholder: 'Pilih Ruangan',
    allowClear: true,
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
            $('#modalPenjadwalan').modal('show'); 
            $('#event-start-date').val(res.startStr);
            $('#event-end-date').val(res.endStr);
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
                            days: res.delta.days
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
                }
            });
        },
        eventClick: function (res) {
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
                            id: res.event._def.publicId
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
                }
            });
        }
    });
    calendar.render();
}

$('#formAddPenjadwalan').submit(function(event) {
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
                onAfterClose: () => $('#modalPenjadwalan').modal('hide')
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