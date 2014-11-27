<?php 
 $pageTitle = "Upload Photo";
 require_once('includes/header.php');?>

        <link href="css/photoUpload.css" rel="stylesheet" type="text/css" />
       
        <script src="js/circle_upload.js"></script>
        
        <div class="container">
        
        <h3>Upload to your Circle</h3>

            <div class="upload_form_cont">
                <form id="upload_form" enctype="multipart/form-data" method="post" action="Circle_Photo_Upload.php">
                  
                        <div><input class="btn-default" type="file" name="File" id="File" onChange="fileSelected();" /></div>
                        
                        <div><input  class="input-group" type="text" name="Commentaaa" id="Commentaaa" placeholder="Write a caption."/></div>
                        <?php
						if (isset($_GET['id'])) {
	$circleID = $mysqli->real_escape_string($_GET['id']);
	
 }
echo '<input type="hidden" name="circleID" id="circleID" value='.$circleID.'>';
						?>
                    
                    <div>
                        <input class="btn-default" type="button" value="Upload" onClick="startUploading()" />
                    </div>
                    <div id="fileinfo">
                        <div class="label label-primary" id="filename"></div>
                        <div class="label label-default" id="filesize"></div>
                        <div class="label label-success" id="filetype"></div>
                        <div class="label label-info" id="filedim"></div>
                    </div>
                    <div class="alert alert-danger" id="error">You should select valid image files only!</div>
                    <div class="alert alert-danger" id="error2">An error occurred while uploading the file</div>
                    <div class="alert alert-danger" id="abort">The upload has been canceled by the user or the browser dropped the connection</div>
                    <div class="alert alert-danger" id="warnsize">Your file is very big. We can't accept it. Please select more small file</div>

                    <div id="progress_info">
                        <div id="progress"></div>
                        <div id="progress_percent">&nbsp;</div>
                        <div class="clear_both"></div>
                        <div>
                            <div id="speed">&nbsp;</div>
                            <div id="remaining">&nbsp;</div>
                            <div id="b_transfered">&nbsp;</div>
                            <div class="clear_both"></div>
                        </div>
                        <div id="upload_response"></div>
                    </div>
                </form>

                <img id="preview" />
            </div>
        </div>

</div>
<?php require('includes/footer.php');?>  