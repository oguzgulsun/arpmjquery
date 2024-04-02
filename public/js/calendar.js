let currentWeekStart = moment().startOf('week');

function newEvent(date) {
    // console.log(date)
    $("#newEventDate").val(date)
    $('#newEventModal').modal('show');
}
function updateWeekDays() {
    let daysContainer = document.getElementById('weekDays');
    daysContainer.innerHTML = ''; // Önceki günleri temizle
    for (let i = 0; i < 7; i++) {
        let datestring = currentWeekStart.clone().add(i, 'days').format('DD.MM.YYYY');

        let dayDiv = document.createElement("div");
        let dayDivTitle = document.createElement("h5");
        let eventsDiv = document.createElement("div");
        let newEventDiv = document.createElement("div");
        let newEventDivButton = document.createElement("button");
        newEventDivButton.textContent = "+"
        newEventDivButton.onclick = function () { newEvent(datestring); };

        eventsDiv.className = "events";
        newEventDiv.className = "newevent";
        dayDiv.className = 'weekDays_day';
        dayDiv.setAttribute('data-date', datestring);

        dayDivTitle.textContent = datestring;
        dayDiv.appendChild(dayDivTitle);
        dayDiv.appendChild(eventsDiv);
        dayDiv.appendChild(newEventDiv);
        newEventDiv.appendChild(newEventDivButton);
        dayDiv.appendChild(newEventDiv);
        daysContainer.appendChild(dayDiv);


    }
}

function dayClicked(event) {

    $("#deleteeventid").val(event.id)
    $("#updateEventDate").val(event.date)
    $("#updateEventTitle").val(event.title)
    $("#updateEventDesc").val(event.description)
    $('#updateEventModel').modal('show');
    
    // alert("Date: " + event.date);
    // Burada tıklanan güne özgü eylemleri gerçekleştirebilirsiniz.
}

function clearEvents() {
    const days = document.querySelectorAll('.weekDays_day');
    days.forEach(day => {
        const eventsDiv = day.querySelector('.events');
        if (eventsDiv) {
            eventsDiv.innerHTML = '';
        }
    });
}
function openDeleteBox(){
    // var id = $("#deleteeventid").val();
    // $("#lastid").val(id);
    $('#confirmDeleteModal').modal('show');
}

$('#confirmDeleteButton').click(function() {
    // Silme işlemi için AJAX isteği veya form gönderimi
    // Örneğin, silme işlemini gerçekleştiren AJAX isteği
    var eventId = $('#deleteeventid').val(); // Silinecek etkinliğin ID'sini al

    var formData = {
        id:eventId,
    };

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        type: "POST",
        url: "/api/deleteevent",
        data:formData
    }).done(function(response) {
        $('#confirmDeleteModal').modal('hide'); 
        $('#updateEventModel').modal('hide'); 
        fetchEvents()
    });
});

function fetchEvents() {

    $.ajax({
        type: "GET",
        url: "/api/events",
        dataType: "json"
    }).done(function (events) {
        clearEvents() 
        events.forEach(event => {

            let eventDate = moment(event.date); 
            let dayDiv = document.querySelector('.weekDays_day[data-date="' + eventDate.format('DD.MM.YYYY') + '"]');

            if (dayDiv) {
                const eventsDiv = dayDiv.querySelector('.events');
                const eventDiv = document.createElement('div');
                eventDiv.setAttribute('data-id', event.id);
                eventDiv.className = 'event';
                eventDiv.textContent = event.title;
                eventDiv.onclick = function () { dayClicked(event); };
                eventsDiv.appendChild(eventDiv);

            }
        });
    }).fail(function (jqXHR, textStatus, errorThrown) {
        alert("Err " + textStatus + ", " + errorThrown);
    });

}



document.getElementById('prevWeek').addEventListener('click', function () {
    currentWeekStart.subtract(1, 'weeks');
    updateWeekDays();
    fetchEvents();
});

document.getElementById('nextWeek').addEventListener('click', function () {
    currentWeekStart.add(1, 'weeks');
    updateWeekDays();
    fetchEvents();
});


$("#newEventForm").submit(function (e) {
    e.preventDefault();
    const eventDate = moment($("#newEventDate").val()); 

    var formData = {
        date: eventDate.format('YYYY-DD-MM'),
        title: $("#newEventTitle").val(),
        description: $("#newEventDesc").val(),
    };

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: "POST",
        url: "/api/newevent",
        data: formData,
        success: (response) => {
            $('#newEventModal').modal('hide');
            $('#newEventForm').trigger("reset")
            fetchEvents()
        },
        error: function (response) {
            console.error("Hata: ", response);
        }
    });
});

updateWeekDays(); 
fetchEvents();