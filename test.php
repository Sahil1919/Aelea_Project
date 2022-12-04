

<!DOCTYPE html>
<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script>
jQuery(document).ready(function() {
    jQuery("#status").change(function() {
        if (jQuery(this).val() === 'Close'){ 
            jQuery('textarea[name=other_remark]').show();   
        } else {
            jQuery('textarea[name=remark]').hide(); 
        }
    });
});


</script>
</head>
<form class="container" action="#" method="post" enctype="multipart/form-data">


                    <div class="row">


                        <div class="col-sm-3">
                            <div class="form-group"><label for="">Change Status</label>
                                <select id = 'status' name="status" class="form-control" >
                                    <option>--Select--</option>
                                    <option value="Open">Open</option>
                                    <option value="WIP">WIP</option>
                                    <option value="Close">Close</option>  
                                    <option value="Cancel">Cancel</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group"><label for="">Remark</label>
                                <textarea  name="remark" class="form-control" placeholder="Remark"></textarea>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group"><label for="">Achievements</label>
                                <textarea  name="other_remark" class="form-control" placeholder="Achievements"></textarea>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group"><label for="">Benefits</label>
                                <textarea  name="other_remark" class="form-control" placeholder="Benefits"></textarea>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <br>
                                <input class="btn btn-primary" type="submit" value="Change Status" name="submit">
                                <!--<label for="">Conform Password</label>-->
                                <!--<input class="form-control" name="CPSWD" placeholder="Conform Password" type="password">-->
                            </div>
                        </div>




                        <!--                                <div class="form-buttons-w text-right">
                                                            <input class="btn btn-primary" type="submit" value="Change Password" name="submit">
                                                        </div>-->
                    </div>
                </form>
                <select id="carm3" name="interest">
    <option value="d">Dogs</option>
    <option value="c">Cats</option>
    <option value="r">Rabbits</option>
    <option value="other">other</option>
</select>
<input type="text" name="other_interest" style="display:none" />
</body>
</html>
