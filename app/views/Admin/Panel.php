<div class="container">
    <div style="padding-top: 60px">
        <div class="row" style="margin:auto">
            <div class="col-sm-3">
                <a href='<?php echo $this->baseUrl("Admin/UserAccounts")?>'>
                    <div class="card">
                        <img class="card-img-top" src="<?php echo $this->publicUrl('images/users_icon.jpg')?>" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title" style="text-align: center">Users</h5>  

                        </div>
                    </div>
                </a>
            </div>
            <div class="col-sm-3">
                <a href='<?php echo $this->baseUrl("Admin/AdminAccounts")?>'>
                    <div class="card">
                        <img class="card-img-top" src="<?php echo $this->publicUrl('images/adminroles_icon.jpg')?>" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title" style="text-align: center">Admin Roles</h5>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-sm-3">
                <a href='<?php echo $this->baseUrl("Admin/InstructorFeedback")?>'>
                    <div class="card">
                        <img class="card-img-top" src="<?php echo $this->publicUrl('images/allfeedback_icon.jpg')?>" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title" style="text-align: center">All Feedback</h5>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-sm-3">
                <a href='<?php echo $this->baseUrl("Admin/StartSession")?>'>
                    <div class="card">
                        <img class="card-img-top" src="<?php echo $this->publicUrl('images/companyinfo_icon.jpg')?>" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title" style="text-align: center">Start Feedback Session</h5>
                        </div>
                    </div>
                </a>
        </div>
    </div>
</div>

