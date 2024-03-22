<!-- Logout Modal-->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Delete Owner Profile</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="./controller/delete.php" method="POST">
                <div class="modal-body">Select "Delete" below if you are ready to delete the inspector profile.
                    <div class="d-flex justify-content-center">
                        <div class="d-flex flex-column">
                            <label for="password">Password</label>
                            <div class="form-group">
                                <input type="password" name="password"
                                    class="form-control form-control-user squared-border" id="password"
                                    aria-describedby="passwordHelp" placeholder="Enter Your Password..." required>

                                <input type="hidden" name="inspector_id"
                                    value="<?php echo $inspector['inspector_id']?>" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-dark" type="button" data-dismiss="modal">Cancel</button>
                    <button class="btn btn-danger" name="submit">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>