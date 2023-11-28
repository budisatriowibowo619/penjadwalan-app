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

  var options = { 
      complete: function(response) 
      {    
        if($.isEmptyObject(response.responseJSON.error)){
          $('#event-title').val('');
          $('#event-description').val('');
        }else{
          printErrorMsg(response.responseJSON.error);
        }
      },
      error:function(response){
        console.log(response);
      }
  };
  $('#btnAddEvent').click(function(e) {
      e.preventDefault(); 
      $(this).parents("form").ajaxSubmit(options);
  });
  function printErrorMsg(msg) {
      $('.error-msg').find('ul').html('');
      $('.error-msg').css('display','block');
      $.each( msg, function( key, value ) {
          $(".error-msg").find("ul").append('<li>'+value+'</li>');
      });
  }

});
document.addEventListener('DOMContentLoaded', function() {
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
          // events: [
          //   {
          //     title: 'Event1',
          //     start: '2023-11-18'
          //   },
          //   {
          //     title: 'Event2',
          //     start: '2023-11-29'
          //   },
          //   {
          //     title  : 'event4',
          //     start  : '2023-11-05',
          //     end    : '2023-11-07'
          //   },
          //   {
          //     title  : 'event5',
          //     start  : '2023-11-09T12:30:00',
          //     allDay : false // will make the time show
          //   }
          //   // etc...
          // ],
        height: 800,
        contentHeight: 780,
        aspectRatio: 3,
        editable: true,
        droppable: true,
        views: {
          dayGridMonth: {
            dayMaxEventRows: 2
          }
        },
    });
    calendar.render();
});
