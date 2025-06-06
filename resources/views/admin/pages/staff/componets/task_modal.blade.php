<!-- resources/views/admin/staff/task-modal.blade.php -->
<div class="modal fade" id="taskAssignmentModal" tabindex="-1" role="dialog" aria-labelledby="taskAssignmentModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="taskAssignmentModalLabel">Assign New Task</h5>
                <button type="button" class="btn-close" data-mdb-ripple-init data-mdb-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <form id="taskAssignmentForm">
                <div class="modal-body">
                    @csrf <!-- Add this line -->
                    <input type="hidden" name="staff_id" id="task_staff_id">

                    <div class="form-group">
                        <label for="task_name">Task Name</label>
                        <input type="text" class="form-control" id="task_name" name="name" required>
                    </div>

                    <div class="form-group mt-3">
                        <label for="task_description">Description</label>
                        <textarea class="form-control" id="task_description" name="description" rows="3"></textarea>
                    </div>

                    <div class="row mt-3">
                        <div class="form-group col-md-6">
                            <label for="task_due_date">Due Date</label>
                            <input type="date" class="form-control" id="task_due_date" name="due_date">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="task_priority">Priority</label>
                            <select class="form-control" id="task_priority" name="priority" required>
                                <option value="low">Low</option>
                                <option value="medium" selected>Medium</option>
                                <option value="high">High</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Assign Task</button>
                </div>
            </form>
        </div>
    </div>
</div>
