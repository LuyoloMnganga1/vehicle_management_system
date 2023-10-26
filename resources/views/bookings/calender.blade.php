@extends('layouts.main')
@section('title')
Booking Calender
@endsection
@section('content')
<link href="https://cdn.jsdelivr.net/npm/@fullcalendar/core/main.css" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid/main.css" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/@fullcalendar/timegrid/main.css" rel="stylesheet" />
{{-- <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css' rel='stylesheet'>
<link href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css' rel='stylesheet'> --}}
<style>
    .fc-day-today {
    background: #C3bE5C !important;
    color: white !important;
    border: none !important;
}
#calendar th{
    background-color:#18345D !important;
    color:  white !important;
    border:  none !important;
}
</style>
<div class="card">
    <div class="card-header text-center" style="background-color: #18345D; color: white">
        <h2 style="color: white">Booking Calender</h2>
    </div>
    <div class="card-body">
      @if ($errors->any())
      <div class="alert alert-danger alert-dismissible">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <ul>
              @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div>
      @endif
      @if ($message = Session::get('success'))
      <div class="alert alert-success alert-dismissible">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <p>{{ $message }}</p>
      </div>
      @endif
      <div id="calendar"></div>
    </div>
</div>
<br>
@endsection
@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                var calendarEl = document.getElementById('calendar');
                var calendar = new FullCalendar.Calendar(calendarEl, {
                        headerToolbar: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'dayGridMonth,timeGridWeek'
                    },
                    events: @json($events),

                });
                calendar.render();
            });
        </script>
@endsection
