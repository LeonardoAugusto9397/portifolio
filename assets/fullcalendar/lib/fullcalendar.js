document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
      locale: 'pt-br',
      headerToolbar: {
        left: 'title',
        center: 'prev,next',
        right: 'today,dayGridMonth,listYear'
      },
      initialView: 'dayGridMonth',
      events: [
        {
          title: 'Reunião',
          start: '2021-05-10T14:00:00',
          constraint: 'businessHours'
        },
        {
          title: 'Instalação',
          start: '2021-05-04',
          end: '2021-05-06'
        }
      ]
    });
    calendar.render();
});