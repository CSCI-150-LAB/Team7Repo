<h1>Add Review</h1>
<div class = "card">
    <div class = "card-body">
        <form method = 'POST'>
            <b>Rating:</b>
    
            <div class = "rating">
				<div class="rating-field-container">
					<div class="rating-field">
						<input type="hidden" name="rating">
						<?php for ($i = 1; $i <= 5; $i++) : ?>
						<i class="far fa-star score-<?php echo $i ?>"></i>
						<?php endfor; ?>
					</div>
					<?php if (!empty($errors['rating'])) : ?>
						<div class="invalid-feedback">
							<?php echo $errors['rating'] ?>
						</div>
					<?php endif; ?>
				</div>

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
            <input type = 'radio' name = 'grade' value = 'C'> C
            <input type = 'radio' name = 'grade' value = 'D'> D
            <input type = 'radio' name = 'grade' value = 'F'> F

            <br>
            <br>
            <br>
            <button type="submit" class="btn btn-primary">Add Review</button>

        </form>
    </div>
</div>