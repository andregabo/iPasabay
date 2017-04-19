@extends('layouts.app')

@section('content')

<div class="row">
  <div class="col-xs-12">
    <!-- Modal -->
    <div class="modal fade" id="modalPanel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">User Details</h4>
          </div>
          <div class="modal-body">
            <form id="formModify" action="{{url('/profile/modify')}}" method="post"> <?php // FIXME: Do backend for this ?>
              {{ csrf_field() }}
              {{method_field('PATCH')}}
              <div class="form-group">
                  <div class="row">
                  <label class="col-md-3 control-label">Login:</label>
                  <div class="col-md-9">
                    <input type="text" class="form-control" placeholder="" id="txtLogin" name="studentID">
                  </div>
                </div>
                <div class="row">
                <label class="col-md-3 control-label">First Name:</label>
                <div class="col-md-9">
                  <input type="text" class="form-control" placeholder="" id="txtFirstName" name="firstName">
                </div>
              </div>
              <div class="row">
              <label class="col-md-3 control-label">Last Name:</label>
              <div class="col-md-9">
                <input type="text" class="form-control" placeholder="" id="txtLastName" name="lastName">
              </div>
            </div>
              </div>
          </div>
        </form>
          <div class="modal-footer">
            <!-- <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button> -->
            <button type="button" class="btn btn-sm btn-warning" id="btnModify">Modify</button>
            <button type="button" class="btn btn-sm btn-success" form="formModify" value="submit">Save changes</button>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
    <div class="col-sm-6">
    <button type="button" class="btn btn-sm btn-warning" id="btnModal">User Details</button>
  </div>
<div class="col-sm-6">
    <form enctype="multipart/form-data" action="{{asset('scripts/imageUpload.php')}}" method="post">
            <div class="col-md-6"></div>
            <div id="image-preview">
              <label for="image-upload" id="image-label">Profile Image</label>
              <input type="hidden" name="studentID" value="{{Auth::User()->studentID}}"/>
              <input type="file" name="image" id="image-upload" />
              <hr>
              <button type="submit" class="btn btn-w-m btn-warning">Change Picture</button>
              <br><br>
              <div class="well"><small>Click Change Picture without selecting an image to <strong>revert to default image</strong>.</small></div>
          </div>
    </form>
  </div>
</div>
</div>
</div>


<script>
$('#btnModal').on('click',function(){
    $('#modalPanel').modal();
    $('#txtLogin').val({{Auth::User()->studentID}});
    $('#txtLogin').prop('readonly', true);
    $('#txtFirstName').val("{{Auth::User()->firstName}}");
    $('#txtFirstName').prop('readonly', true);
    $('#txtLastName').val("{{Auth::User()->lastName}}");
    $('#txtLastName').prop('readonly', true);
});

$('#btnModify').on('click', function(){
      // $('#txtLogin').prop('readonly', false);
      $('#txtFirstName').prop('readonly', false);
      $('#txtLastName').prop('readonly', false);

    });

  $('#item').croppie(opts);
  // call a method via jquery
  $('#item').croppie(method, args);
</script>
@endsection
