@extends('layout')
    
@section('content')
<main class="login-form">
  <div class="cotainer">
      <div class="row justify-content-center">
          <div class="col-md-8">
              <div class="card">
                  <div class="card-header">Add Employee</div>
                  <div class="card-body">
    
                      <form action="javascript:void(0)" method="POST" id="handleAjax">
  
                          @csrf
 
                          <div id="errors-list"></div>
 
                          <div class="form-group row">
                              <label for="name" class="col-md-4 col-form-label text-md-right">Employee Name</label>
                              <div class="col-md-6">
                                  <input type="text" id="name" class="form-control" name="name" required autofocus>
                                  @if ($errors->has('name'))
                                      <span class="text-danger">{{ $errors->first('name') }}</span>
                                  @endif
                              </div>
                          </div>
    
                          <div class="form-group row">
                              <label for="email_address" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>
                              <div class="col-md-6">
                                  <input type="text" id="email_address" class="form-control" name="email" required autofocus>
                                  @if ($errors->has('email'))
                                      <span class="text-danger">{{ $errors->first('email') }}</span>
                                  @endif
                              </div>
                          </div>
    
                          <div class="form-group row">
                              <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>
                              <div class="col-md-6">
                                  <input type="password" id="password" class="form-control" name="password" required>
                                  @if ($errors->has('password'))
                                      <span class="text-danger">{{ $errors->first('password') }}</span>
                                  @endif
                              </div>
                          </div>
  
                          <div class="form-group row">
                              <label for="confirm_password" class="col-md-4 col-form-label text-md-right">Confirm Password</label>
                              <div class="col-md-6">
                                  <input type="password" id="confirm_password" class="form-control" name="confirm_password" required>
                                  @if ($errors->has('confirm_password'))
                                      <span class="text-danger">{{ $errors->first('confirm_password') }}</span>
                                  @endif
                              </div>
                          </div>

                          <div class="col-md-6 offset-md-4">
                              <button type="submit" class="btn btn-primary">
                                  Submit
                              </button>
                          </div>
                      </form>
                          
                  </div>
              </div>
          </div>
      </div>
  </div>
</main>
  
<script type="text/javascript">
  
  $(function() {
      $(document).on("submit", "#handleAjax", function() {
          var e = this;
  
          $(this).find("[type='submit']").html("Submiting");
  
          $.ajax({
              url: 'http://127.0.0.1:8000/submitemploye',
              data: $(this).serialize(),
              type: "POST",
              dataType: 'json',
              success: function (data) {
  
                $(e).find("[type='submit']").html("Submit");
                  
                if (data.status) {
                    $(".alert").remove();
                    $("#errors-list").append("<div class='alert alert-success'>" + data.msg + "</div>");
                    $('#handleAjax').trigger("reset");

                }else{
  
                    $(".alert").remove();
                    $.each(data.errors, function (key, val) {
                        $("#errors-list").append("<div class='alert alert-danger'>" + val + "</div>");
                    });
                }
             
              }
          });
  
          return false;
      });
  
    });
  
</script>
@endsection