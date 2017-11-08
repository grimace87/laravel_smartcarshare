@extends('layouts.layout_home')

@section('content')
<div class="container">

	<div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading carshare-subheader">Go To Section</div>
                <div class="panel-body">
                    <ul class="carshare-indent-list">
                        <li><a href="#helpMembers">Members</a></li>
                        <li><a href="#helpBookings">Bookings</a></li>
                        <li><a href="#helpVehicles">Vehicles</a></li>
                        <li><a href="#helpLocations">Locations</a></li>
                        <li><a href="#helpStaff">Staff</a></li>
                        <li><a href="#helpArchive">Archive</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Members -->
    <div class="row" id="helpMembers">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading carshare-subheader">Members</div>
                <div class="panel-body">
                    <p>This system does not permit creation of new members, however existing records can be viewed and updated as needed.</p>
					<p>By clicking on the 'View All' link, you can view all members recorded in the database. Click on 'Details' next
					to any member to view more of their details. These records can be sorted in ascending or descending order according
					their ID number, their status or their name, by clicking on the up or down arrow beside the table column heading that
					you wish to sort by.</p>
					<img src="{{ url('images/help1.png') }}" style="width:100%; height: auto;" />
					<p>When viewing a member's details, you can update any of their details by clicking on trhe 'Update' button.
					You can also approve members with expired or pending memberships, renew expired or suspended memberships, or
					if you are a manager, you can delete a record.</p>
					<img src="{{ url('images/help2.png') }}" style="width:100%; height: auto;" />
					<p>Shortcut links are found on the main menu page to list members who are waiting either approval or renewal.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Bookings -->
    <div class="row" id="helpBookings">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading carshare-subheader">Bookings</div>
                <div class="panel-body">
                    <p>Bookings can be added or viewed by clicking the respective links on the main menu page. From the list of all
					bookings being viewed, you may choose to view more details, and then the options will exist to update or delete
					the selected booking.</p>
					<p>When filling in details to add or update a booking, the date and time fields can be set be a calendar.
					To open the calendar, click on the icon next to the respective input box. The same feature is used anywhere else
					that a date or time is required to be input.</p>
					<img src="{{ url('images/help3.png') }}" style="width:100%; height: auto;" />
                </div>
            </div>
        </div>
    </div>

    <!-- Vehicles -->
    <div class="row" id="helpVehicles">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading carshare-subheader">Vehicles</div>
                <div class="panel-body">
                    <p>Vehicles can be viewed or edited by any staff member, while managers can also add or delete records.
					Keep in mind when entering details that a registration number or VIN number is unique, and cannot be added
					to the database if it already exists.</p>
					<p>When viewing a vehicle's full details, and reviews or damage reports that are attached to that vehicle
					will be listed.</p>
					<img src="{{ url('images/help4.png') }}" style="width:100%; height: auto;" />
                </div>
            </div>
        </div>
    </div>

    <!-- Locations -->
    <div class="row" id="helpLocations">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading carshare-subheader">Locations</div>
                <div class="panel-body">
                    <p>Parking locations can be created, updated or deleted by managers, while other staff are only permitted
					to view the location's details. Along with the written address of a parking location, a map
					will also be shown to highlight the location on a map. The vehicles currently parked at a location
					be listed with the location's full details, if there are any.</p>
					<p>When adding or editing a location, a map will be shown with a marker to indicate where the address
					is. The user has two options for entering the address - type it in, in which case the map marker will
					update to show the typed address, or click on the map, in which case the marker will move to the spot
					where the user clicked, and the spot's address details will automatically be filled in the form.</p>
					<img src="{{ url('images/help5.png') }}" style="width:100%; height: auto;" />
					<img src="{{ url('images/help6.png') }}" style="width:100%; height: auto;" />
                </div>
            </div>
        </div>
    </div>

    <!-- Staff -->
    <div class="row" id="helpStaff">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading carshare-subheader">Staff</div>
                <div class="panel-body">
                    <p>Staff can be added to the system by clicking the 'Register' link at the top of any page, which is visible
					only when logged in as a manager or senior administration staff member.</p>
					<p>Basic information can be viewed about any staff member, though more detailed information is available
					when logged in as a manager. However, any staff member can view and edit their own information. Only a manager
					can edit another staff member, including that staff member's role, though nobody is permitted to edit their
					own role.</p>
					<img src="{{ url('images/help7.png') }}" style="width:100%; height: auto;" />
                </div>
            </div>
        </div>
    </div>

    <!-- Archive -->
    <div class="row" id="helpArchive">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading carshare-subheader">Archive</div>
                <div class="panel-body">
                    <p>Members and bookings can be archived to remove them from the main listings, so that they will only be visible
					via the archive. Once moved to the archivem they can never be moved back.</p>
					<p>Members may be archived if they have expired or cancelled memberships, or optionally also
					if they have suspended memberships. Bookings are archived based on whether they have been completed, or whether they
					were completed at least 30 days ago.</p>
					<img src="{{ url('images/help8.png') }}" style="width:100%; height: auto;" />
					<p>When bookings are archived, the corresponding payment has its data recorded along with the booking in the
					archive. When this happens, the payment is removed from the main system and will only be visible in the booking archive.
					Also consider that members cannot be archived unless all of their bookings have been archived.</p>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
