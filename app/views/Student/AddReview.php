<h1>Add Review</h1>
<div class = "card">
    <div class = "card-body">    
        <form method = 'POST'>
            <b>Rating (Stars):</b>
    
            <div class = "rating"> 
           
                <input id = "fiveStar" type = 'radio' name = 'rating' value = 5 class = "radio-btn hide"> 
                <label for = "fiveStar"> ☆ </label>

                <input id = "fourStar" type = 'radio' name = 'rating' value = 4 class = "radio-btn hide"> 
                <label for = "fourStar"> ☆ </label>

                <input id = "threeStar" type = 'radio' name = 'rating' value = 3 class = "radio-btn hide"> 
                <label for = "threeStar"> ☆ </label>

                <input id = "twoStar" type = 'radio' name = 'rating' value = 2 class = "radio-btn hide">  
                <label for = "twoStar"> ☆ </label>

                <input id = "oneStar" type = 'radio' name = 'rating' value = 1 class = "radio-btn hide"> 
                <label for = "oneStar"> ☆ </label>

            </div>

            <b>Recommendation:</b>
            <br>
            <div class="form-group">
            <textarea class="form-control" name = 'recommendation' placeholder="Tell us about your experiences with this instructor." rows="3"></textarea>
            </div>

            <b>Would you like this rating to be anonymous?</b>
            <input type = 'radio' name = 'anon' value = 'yes'> Yes
            <input type = 'radio' name = 'anon' value = 'no'> No
            <br>
            <br>
            <h4>*Additional Feedback (Optional)*</h4>
            
            <b>Would you take this professor again?</b>
            <input type = 'radio' name = 'takeAgain' value = 'Yes'> Yes
            <input type = 'radio' name = 'takeAgain' value = 'No'> No
            <br>
            <br>

            <b>Was homework required in this class?</b>
            <input type = 'radio' name = 'homework' value = 'Yes'> Yes
            <input type = 'radio' name = 'homework' value = 'No'> No
            <br>
            <br>

            <b>Was attendance mandatory?</b>
            <input type = 'radio' name = 'attendanceRequired' value = 'Yes'> Yes
            <input type = 'radio' name = 'attendanceRequired' value = 'No'> No
            <br>
            <br>

            <b>Your grade in the class:</b>
            <input type = 'radio' name = 'grade' value = 'A'> A
            <input type = 'radio' name = 'grade' value = 'B'> B
            <input type = 'radio' name = 'grade' value = 'A'> C
            <input type = 'radio' name = 'grade' value = 'B'> D
            <input type = 'radio' name = 'grade' value = 'A'> F

            <br>
            <br>
            <br>
            <button type="submit" class="btn btn-cardinalred">Add Review</button>

        </form>
    </div>
</div>