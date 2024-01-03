$(document).ready(function () {
    $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
        }
    });

    loadCalendar();
});

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
        eventClick: function (res) {
            showPreviewPenjadwalan(res.event._def.publicId);
        }
    });
    calendar.render();
}