<form class="resume_form">
                 <div class="field">
                    <input type="text" name="name" placeholder="Full Name" id="fname" class="form-control"> 
                 </div><!-- field -->
                 <div class="field">
                     <input type="email" name="email" placeholder="Emai Id" id="emailid" class="form-control"> 
                 </div><!-- field -->
                 <div class="field">
                   <input type="text" name="phone" placeholder="Contact Number" id="cnumber" maxlength="16" onkeypress="return onlyNumberKey(event)" class="form-control"> 
                 </div><!-- field -->
                  <div class="field">
                   <input type="text" name="position-designation" placeholder="Position/Designation" id="design" class="form-control"> 
                 </div><!-- field -->
                  <div class="field">
                   <input type="text" name="skills" placeholder="Skills" id="skill" class="form-control"> 
                 </div><!-- field -->
                 <div class="field">
                   <input type="file" name="resume" id="resume"  class="form-control"> 
                   <small class="re-info">Only 200kb file Allow</small>
                 </div><!-- field -->
                 <div class="field mb-0 pt-4">
                    <button class="w-100" id="resume_submit">Submit</button>  
                 </div><!-- field -->
                 </form>

<script>
$(document).on('click','.resume_form #resume_submit',function(e){
      e.preventDefault();
    var fname = $('#fname').val(),
        emailid = $('#emailid').val(),
        cnumber = $('#cnumber').val(),
        design = $('#design').val(),
        skill = $('#skill').val();
        resume = $('#resume').val();

        if(fname == ''){
          $('#fname').removeClass('is-invalid');
          $('#fname').addClass('is-invalid');
        } else {
          $('#fname').removeClass('is-invalid');
        }
        if(emailid == ''){
          $('#emailid').removeClass('is-invalid');
          $('#emailid').addClass('is-invalid');
        } else {
          $('#emailid').removeClass('is-invalid');
        }

        if(emailid != ''){
          var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
          if(!regex.test(emailid)) {
            $('#emailid').removeClass('is-invalid');
             $('#emailid').addClass('is-invalid');
           }else{
              $('#emailid').removeClass('is-invalid');
           }
        }

        if(cnumber == ''){
          $('#cnumber').removeClass('is-invalid');
          $('#cnumber').addClass('is-invalid');
        } else {
          $('#cnumber').removeClass('is-invalid');
        }

        if(design == ''){
          $('#design').removeClass('is-invalid');
          $('#design').addClass('is-invalid');
        } else {
          $('#design').removeClass('is-invalid');
        }

        if(skill == ''){
          $('#skill').removeClass('is-invalid');
          $('#skill').addClass('is-invalid');
        } else {
          $('#skill').removeClass('is-invalid');
        }

        if(resume == ''){
          $('#resume').removeClass('is-invalid');
          $('#resume').addClass('is-invalid');
        } else {
          $('#resume').removeClass('is-invalid');
        }
        var maxSizeKB = 200; //Size in KB
        var maxSize = maxSizeKB * 1024; //File size is returned in Bytes
        var file = $('#resume')[0].files[0]; 

        if(resume != ''){
          // validate file size
          if(file.size > maxSize ){
            $('#resume').removeClass('is-invalid');
            $('#resume').addClass('is-invalid');
            $('.re-info').remove();
            $('.re-error').remove();
            $('#resume').after('<small class="re-error">Max file size exceeded</small>')
          } 
          else{
            $('.re-error').remove();
          }
          // validate file type
          if($.inArray(file.type, ["text/plain","application/pdf",'application/vnd.openxmlformats-officedocument.wordprocessingml.document']) == -1){
          $('#resume').removeClass('is-invalid');
            $('#resume').addClass('is-invalid');
            $('.re-info').remove();
            $('.re-error').remove();
            $('#resume').after('<small class="re-error">Only Text/Docx/PDF File Allowed</small>');
          }
          else{
            $('.re-error').remove();
          }
        }
        var formdata = new FormData();
            formdata.append("fname",fname);
            formdata.append("emailid",emailid);
            formdata.append("cnumber",cnumber);
            formdata.append("design",design);
            formdata.append("skill",skill);
            formdata.append("file",file);
            
      if(fname != '' && emailid != '' && cnumber != '' && design != '' && skill != '' && resume != ''){

        $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': "{{ csrf_token() }}"
          }
        });
        $.ajax({  
            url: "{{url('resume-submit')}}",
            type: "POST",
            contentType: false,
            processData: false,
            data: formdata,
            success: function (result) {
              $(".resume_form")[0].reset();
              $('.resume_form').before('<span class="form_success">Your Resume Submited Successfully.</span>');
              setTimeout(function(){
                $('.form_success').remove();
              }, 3000);
            }  
          });
      }


    });
    </script>
