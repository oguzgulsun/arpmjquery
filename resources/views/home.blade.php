<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Homepage - Calendar Weekly</title>
    {{-- Bootstrap CDN --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    
    <link rel="stylesheet" href="/css/style.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
</head>
<body>
  @include('components.header')

    <div class="calendarview">
      <div class="calendarview_header">
        <div class="calendarview_header_left">
            <button id="prevWeek">← Previous </button>
        </div>
        <div class="calendarview_header_center">
            <h3>You can select day and add delete event</h3>
        </div>
        <div class="calendarview_header_right">
            <button id="nextWeek">Next  →</button>
        </div>
      </div>
      <div class="calendarview_main">
        <div id="weekDays"></div>
      </div>

    </div>

    {{-- modal --}}
  
      <div class="modal fade" id="newEventModal" aria-hidden="true"  aria-labelledby="newEventLabel">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="newEventLabel">New Event</h1>
             
            </div>
            <div class="modal-body">
                <form id="newEventForm">
                    <input type="text" name="newEventDate" id="newEventDate" value="" disabled>
                    <div class="mb-3">
                      <label for="new-event-title" class="col-form-label">Title:</label>
                      <input type="text" class="form-control" id="newEventTitle" name="newEventTitle" required>
                    </div>
                    <div class="mb-3">
                      <label for="new-event-desc" class="col-form-label">Description:</label>
                      <textarea class="form-control" id="newEventDesc" name="newEventDesc"></textarea>
                    </div>
              
                    <div class="modal-footer">
                        <div class="d-grid gap-2" style="width:100%">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>

                  
                    </div>
                </form>
                
            </div>
          </div>
        </div>

      </div>
{{-- modal end --}}


  {{-- update delete modal --}}
  
  <div class="modal fade" id="updateEventModel" aria-hidden="true"  aria-labelledby="updateEventLabel">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header" style="display: flex;justify-content:space-between">
          <h1 class="modal-title fs-5" id="updateEventLabel">Event Tit </h1>
            
            <input type="hidden" name="deleteeventid" id="deleteeventid" value="">
            <button  class="btn btn-danger" onclick="openDeleteBox()">Delete</button>
      
        </div>
        <div class="modal-body">
            <form id="updateEventForm">
                <input type="text" name="updateEventDate" id="updateEventDate" value="" disabled>
                <div class="mb-3">
                  <label for="update-event-title" class="col-form-label">Title:</label>
                  <input type="text" class="form-control" id="updateEventTitle" name="updateEventTitle" required>
                </div>
                <div class="mb-3">
                  <label for="update-event-desc" class="col-form-label">Description:</label>
                  <textarea class="form-control" id="updateEventDesc" name="updateEventDesc"></textarea>
                </div>
                
                <div class="modal-footer">
                    <div class="d-grid gap-2" style="width:100%">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>

              
                </div>
            </form>
            
        </div>
      </div>
    </div>

  </div>
{{-- modal end --}}
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmDeleteModalLabel">Delete Event</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Kapat"></button>
            </div>
            <div class="modal-body">
                Are you sure ?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <form id="deleteFormLast">
                <input type="hidden" id="lastid" value="">
                <button type="button" class="btn btn-danger" id="confirmDeleteButton">Delete</button>
            </form>
            </div>
        </div>
    </div>
</div>



  {{-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script> --}}
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script> 
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

<script src="/js/calendar.js"></script>


</body>
</html>