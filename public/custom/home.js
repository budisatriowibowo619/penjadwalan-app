$(function () {

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
const loadCalendar = () => {

    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        timeZone: 'UTC',
        initialView : 'dayGridMonth',
        themeSystem: 'bootstrap',
        headerToolbar: {
          left: 'title prev,next',
          center: null,
          right: 'today dayGridMonth,timeGridWeek,timeGridDay,listWeek'
        },
        events: '/ajax_gt_jadwal',
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
          $('#addEventPopup').modal('show'); 
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
                  url: "/prosesJadwal",
                  type : "POST",
                  data :{
                      id: res.event._def.publicId,
                      days: res.delta.days
                  },
                  dataType : "json",
                  success: function(res) {
                    if (res.status == true) {
                      Swal.fire({
                        title: "Jadwal berhasil di ubah",
                        showCancelButton: false,
                        showConfirmButton: false,
                        timer: 2000,
                        icon: 'success',
                        allowOutsideClick: false,
                      });
                    } else {
                      Swal.fire(
                        'Oops !',
                        'Terjadi Kesalahan',
                        'danger'
                      );
                    }
                  },
                  error: function () {
                    Swal.fire(
                        'Oops !',
                        "Terjadi Kesalahan Saat Menyimpan Data!",
                        'warning'
                    );
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
                  url: "/prosesHapusJadwal",
                  type : "POST",
                  data :{
                      id: res.event._def.publicId
                  },
                  dataType : "json",
                  success: function(res) {
                    if (res.status == true) {
                      Swal.fire({
                        title: "Jadwal berhasil di hapus",
                        showCancelButton: false,
                        showConfirmButton: false,
                        timer: 2000,
                        icon: 'success',
                        allowOutsideClick: false,
                      });
                      loadCalendar();
                    } else {
                      Swal.fire(
                        'Oops !',
                        'Terjadi Kesalahan',
                        'danger'
                      );
                    }
                  },
                  error: function () {
                    Swal.fire(
                        'Oops !',
                        "Terjadi Kesalahan Saat Menghapus Data!",
                        'warning'
                    );
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
    url: "/prosesJadwal",
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
    success: function (res) {
      if (res.status == true) {
        Swal.fire({
          title: 'Jadwal berhasil ditambahkan',
          showCancelButton: false,
          showConfirmButton: false,
          timer: 2000,
          icon: 'success',
          allowOutsideClick: false,
          onAfterClose: () => $('#addEventPopup').modal('hide')
        });
        loadCalendar();
      } else {
        Swal.fire(
          'Oops !',
          res.message,
          'error'
        );
      }
    },
    error: function () {
      Swal.fire(
        'Oops !',
        "Terjadi Kesalahan Saat Menyimpan Data!",
        'warning'
      );
    }
  });
  return false;
});