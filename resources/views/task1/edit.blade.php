<form class="editform" id="editform">
    <div id="alertContainer"></div>
    <input type="hidden" name="tid" value="{{$task->id}}">

    <div class="form-group"> 
        <label class="title">Title</label>
        <input type="text" id="etitle" name="etitle" class="form-control" value="{{$task->title}}">
    </div>

    <div class="form-group">
        <label class="description">Description</label>
        <textarea id="edescription" name="edescription" class="form-control">{{$task->description}}</textarea>
    </div>

    <div class="form-group">
        <label class="priority">Priority</label>
        <input type="number" id="epriority" name="epriority" class="form-control" value="{{$task->priority}}">
    </div>

    <div class="form-group">
        <label class="due_date">Due Date</label>
        <input type="date" id="edue_date" name="edue_date" class="form-control" value="{{$task->due_date}}">
    </div>

    <div class="form-group">
        <label class="completed">Completed:</label><br>
        <input type="checkbox" id="ecompleted" name="ecompleted" class="form-control" {{$task->completed ? 'checked' : ''}}></br>
    </div></br>

    <div class="form-group">
    <button type="submit" class="btn btn-primary" id="updatebtn">Update Task</button></br>
    </div>
</form>

<script>
    $(document).ready(function() {
    $('#editform').submit(function(e) { 
        e.preventDefault();

        let taskId = $('#editform input[name="tid"]').val(); 
        let formData = {
            title: $('#etitle').val(),
            description: $('#edescription').val(),
            priority: $('#epriority').val(),
            due_date: $('#edue_date').val(),
            completed: $('#ecompleted').is(':checked') ? 1 : 0
        };

        $.ajax({
            url: `/task1/update/${taskId}`,
            type: 'POST',
            data: formData,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                $('#alertContainer').html(`
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        ${response.message}
                    </div>
                `);

                // Close the modal
                $('#exampleEditModal').modal('hide');

                fetchAndUpdateTasks();
            },
            error: function(error) {
                $('#alertContainer').html(`
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        Error updating task. Please try again.
                    </div>
                `);
            }
        });
    });
});

function fetchAndUpdateTasks() {
    location.reload();
}

</script>