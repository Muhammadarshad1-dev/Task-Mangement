@include('include.header')
<body class="text-center">
<div class="container">
 @include('task1.form')

 <div class="TaskTable" id="TaskTable"></div>


</div>
</body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<!-- Bootstrap CSS -->
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

<!-- Bootstrap JS -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>




<script>
    $(document).ready(function(){
        // Fetch and update tasks on page load
        fetchAndUpdateTasks();

        $('#createbtn').on('click', function(e){
            e.preventDefault();
            
            // Collect form data
            let formData = {
                title: $('#title').val(),
                description: $('#description').val(),
                priority: $('#priority').val(),
                due_date: $('#due_date').val(),
                completed: $('#completed').is(':checked') ? 1 : 0
            };

          

          


            // Send AJAX request to store the task
            $.ajax({
                url: '/tasks/store',  
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
                    
                    // Reset the form
                    $('#form')[0].reset();

                    // Fetch and update tasks after successful creation
                    fetchAndUpdateTasks();
                },
                error: function(error) {
                    $('#alertContainer').html(`
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            Error creating task. Please try again.
                        </div>
                    `);
                }
            });
        });
    });








    // Function to fetch and update tasks
    function fetchAndUpdateTasks() {
        $.ajax({
            url: '/task1/show',
            type: 'GET',
            dataType: 'html',
            success: function(response) {
                $('#TaskTable').html(response); 
            },
            error: function(error) {
                alert("Error fetching tasks:", error);
            }
        });
    }
</script>



