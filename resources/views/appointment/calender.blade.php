@extends('user.base')
@section('action-content')
    <!-- End Navbar -->
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
              <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                <h6 class="text-white text-capitalize ps-3">Appointments</h6>
              </div>
            </div>
            <div class="card-body px-0 pb-2">
              <div class="table-responsive p-0">



                <div id="calendar"></div>

              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Start Head -->
        @include('layouts.footer')
	    <!-- End Head -->




    </div>

@endsection

@push('pageJs')
<script src="{{asset('assets/jquery-ui/jquery-ui.min.js')}}"></script>
<script src="{{asset('assets/moment/moment.min.js')}}"></script>
<script src="{{asset('assets/fullcalendar/main.js')}}"></script>

<script>
    $(function () {


      /* initialize the calendar
       -----------------------------------------------------------------*/
      //Date for the calendar events (dummy data)
      var date = new Date()
      var d    = date.getDate(),
          m    = date.getMonth(),
          y    = date.getFullYear()

      var Calendar = FullCalendar.Calendar;



      var calendarEl = document.getElementById('calendar');

      // initialize the external events
      // -----------------------------------------------------------------


      var calendar = new Calendar(calendarEl, {
        headerToolbar: {
          left  : 'prev,next today',
          center: 'title',
          right : 'dayGridMonth,timeGridWeek,timeGridDay'
        },
        themeSystem: 'bootstrap',
        //Random default events
        events: [
            @php
             foreach($appointments as $pp)
                {
                    @endphp
                    {
          title          : '@php echo $pp->location; @endphp',
          @php
          if(date("Y-m") == date("Y-m",strtotime($pp->actual_date))){
            @endphp
            start          : new Date(y, m, @php echo date("d",strtotime($pp->actual_date)) @endphp, @php echo date("H",strtotime($pp->actual_date)) @endphp, @php echo date("i",strtotime($pp->actual_date)) @endphp),
            @php
          }else{
            @endphp
            start          : new Date(y, @php echo date("m",strtotime($pp->actual_date)) @endphp, @php echo date("d",strtotime($pp->actual_date)) @endphp, @php echo date("H",strtotime($pp->actual_date)) @endphp, @php echo date("i",strtotime($pp->actual_date)) @endphp),
            @php
          }
          @endphp

          allDay         : false,
          backgroundColor: '#0073b7', //Blue
          borderColor    : '#0073b7' //Blue
        },

                    @php

                }
            @endphp

        ],
        editable  : true,
        droppable : true, // this allows things to be dropped onto the calendar !!!
        drop      : function(info) {
          // is the "remove after drop" checkbox checked?
          if (checkbox.checked) {
            // if so, remove the element from the "Draggable Events" list
            info.draggedEl.parentNode.removeChild(info.draggedEl);
          }
        }
      });

      calendar.render();
      // $('#calendar').fullCalendar()

      /* ADDING EVENTS */
      var currColor = '#3c8dbc' //Red by default
      // Color chooser button
      $('#color-chooser > li > a').click(function (e) {
        e.preventDefault()
        // Save color
        currColor = $(this).css('color')
        // Add color effect to button
        $('#add-new-event').css({
          'background-color': currColor,
          'border-color'    : currColor
        })
      })
      $('#add-new-event').click(function (e) {
        e.preventDefault()
        // Get value and make sure it is not null
        var val = $('#new-event').val()
        if (val.length == 0) {
          return
        }

        // Create events
        var event = $('<div />')
        event.css({
          'background-color': currColor,
          'border-color'    : currColor,
          'color'           : '#fff'
        }).addClass('external-event')
        event.text(val)
        $('#external-events').prepend(event)

        // Add draggable funtionality
        ini_events(event)

        // Remove event from text input
        $('#new-event').val('')
      })
    })
  </script>

  @endpush

