@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
    <div class="flash-message">
              @foreach(['danger','warning','success','info'] as $message)
               @if (Session::has('alert-'. $message))
                <strong><p class="alert alert-{{$message}}">{{Session::get('alert-'.$message)}} <a href="#" class="close" data-dismiss="alert" aria-label="close"></a></p></strong>
                @endif
              @endforeach
            </div><br>
        <div class="col-md-8 col-md-offset-2">
            
            <div class="panel panel-default">
                <div class="panel-heading">Users</div>

                <div class="panel-body">
                MAH NIGGA

                <!-- Modal -->
              <div id="modalEdit" class="modal fade" role="dialog" aria-hidden="true">
                <div class="modal-dialog">

                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 class="modal-title">Modal Header</h4>
                    </div>
                    <div class="modal-body">
                      <div class="form-group">
                      <label for="userID">User ID:</label>
                      <input type="text" class="form-control" id="userID" name="studentID">
                      <label for="fName">First Name:</label>
                      <input type="text" class="form-control" id="fName" name="studentID">
                      <label for="lName">Last Name:</label>
                      <input type="text" class="form-control" id="lName" name="studentID">
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                  </div>

                </div>
              </div>

                <table cellspacing="0" class="table table-striped" id="usertable" width="100%">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>School ID</th>
                      <th>First Name</th>
                      <th>Last Name</th>
                      <th>Actions</th>
                      <th>Created At</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($users as $user)
                      <tr>
                        <th>{{$tableCounter++}}</th>
                        <td class="studID">{{$user->studentID}}</td>
                        <td class="firstName">{{$user->firstName}}</td>
                        <td class="lastName">{{$user->lastName}}</td>
                        <td>
                        <form method="POST" action="{{url('/usermanagement/'.$user->studentID)}}">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                          <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash fa-fw"></i></button>
                          <button type="button" class="btn btn-edit btn-sm"><i class="fa fa-edit fa-fw"></i></button>
                        </form>
                        </td>
                        <td>{{$user->created_at}}</td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>

                </div>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
  $(document).ready(function() {
    $('#usertable').DataTable({
      responsive: true,
      "scrollX":true
    });


    $('.btn-edit').on('click', function(){

        var studID = $(this).closest("tr").find(".studID").text();
        var firstName = $(this).closest("tr").find(".firstName").text();
        var lastName = $(this).closest("tr").find(".lastName").text();

       $("#modalEdit").modal();
        $("#userID").val(studID);
        $("#fName").val(firstName);
        $("#lName").val(lastName);
        
        
    });
} );
</script>
@endsection
