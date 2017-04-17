@extends('layouts.app')

@section('content')
<link href="css/style2.css" rel="stylesheet">

<!-- Data Tables -->
    <link href="css/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet">
    <link href="css/plugins/dataTables/dataTables.responsive.css" rel="stylesheet">
    <link href="css/plugins/dataTables/dataTables.tableTools.min.css" rel="stylesheet">
<!-- Mainly scripts -->
    <script src="js/jquery-2.1.1.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="js/inspinia.js"></script>
    <!-- Data Tables -->
    <script src="js/plugins/dataTables/jquery.dataTables.js"></script>
    <script src="js/plugins/dataTables/dataTables.bootstrap.js"></script>
    <script src="js/plugins/dataTables/dataTables.responsive.js"></script>
    <script src="js/plugins/dataTables/dataTables.tableTools.min.js"></script>

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

                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalEdit">
                                FlipInY effect
                            </button>
                            <div class="modal inmodal" id="modalEdit" tabindex="-1" role="dialog" aria-hidden="true">
                              <br><br><br><br><br>
                                <div class="modal-dialog">
                                    <div class="modal-content animated flipInY">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                            <h4 class="modal-title">Modal title</h4>
                                            <small class="font-bold">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</small>
                                        </div>
                                        <div class="modal-body">
                                            <label for="userID">User ID:</label>
                                            <input type="text" class="form-control" id="userID" name="studentID">
                                            <label for="fName">First Name:</label>
                                            <input type="text" class="form-control" id="fName" name="studentID">
                                            <label for="lName">Last Name:</label>
                                            <input type="text" class="form-control" id="lName" name="studentID">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary">Save changes</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                  <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Basic Data Tables example with responsive plugin</h5>
                    </div>
                    <div class="ibox-content">

                    <table class="table table-striped table-bordered table-hover" id="usertable">
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
                    <tfoot>
                    <tr>
                      <th>#</th>
                      <th>School ID</th>
                      <th>First Name</th>
                      <th>Last Name</th>
                      <th>Actions</th>
                      <th>Created At</th>
                    </tr>
                  </tfoot>
                    </table>

                    </div>
                </div>


                </div>
            </div>
        </div>
    </div>



<script type="text/javascript">
  $(document).ready(function() {
    $('#usertable').dataTable({
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
