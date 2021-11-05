var url_atual = window.location.href;
document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
    eventDisplay: 'block',
    eventSources: [
      {
        url: 'http://192.168.100.163:8000/admin/getCalendario',
        method: 'GET',
        success: function(data) {
          return data.eventArray;
        },
        failure: function(data){
          console.log(data);
        },
      }
    ],
    lang: 'pt-br',
    locale: 'pt-br',
    themeSystem: 'bootstrap',
    themeColor: 'blue',
    selectable: true,
    dayMaxEventRows: true,
    views:{
      resourceTimelineWeek: {
        slotDuration: { days: 1 }
      }
  },

    headerToolbar: {
        left: 'prev,next',
        center: 'title',
        right: 'today dayGridMonth,dayGridWeek,timeGridDay'
    },
    businessHours: {
      daysOfWeek: [ 1, 2, 3, 4, 5], // Monday, Tuesday, Wednesday
      startTime: '08:00', // 8am
      endTime: '17:30' // 6pm
    },
    businessHours: {
      daysOfWeek: [6], // sabado
      startTime: '08:00', // 10am
      endTime: '12:00' // 4pm
    },

    eventClick:  function(event, jsEvent, view) {
      $('#details').modal('show');

    $('#details').find('#nomecliente').text(event.event.id)
  },
  

    eventLimit: true, // for all non-TimeGrid views
  views: {
    dayGridMonth: {
      eventLimit: 5, // adjust to 6 only for timeGridWeek/timeGridDay
      dayMaxEventRows: 5
    }
  },
    
  
});
    calendar.render();
});


console.log(url_atual+'/getCalendario')
