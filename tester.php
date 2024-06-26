<!doctype html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" 
	rel="stylesheet" 
	integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" 
	crossorigin="anonymous"
    >
</head>
<body>
<div class="container">
 
  <div class="d-flex align-items-center" style="margin-top:15%;">
  
    <div class="col-md6" style="padding:10px; border:2px solid black">
      <h2>Test Upload manual</h2>
	  <br>
	<form action="upload_img.php" method="post" enctype="multipart/form-data">
	
	  <div class="form-group">
		<label for="image">Input Image</label>
		<input type="file" name="imageFile" id="imageFile">
	  </div>
	  <br>
	  <input type="submit" value="Upload Image" name="submit" class="btn btn-primary">
	</form>
	</div>
  </div>
</div>
</body>
</html>