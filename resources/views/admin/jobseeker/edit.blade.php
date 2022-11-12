<div class="modal fade" id="modal-edit">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="" id="form-edit" method="POST" role="form">
                @csrf
                <div class="modal-header">
                    <h4 class="modal-title">Update</h4>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <label for="email-edit">Email</label>
                        <input type="text" class="form-control" id="email-edit" placeholder="Input your email">
                    </div>

                    <div class="form-group">
                        <label for="">Full Name</label>
                        <input type="text" class="form-control" id="fullname-edit" placeholder="Input your name">
                    </div>

                    <div class="form-group">
                        <label for="">Gender</label>
                        <select name="gender" id="gender-edit" class="form-control" required="required">
                            <option value="0">Male</option>
                            <option value="1">Female</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="">Phone</label>
                        <input type="number" class="form-control" id="phone-edit" placeholder="Input your phone number">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Edit</button>
                </div>
            </form>
        </div>
    </div>
</div>