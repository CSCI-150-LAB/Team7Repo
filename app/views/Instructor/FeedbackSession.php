<h1 class="mb-3" style= "background-color: #13284c; padding:60px; color: #ffffff;">Feedback Page</h1>




<form method="POST">
    
    <label for="feedback-description">Feedback Description</label>
    <input type="text" class="form-control" id="feedback-description" placeholder='"Explain to me how you feel about doing a kinesthetic activity for a midterm review"'>

    <label for="feedbackStart">Start Time</label>
    <input type="time" class="form-control <?php echo !empty($errors['starttime']) ? 'is-invalid' : '' ?>" id="feedbackStart" name="feedbackStart">
    <label for="feedbackEnd">End Time</label>
    <input type="time" class="form-control <?php echo !empty($errors['endtime']) ? 'is-invalid' : '' ?>" id="feedbackEnd" name="feedbackEnd">

    <button type="submit" class="btn btn-primary">Initiate Feedback Session</button>

</form>
