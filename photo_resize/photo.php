<!DOCTYPE html>
<html>
   <head>
      <title>Resize</title>
   </head>
   <body>
         <section class="container">
          <center>
               <div class="page-heading">
                  <h3 class="post-title">Upload and Resize Image</h3>
               </div>
                <div class="panel-body">
                  <form action="" method="post" enctype="multipart/form-data">
                    <table><tr><td>
                      <div class="form-group col-md-3">
                        <label class="required"> Enter Width:</label></td><td>
                        <input type="number" name="new_width" required /></td></tr>
                      </div><br><tr><td>
                      <div class="form-group col-md-3">
                        <label class="required"> Enter Height:</label></td><td>
                        <input type="number" name="new_height" required /></td></tr>
                      </div><br><tr><td><br>
                      <div class="form-group col-md-6">
                        <label class="required">Choose Image:</label></td><td><br>
                        <input type="file" name="upload_image" class="custom-file-input" required />
                      </div></td></tr>
                      <div style="text-align: center;">
                      <script id="mNCC" language="javascript">
                        medianet_width = "728";
                        medianet_height = "90";
                        medianet_crid = "655540672";
                        medianet_versionId = "3111299"; 
                      </script>
                                 </div>
                                 </table>
                                 <input type="submit" name="form_submit" class="btn btn-primary" value="Submit"  style="
                                    margin-top: 25px;
                                    border-radius: 20px;
                                    width: 10%;
                                    background-color: #1d91d2;
                                    "/>
                              </form>
                              </center>
                              <?php
                                 function resizeImage($resourceType,$image_width,$image_height,$resizeWidth,$resizeHeight) {
                                     // $resizeWidth = 100;
                                     // $resizeHeight = 100;
                                     $imageLayer = imagecreatetruecolor($resizeWidth,$resizeHeight);
                                     imagecopyresampled($imageLayer,$resourceType,0,0,0,0,$resizeWidth,$resizeHeight, $image_width,$image_height);
                                     return $imageLayer;
                                 }
                                 
                                 if(isset($_POST["form_submit"])) {
                                 	$imageProcess = 0;
                                     if(is_array($_FILES)) {
                                         $new_width = $_POST['new_width'];
                                         $new_height = $_POST['new_height'];
                                         $fileName = $_FILES['upload_image']['tmp_name'];
                                         $sourceProperties = getimagesize($fileName);
                                         $resizeFileName = time();
                                         $uploadPath = "./uploads/";
                                         $fileExt = pathinfo($_FILES['upload_image']['name'], PATHINFO_EXTENSION);
                                         $uploadImageType = $sourceProperties[2];
                                         $sourceImageWidth = $sourceProperties[0];
                                         $sourceImageHeight = $sourceProperties[1];
                                         switch ($uploadImageType) {
                                             case IMAGETYPE_JPEG:
                                                 $resourceType = imagecreatefromjpeg($fileName); 
                                                 $imageLayer = resizeImage($resourceType,$sourceImageWidth,$sourceImageHeight,$new_width,$new_height);
                                                 imagejpeg($imageLayer,$uploadPath."thump_".$resizeFileName.'.'. $fileExt);
                                                 break;
                                 
                                             case IMAGETYPE_GIF:
                                                 $resourceType = imagecreatefromgif($fileName); 
                                                 $imageLayer = resizeImage($resourceType,$sourceImageWidth,$sourceImageHeight,$new_width,$new_height);
                                                 imagegif($imageLayer,$uploadPath."thump_".$resizeFileName.'.'. $fileExt);
                                                 break;
                                 
                                             case IMAGETYPE_PNG:
                                                 $resourceType = imagecreatefrompng($fileName); 
                                                 $imageLayer = resizeImage($resourceType,$sourceImageWidth,$sourceImageHeight,$new_width,$new_height);
                                                 imagepng($imageLayer,$uploadPath."thump_".$resizeFileName.'.'. $fileExt);
                                                 break;
                                 
                                             case IMAGETYPE_JPG:
                                                 $resourceType = imagecreatefrompng($fileName); 
                                                 $imageLayer = resizeImage($resourceType,$sourceImageWidth,$sourceImageHeight,$new_width,$new_height);
                                                 imagepng($imageLayer,$uploadPath."thump_".$resizeFileName.'.'. $fileExt);
                                                 break;
                                 
                                             default:
                                                 $imageProcess = 0;
                                                 break;
                                         }
                                         move_uploaded_file($fileName, $uploadPath. $resizeFileName. ".". $fileExt);
                                         $imageProcess = 1;
                                     }
                                 
                                 	if($imageProcess == 1){
                                 	?>
                                  <center><br>
                              <div class="alert icon-alert with-arrow alert-success form-alter" role="alert">
                                 <i class="fa fa-fw fa-check-circle"></i>
                                 <strong> Success !</strong> <span class="success-message">Image Resized Successfully </span>
                              </div></center>
                              <hr>
                              <table style="width: 100%;"><tr><td>
                              <div class="row">
                                 <div class="col-md-4">
                                    <img class="img-rounded img-responsive" src="<?php echo $uploadPath."thump_".$resizeFileName.'.'. $fileExt; ?>" width="<?php echo $new_width; ?>" height="<?php echo $new_height; ?>" >
                                    <h4><b>Resized Image</b></h4>
                                    <a href="<?php echo $uploadPath."thump_".$resizeFileName.'.'. $fileExt; ?>" download class="btn btn-danger"><i class="fa fa-download"></i> Download </a href="">
                                 </div></td><td>
                                 <div class="col-md-8">
                                    <img class="img-rounded img-responsive" src="<?php echo $uploadPath.$resizeFileName.'.'. $fileExt; ?>" >
                                    <h4><b>Original Image</b></h4>
                                 </div></td></tr>
                              </div></table>
                              <?php
                                 }else{
                                 ?>
                              <div class="alert icon-alert with-arrow alert-danger form-alter" role="alert">
                                 <i class="fa fa-fw fa-times-circle"></i>
                                 <strong> Note !</strong> <span class="warning-message">Invalid Image </span>
                              </div>
                              <?php
                                 }
                                 $imageProcess = 0;
                                 }
                                 ?>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </section>
    </body>
</html>