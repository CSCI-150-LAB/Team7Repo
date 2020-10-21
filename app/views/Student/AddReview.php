<h1>Add Review</h1>

<form method = 'POST'>

    Rating (Stars):
    <input type = 'radio' name = 'rating' value = 1> 1
    <input type = 'radio' name = 'rating' value = 2> 2
    <input type = 'radio' name = 'rating' value = 3> 3
    <input type = 'radio' name = 'rating' value = 4> 4
    <input type = 'radio' name = 'rating' value = 5> 5
    <br>
    <br>

    Recommendation:
    <br>
    <div class="form-group">
    <textarea class="form-control" name = 'recommendation' placeholder="Tell us about your experiences with this instructor." rows="3"></textarea>
    </div>
    <br>

    Would you like this rating to be anonymous?
    <input type = 'radio' name = 'anon' value = 'yes'> Yes
    <input type = 'radio' name = 'anon' value = 'no'> No

    <br>
    <br>
    <br>
    <button type="submit" class="btn btn-primary">Add Review</button>

</form>