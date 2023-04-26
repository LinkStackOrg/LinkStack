/* ====== Index ======

1. CALENDAR JS

====== End ======*/

document.addEventListener('DOMContentLoaded', function() {
  var calendarEl = document.getElementById('calendar');
  var year = new Date().getFullYear()
  var month = new Date().getMonth() + 1
  function n(n){
    return n > 9 ? "" + n: "0" + n;
  }
  var month = n(month)

  var calendar = new FullCalendar.Calendar(calendarEl, {
    plugins: [ 'dayGrid' ],
    defaultView: 'dayGridMonth',

    eventRender: function(info) {
      var ntoday = moment().format('YYYYMMDD');
      var eventStart = moment( info.event.start ).format('YYYYMMDD');
      info.el.setAttribute("title", info.event.extendedProps.description);
      info.el.setAttribute("data-toggle", "tooltip");
      if (eventStart < ntoday){
        info.el.classList.add("fc-past-event");
      } else if (eventStart == ntoday){
        info.el.classList.add("fc-current-event");
      } else {
        info.el.classList.add("fc-future-event");
      }
    },

    events: [
      {
        title: 'All Day Event',
        description: 'description for All Day Event',
        start: year+'-'+month+'-01'
      },
      {
        title: 'Short Event',
        description: 'description for Short Event',
        start: year+'-'+month+'-03'
      },
      {
        title: 'Client Introduce',
        description: 'description for Client Introduce',
        start: year+'-'+month+'-05'
      },
      {
        title: 'Long Event',
        description: 'description for Long Event',
        start: year+'-'+month+'-07',
        end: year+'-'+month+'-10'
      },
      {
        groupId: '999',
        title: 'Repeating Event',
        description: 'description for Repeating Event',
        start: year+'-'+month+'-09T16:00:00'
      },
      {
        groupId: '999',
        title: 'Repeating Event',
        description: 'description for Repeating Event',
        start: year+'-'+month+'-16T16:00:00',
        end: year+'-'+month+'-16T16:00:00'
      },
      {
        title: 'Conference',
        description: 'description for Conference',
        start: year+'-'+month+'-11',
        end: year+'-'+month+'-13'
      },
      {
        title: 'Meeting',
        description: 'description for Meeting',
        start: year+'-'+month+'-12T10:30:00',
        end: year+'-'+month+'-12T12:30:00'
      },
      {
        title: 'Lunch',
        description: 'description for Lunch',
        start: year+'-'+month+'-12T12:00:00',
        end: year+'-'+month+'-12T12:00:00'
      },
      {
        title: 'Meeting',
        description: 'description for Meeting',
        start: year+'-'+month+'-12T14:30:00',
        end: year+'-'+month+'-12T14:30:00'
      },
      {
        title: '+4 more',
        description: 'description for More Event',
        start: year+'-'+month+'-12T17:00:00',
        end: year+'-'+month+'-12T17:00:00'
      },
      {
        title: 'Birthday Party',
        description: 'description for Birthday Party',
        start: year+'-'+month+'-13T24:00:00',
        end: year+'-'+month+'-13T24:00:00'
      },
      {
        groupId: '999',
        title: 'Repeating Event',
        description: 'description for Repeating Event',
        start: year+'-'+month+'-22T16:00:00'
      },
      {
        title: 'Memory Ceremony',
        description: 'description for Memory Ceremony',
        start: year+'-'+month+'-18T09:30:00'
      },
      {
        title: 'Long Event',
        description: 'description for Long Event',
        start: year+'-'+month+'-20',
        end: year+'-'+month+'-23'
      },
      {
        title: 'Conference',
        description: 'description for Conference',
        start: year+'-'+month+'-24',
        end: year+'-'+month+'-27'
      },
      {
        title: 'Meeting',
        description: 'description for Meeting',
        start: year+'-'+month+'-26T10:30:00',
        end: year+'-'+month+'-26T12:30:00'
      },
      {
        title: 'Lunch',
        description: 'description for Lunch',
        start: year+'-'+month+'-26T12:00:00',
        end: year+'-'+month+'-26T12:00:00'
      },
      {
        title: 'Meeting',
        description: 'description for Meeting',
        start: year+'-'+month+'-26T14:30:00',
        end: year+'-'+month+'-26T14:30:00'
      },
      {
        title: 'Click for Google',
        description: 'description for Click for Google',
        url: 'http://google.com/',
        start: year+'-'+month+'-28',
        end: year+'-'+month+'-28'
      },
      {
        title: 'Lunch',
        description: 'description for Lunch',
        start: year+'-'+month+'-30T12:00:00',
        end: year+'-'+month+'-31T12:00:00'
      },
      {
        title: 'Meeting',
        description: 'description for Meeting',
        start: year+'-'+month+'-31T14:30:00',
        end: year+'-'+month+'-31T14:30:00'
      }
    ]
  });

  calendar.render();

});
