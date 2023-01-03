   <div class="element-box">

                            <div class="row">
                                 <div class="col-md-12">
                                    <h5 style="color: blue;border-bottom: 1px solid blue;padding: 10px;">Add New Employee</h5>                                   
                                </div>  
                            </div>
                                  <form class="container" action="#" method="post" enctype="multipart/form-data">


                            <div class="row">

<!--                          
                                <fieldset class="col-md-12">
                                    <legend>Company Details
                                        <hr></legend>
                                </fieldset>-->

                                <div class="col-sm-3">
                                    <div class="form-group"><label for="">Employee Code</label>
                                        <input class="form-control" name="emp_code" placeholder="Employee Code" type="text">
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group"><label for="">Name</label>
                                        <input class="form-control" name="Name" placeholder="Name" type="text">
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group"><label for="">Email ID</label>
                                        <input class="form-control" name="emailid" placeholder="Email ID" type="email"  required>
                                    </div>
                                </div>
 <div class="col-sm-3">
                                    <div class="form-group"><label for="">Mobile No.</label>
                                        <input class="form-control" name="mobile" placeholder="Mobile No." type="text" pattern="[7-9]{1}[0-9]{9}" required>
                                    </div>
                                </div>
 <div class="col-sm-3">
                                    <div class="form-group"><label for="">Upload Profile Photo</label>
                                        <input name="profile" type="file">
                                    </div>
                                </div>
 <div class="col-sm-3">
                                    <div class="form-group"><label for="">User ID</label>
                                        <input class="form-control" name="userid" placeholder="User ID" type="text" readonly>
                                    </div>
                                </div>

 <div class="col-sm-3">
                                    <div class="form-group"><label for="">Password</label>
                                        <input class="form-control" name="pswd" placeholder="password" type="text" pattern ="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
                                    </div>
                                </div>


                                <div class="col-sm-3">
                                    <div class="form-group"><label for="">Employee</label>
                                        <select id="emp_id" name="usertype" class="form-control">
                                            <option>--select Employee--</option>
                                            <option value="Admin" >Admin</option>
                                            <option value="Management" >Management</option>
                                            <option value="Employee" >Employee</option>
                                        </select> 
                                    </div>
                                </div>
                            

                                    <div class="form-buttons-w text-right">
                                        <input class="btn btn-primary" type="submit" value="Add Employee" name="submit" >
                                    </div>
                                </div>
                               
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script>
    $('input[name="emp_code"]').change(function() {
    $('input[name="userid"]').val($(this).val());
});
</script>
                                