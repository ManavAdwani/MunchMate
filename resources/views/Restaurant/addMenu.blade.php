<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add Menu - MunchMate</title>
    <link rel="stylesheet" href="{{asset('css/addMenu.css')}}">
    <style>
        .title,
        .subTitle {
            display: flex;
            justify-content: center;
            align-items: center;
        }
    </style>
    <meta charset="utf-8">
    <link rel="shortcut icon" href="/assets/favicon.ico">
    <link rel="stylesheet" href="./src/main.css">
</head>

<body>
    @include('navbar.RestaurantNav');
    <br><br><br><br>
    <div class="container mt-5">
        <div class="title">
            <h3>Add Restaurant Menu</h3>
        </div>
        <div class="subTitle">
            <p>Show all your awesome dishes to users !</p>
        </div>

    </div>
    <div class="container">
        <form action="{{route('saveMenu')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="drop-zone" style="margin-left: 80px">
                <span class="drop-zone__prompt">Drop file here or click to upload</span>
                <input type="file" name="myFile" class="drop-zone__input">
            </div>
            <div class="row it">
                <div class="col-sm-offset-1 col-sm-10" id="one">
                    <!--row-->
                    <div id="uploader">
                        <div class="row uploadDoc">
                            <div class="col-sm-3">
                                <div class="docErr">Please upload valid file</div>
                                <!--error-->
                                <div class="fileUpload btn btn-orange">
                                    <img src="{{asset('logo/image-gallery.png')}}" class="icon">
                                    <span class="upl" id="upload">Upload Image</span>
                                    <input type="file" name="menuPic[]" class="upload up" id="up" onchange="readURL(this);" />
                                </div><!-- btn-orange -->
                            </div><!-- col-3 -->
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="name[]" placeholder="Dish Name">
                                <input type="text" class="form-control" name="desc[]" placeholder="Description">
                                <input type="number" class="form-control" name="price[]" placeholder="Dish Price">
                            </div>
                            <!--col-8-->
                            <div class="col-sm-1"><a class="btn-check"><i class="fa fa-times"></i></a></div>
                            <!-- col-1 -->
                        </div>
                        <!--row-->
                    </div>


                    <!--uploader-->
                    <div class="text-center">
                        <a class="btn btn-new"><i class="fa fa-plus"></i> Add new</a>
                        <button class="btn btn-primary">Submit</button>
                    </div>
                </div>
        </form>
        <!--one-->
    </div><!-- row -->
    </div>
</body>
<script>
    var fileTypes = ['pdf', 'docx', 'rtf', 'jpg', 'jpeg', 'png', 'txt', 'heic'];  //acceptable file types
function readURL(input) {
    if (input.files && input.files[0]) {
        var extension = input.files[0].name.split('.').pop().toLowerCase(),  //file extension from input file
            isSuccess = fileTypes.indexOf(extension) > -1;  //is extension in acceptable types

        if (isSuccess) { //yes
            var reader = new FileReader();

            reader.readAsDataURL(input.files[0]);
        }
        else {
        		//console.log('here=>'+$(input).closest('.uploadDoc').find(".docErr").length);
            $(input).closest('.uploadDoc').find(".docErr").fadeIn();
            setTimeout(function() {
				   	$('.docErr').fadeOut('slow');
					}, 9000);
        }
    }
}
$(document).ready(function(){
   
   $(document).on('change','.up', function(){
   	var id = $(this).attr('id'); /* gets the filepath and filename from the input */
	   var profilePicValue = $(this).val();
	   var fileNameStart = profilePicValue.lastIndexOf('\\'); /* finds the end of the filepath */
	   profilePicValue = profilePicValue.substr(fileNameStart + 1).substring(0,20); /* isolates the filename */
	   //var profilePicLabelText = $(".upl"); /* finds the label text */
	   if (profilePicValue != '') {
	   	//console.log($(this).closest('.fileUpload').find('.upl').length);
	      $(this).closest('.fileUpload').find('.upl').html(profilePicValue); /* changes the label text */
	   }
   });

   $(".btn-new").on('click',function(){
        $("#uploader").append('<div class="row uploadDoc"><div class="col-sm-3"><div class="docErr">Please upload valid file</div><!--error--><div class="fileUpload btn btn-orange">  <img src="{{asset("logo/image-gallery.png")}}" class="icon"><span class="upl" id="upload">Upload Image</span><input type="file" class="upload up" id="up" onchange="readURL(this);" /></div></div><div class="col-sm-8"> <input type="text" class="form-control" name="name[]" placeholder="Dish Name"><input type="text" class="form-control" name="desc[]" placeholder="Description"><input type="number" class="form-control" name="price[]" placeholder="Dish Price"></div><div class="col-sm-1"><a class="btn-check"><i class="fa fa-times"></i></a></div></div>');
   });
    
   $(document).on("click", "a.btn-check" , function() {
     if($(".uploadDoc").length>1){
        $(this).closest(".uploadDoc").remove();
      }else{
        alert("You have to upload at least one document.");
      } 
   });
});
</script>

<script>
    document.querySelectorAll(".drop-zone__input").forEach((inputElement) => {
  const dropZoneElement = inputElement.closest(".drop-zone");

  dropZoneElement.addEventListener("click", (e) => {
    inputElement.click();
  });

  inputElement.addEventListener("change", (e) => {
    if (inputElement.files.length) {
      updateThumbnail(dropZoneElement, inputElement.files[0]);
    }
  });

  dropZoneElement.addEventListener("dragover", (e) => {
    e.preventDefault();
    dropZoneElement.classList.add("drop-zone--over");
  });

  ["dragleave", "dragend"].forEach((type) => {
    dropZoneElement.addEventListener(type, (e) => {
      dropZoneElement.classList.remove("drop-zone--over");
    });
  });

  dropZoneElement.addEventListener("drop", (e) => {
    e.preventDefault();

    if (e.dataTransfer.files.length) {
      inputElement.files = e.dataTransfer.files;
      updateThumbnail(dropZoneElement, e.dataTransfer.files[0]);
    }

    dropZoneElement.classList.remove("drop-zone--over");
  });
});

/**
 * Updates the thumbnail on a drop zone element.
 *
 * @param {HTMLElement} dropZoneElement
 * @param {File} file
 */
function updateThumbnail(dropZoneElement, file) {
  let thumbnailElement = dropZoneElement.querySelector(".drop-zone__thumb");

  // First time - remove the prompt
  if (dropZoneElement.querySelector(".drop-zone__prompt")) {
    dropZoneElement.querySelector(".drop-zone__prompt").remove();
  }

  // First time - there is no thumbnail element, so lets create it
  if (!thumbnailElement) {
    thumbnailElement = document.createElement("div");
    thumbnailElement.classList.add("drop-zone__thumb");
    dropZoneElement.appendChild(thumbnailElement);
  }

  thumbnailElement.dataset.label = file.name;

  // Show thumbnail for image files
  if (file.type.startsWith("image/")) {
    const reader = new FileReader();

    reader.readAsDataURL(file);
    reader.onload = () => {
      thumbnailElement.style.backgroundImage = `url('${reader.result}')`;
    };
  } else {
    thumbnailElement.style.backgroundImage = null;
  }
}

</script>

</html>