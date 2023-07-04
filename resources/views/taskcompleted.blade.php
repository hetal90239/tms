
<body>
<div class="container">
  <h2 class="text-center">View Completed Task Records</h2>
       
  <table class="table table-bordered table-striped">
    <thead>
      <tr>
        <th> Id </th>
        <th>Task Title</th>
		    <th>Employee Name</th>
		    <th>Assign Date</th>
		    <th>Competed Date</th>
		    <th>Status</th>
      </tr>
        </thead>
    <tbody>
     @foreach ($users as $user)
      <tr>
        <td>{{ $user->id }}</td>
        <td>{{ $user->tasktitle }}</td>
        <td>{{ $user->empname }}</td>
        <td>{{ $user->assigndate }}</td>
        <td>{{ $user->completedate }}</td>
        <td>@if($user->status =="pending")
              <button class="btn"><span class="badge badge-primary">pending</span></button>
            @elseif($user->status =="inprogress")
              <button class="btn"><span class="badge badge-success">inprogress</span></button>
            @else
               <button class="btn"><span class="badge badge-danger">completed</span></button>
            @endif
        </td>
    </tr>
      @endforeach   
    </tbody>
  </table>
</div>
</body>
</html>