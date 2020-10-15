<h1>Add Review</h1>

<form method = 'POST'>

Rating (Stars):
    <input type = 'radio' name = 'rating'> 1
    <input type = 'radio' name = 'rating'> 2
    <input type = 'radio' name = 'rating'> 3
    <input type = 'radio' name = 'rating'> 4
    <input type = 'radio' name = 'rating'> 5
    <br>

    Recommendation:
    <input type = 'text' name = 'recommendation' placeholder = "Tell us about your experiences with this instructor.">
    <br>

    Would you like this rating to be anonymous?
    <input type = 'radio' name = 'anon' value = 1> Yes
    <br>
    <input type = 'radio' name = 'anon' value = 0> No

    <br>
    <button type="submit" class="btn btn-primary">Add Review</button>

</form>