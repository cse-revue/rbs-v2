var performance = null;
var segment = null;

// An array to hold the current state of the seats
var seats = [];

var loading = [];
var displaysegment = [];

// This function shows the main menu.  It hides all other divs
function toShow() {
    toShowPre();

    performance = null;

    $('#segments').hide();
    $('#loading').hide();
    $('#theatre_render').hide();
    $('#performances').show();

    toShowSpec();
}

// This function shows the performance screen.  It hides all other divs.
function toPerformance(perf) {

    $("[id^=segments_]").each(function() {
        $(this).hide();
    });

    $('#performance_buttons').show();
    $('#loading').hide();
    $('#theatre_render').hide();
    $('#performances').hide();

    performance = perf;

    // Set up the seats array
    if (!seats[performance]) {
        seats[performance] = []
        var a = [];
        a[0] = {}; // The original seats state
        a[1] = {}; // Any new seats
        seats[performance] = a;

        // Now we'll grab the seat data and fill the original seat state.  Firstly, make the loading screen show when the user clicks a segment.
        loading[performance] = true;

        // This is the variable which is set if the loading screen is loaded.
        // It's what segment will be displayed immediately after the screen is open
        displaysegment[performance] = null

        // Now make the request.  This requires a function in either booking_user.js or booking_admin.js, depending on which page is loaded
        loadPerformanceData(performance);
    } else {
        loadPerformance(performance);
    }

    toPerformanceSpec();
    if (segments.length == 1) {
        for (i in segments) {
            toSegment(i);
            break;
        }
    } else {
        $("#segments").show();
    }
}

// This function moves the screen to a specific segment.  It hides all other divs and shows the segment screen.
function toSegment(seg, perf) {
    if(seg == -1) {
        if(segment == null) return;
        seg = segment;
    }

    showSegTheatre();

    if (segment != null) {
        document.getElementById('segment' + segment).style.display = 'none';
    }

    segment = seg;
    performancesElem = document.getElementById('performances');
    if (performancesElem) {
        performancesElem.style.display = 'none';
    }
    segmentsElem = document.getElementById('segments');
    if (segmentsElem) {
        segmentsElem.style.display = 'none';
    }
    document.getElementById('theatre_render').style.display = 'block';

    if (loading[performance]) {
        displaysegment[performance] = segment;
        document.getElementById('loading').style.display = 'block';
    } else {
        document.getElementById('loading').style.display = 'none';
        document.getElementById('segment' + seg).style.display = 'block';
    }

    window.location.hash = 'target';


    toSegmentSpec();
    if(typeof perf !== null) {
        $("#segments_" + perf + " a.segmentlink_admin.selected").removeClass("selected");
        $($("#segments_" + perf + " a.segmentlink_admin").get(segment)).addClass("selected");
    }

    $('body').height($(document).height());
}

// The seat state images
var seatimages = [];
seatimages[-1] = 'img/free.gif'; // Expired
seatimages[0] = 'img/free.gif'; // Free and Available
seatimages[1] = 'img/booked.gif'; // Booked
seatimages[2] = 'img/unavailable.gif'; // Taken by another user or otherwise unavailable
seatimages[3] = 'img/booked.gif'; // Confirmed
seatimages[4] = 'img/paid.gif'; // Paid
seatimages[5] = 'img/paid.gif'; // Paid at Sales Desk
seatimages[6] = 'img/paid.gif'; // Paid Direct Debit
seatimages[7] = 'img/paid.gif'; // Paid Paypal
seatimages[8] = 'img/booked.gif'; // Payment Pending
seatimages[9] = 'img/unavailable.gif'; // Unavailable
seatimages[10] = 'img/vip.gif'; // VIP

var seatimages_hi = [];
seatimages_hi[-1] = 'img/free_hi.gif'; // Expired
seatimages_hi[0] = 'img/free_hi.gif'; // Free and Available
seatimages_hi[1] = 'img/booked.gif'; // Booked
seatimages_hi[2] = 'img/unavailable_hi.gif'; // Taken by another user or otherwise unavailable
seatimages_hi[3] = 'img/booked.gif'; // Confirmed
seatimages_hi[4] = 'img/paid.gif'; // Paid
seatimages_hi[5] = 'img/paid.gif'; // Paid at Sales Desk
seatimages_hi[6] = 'img/paid.gif'; // Paid Direct Debit
seatimages_hi[7] = 'img/paid.gif'; // Paid Paypal
seatimages_hi[8] = 'img/booked.gif'; // Payment Pending
seatimages_hi[9] = 'img/unavailable_hi.gif'; // Unavailable
seatimages_hi[10] = 'img/vip_hi.gif'; // VIP


function setSeat(seat, state, highlight) {
    d = document.getElementById(seat);
    if (highlight)
        d.src = seatimages_hi[state];
    else
        d.src = seatimages[state];
}

function reloadPerformanceData() {
    if (performance != null)
        loadPerformanceData(performance);
}

function loadPerformance(perf) {
    a = seats[perf][0];
    for (i in a) {
        setSeat(i, a[i]);
    }
    a = seats[perf][1];
    for (i in a) {
        setSeat(i, a[i]);
    }
}

function scale(zoomval) {
    segs = document.getElementById('theatre_zoom');
    theatre_scale *= zoomval;
    segs.style.fontSize = theatre_scale + 'em';
}

function resetzoom() {
    segs = document.getElementById('theatre_zoom');
    theatre_scale = 1;
    segs.style.fontSize = '1em';
}

function setScale(zoom) {
    segs = document.getElementById('theatre_zoom');
    theatre_scale = zoom;
    segs.style.fontSize = theatre_scale + 'em';
}

function widthToWindow() {
    if (window.innerWidth)
        var width = window.innerWidth;
    else if (document.body.clientWidth)
        var width = document.body.clientWidth;

    if (0.95 * width < theatre_width)
        setScale(0.95 * width / theatre_width);
    else
        setScale(1);
}


function showSegTheatre() {
    fulltheatre = false;
    for (var i in segments) {
        $('#navusegment' + i).show();
        $('#navdsegment' + i).show();
        if (i != segment)
            $('#segment' + i).hide();
    }
}


