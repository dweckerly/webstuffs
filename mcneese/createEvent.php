<?php
include('header.php');
?>
<div class="container">
    <h1>Create New Event</h1>
    <form action="submitEvent.php" method="POST">
        <div class="form-group">
            <label for="eventName">Event Name</label>
            <input required="true" type="text" id="eventName" name="eventName" class="form-control">
        </div>
        <div class="form-group">
            <label for="location">Location</label>
            <input required="true" type="text" id="location" name="location" class="form-control">
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="date">Date</label>
                <input required="true" type="date" id="date" name="date" class="form-control">
            </div>                
            <div class="form-group col-md-6">
                <label for="time">Time</label>
                <input required="true" type="time" id="time" name="time" class="form-control">
            </div>
        </div>
        <button type="submit" name='submit' class="btn btn-primary">Submit</button>
    </form>
</div>
<?php
include('footer.php');
?>