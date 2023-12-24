
<div class="row">
<div class="col-sm-12">
<h1 class="h4">Task Mangement</h4>
<form class="form" id="form">
  
      <div  id="alertContainer"></div>
    <div class="form-group"> 
     <label class="title">Title</label>
    <input type="text" id="title" name="title" class="form-control" placeholder="Task Title" required>
 
    </div>

    <div class="form-group">
    <label class="description">Description</label>
    <textarea id="description" name="description" class="form-control" placeholder="Task Desciption" required></textarea>
    </div>

    <div class="form-group">
    <label class="priority">Priority</label>
    <input type="number" id="priority" name="priority" value="1" class="form-control" required>
    </div>


    <div class="form-group">
        <label class="due_date">Due Date</label>
         <input type="date" id="due_date" name="due_date" class="form-control" required>
    </div>


    <div class="form-group">
    <label class="completed">Completed:</label><br>
    <input type="checkbox" id="completed" name="completed" value="1" class="form-control"></br>
    </div></br>


    <div class="form-group">

        <button type="submit" class="btn btn-primary" id="createbtn">Create Task</button></br>
    </div></br>
</form>   
</div>
</div>

