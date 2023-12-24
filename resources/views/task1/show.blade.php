
<h4>All Tasks</h4>
<div id="deleteMsg"></div>
<table class="table table-bordered">
<thead>
<tr>
    <th scope="col">S#no</th>
    <th scope="col">Title</th>
    <th scope="col">Description</th>
    <th scope="col">Priority</th>
    <th scope="col">Due_date</th>
    <th scope="col">Status</th>
    <th scope="col">Action</th>
</tr>
</thead>
<tbody>
@foreach($tasks as $task)
<tr>
    <th scope="row">{{ $loop->iteration }}</th>
    <td>{{ $task->title }}</td>
    <td>{{ $task->description }}</td>
    <td>{{ $task->priority }}</td>
    <td>{{ $task->due_date }}</td>
    <td>
    
     @if($task->completed == 0)
    
        <button class="btn btn-warning">Pending</button>
    @else
     <button class="btn btn-primary">Completed</button>
    @endif
    </td>
    <td>
    <button class="btn btn-danger button-spacing delete-task" data-task-id="{{ $task->id }}">Delete</button>

    <button class="btn btn-primary button-spacing edit-task" data-task-id="{{ $task->id }}" data-toggle="modal" data-target="#exampleEditModal">Edit</button>

    <button class="btn btn-info button-spacing view-task" data-toggle="modal" data-target="#exampleModal" data-task-id="{{ $task->id }}">View</button>
    </td>
</tr>
@endforeach
</tbody>
</table>



<!-- Task View Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="exampleModalLabel">Task View</h5>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body">
<table class="table table-bordered">
<tr>
<th>Title</th>
<td id="taskTitle"></td>
</tr>

<tr>
<th>Description</th>
<td id="taskDescription"></td>
</tr>

<tr>
<th>Priority</th>
<td id="taskPriority"></td>
</tr>

<tr>
<th>Due Date</th>
<td id="taskDueDate"></td>
</tr>

 <tr>
<th>Status</th>
<td>
<button id="taskStatus" class="btn btn-lg"></button>
</td>
</tr>
</table>

</div>
<div class="modal-footer">
<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
</div>
</div>
</div>
</div>
<!--close Task View Modal  -->



<!-- Task Edit Modal -->
<div class="modal fade" id="exampleEditModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document"> <!-- Added modal-lg here -->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Task Modal</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
               
                <div id="editModal" class="editModal"></div>
               
            </div>
          
          
        </div>
    </div>
</div>
<!--close Task Edit Modal  -->







<script>
    $(document).ready(function(){
        $(document).on('click', '.delete-task', function(e){
            e.preventDefault();
            let taskId = $(this).data('task-id');
            $.ajax({
                url: '/task1/delete/' + taskId, 
                type: 'GET',  
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    fetchAndUpdateTasks();
                    $('#deleteMsg').html(`
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            ${response.message}
                        </div>
                    `);
                },
                error: function(error) {
                    // Handle error or display error message
                    $('#deleteMsg').html(`
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                           ${response.message}
                        </div>
                    `);
                }
            });
        });
    });

  
</script>



<script>
    $(document).on('click', '.view-task', function(e){
        e.preventDefault();
        let taskId = $(this).data('task-id');
        
        $.ajax({
            url: '/task1/get/' + taskId,
            type: 'GET',
            success: function(response) {
                $('#taskTitle').text(response.title); // Use response here
                $('#taskDescription').text(response.description);
                $('#taskPriority').text(response.priority);
                $('#taskDueDate').text(response.due_date);

                 let buttonText = response.completed ? 'Completed' : 'Pending';
                 let buttonClass = response.completed ? 'btn-success' : 'btn-warning'; 

                 $('#taskStatus').text(buttonText).addClass(buttonClass);
            },
            error: function(error) {
                console.error("Error fetching task:", error);
            }
        });
    });
</script>



<script>

    $(document).on('click', '.edit-task', function(e) {
        e.preventDefault();
        let taskId = $(this).data('task-id');
        $.ajax({
            url: `/task1/edit/${taskId}`,
            type: 'GET',
            success: function(response) {
                $('#editModal').html(response);
            },
            error: function(error) {
                alert("Error fetching task:", error);
            }
        });
    });
</script>






