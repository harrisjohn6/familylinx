<div id="invite-modal" class="modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Invite Someone</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">

                <div class="modal-body">
                    <div class="form-group">
                        <label for="relationship">Relationship:</label>
                        <select name="relationship" id="relationship" class="form-control">
                            <option value="">Select Relationship</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" name="name" id="name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" name="email" id="email" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="additional_info">Would you like to fill out their information now?</label>
                        <input type="checkbox" name="additional_info" id="additional_info">
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="invite-submit-button">Send Invite</button>
            </div>
        </div>
    </div>
</div>
