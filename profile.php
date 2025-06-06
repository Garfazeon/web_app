<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Derevyankin profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <nav class="navbar navbar-dark bg-dark p-3">
        <div class="container-fluid">
          <a href="#" class="navbar-brand d-flex align-items-center">
                <img src="IgJR6fyici024XXZ60Ow.webp" alt="логотип сайта" class="me-2">
                <span class="text-light">History</span>
          </a>
          <?php if (isset($_COOKIE['User'])): ?>
                <form action="/logout.php" method="POST" class="d-flex">
                    <button class="btn btn-outline-danger" type="submit">Logout</button>
                </form>
            <?php endif; ?>
        </div>
    </nav>
    <div class="container mt-5">
        <div class="story-container">
            <div class="story-text">
                <p>Well, Prince, so Genoa and Lucca are now just family estates of the Buonapartes. But I warn you, if you don’t tell me that this means war, if you still try to</p>
            </div>
            <img src="hack1.webp" alt="hack1" class="hacker-img">
        </div>
        <div class="text-center mt-4">
            <button id="toggleButton" class="btn btn-primary">Open</button>
        </div>
        <div id="extraImage" class="mt-3 text-center" style="display: none;">
            <img src="hack2.webp" alt="hack2" class="hacker-img">
        </div>   
        <div class="mt-5">
          <h2 class="text-center mb-4">Add New Post <?php $username1 = $_COOKIE['User']; echo "$username1"; ?></h2>
          <form action="profile.php" id="postForm" class="d-flex flex-column gap-3" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label class="form-label" for="postTitle">Post Title</label>
                <input type="text" name="postTitle" class="form-control hacker-input" id="postTitle" placeholder="Enter post Title" required>
            </div>
            <div class="form-group">
                <label class="form-label" for="postContent">Post Content</label>
                <textarea name="postContent" class="form-control hacker-input" id="postContent" placeholder="Enter post Content" rows="5" required></textarea>
            </div>
            <div class="form-group">
                <label class="form-label" for="file">Upload file</label>
                <input type="file" name="file" class="form-control hacker-input" id="file">
            </div>
            <button class="btn btn-primary" type="submit" name="submit">Save Post</button>
          </form>
        </div>
    </div>
    <script src="js\script.js"></script>
</body>
</html>

<?php
    if (!isset($_COOKIE['User'])) {
        header('Location: /login.php');
        exit();
    }
    require_once('db.php');
    $link=mysqli_connect('127.0.0.1','root','123','first');

    if (isset($_POST['submit'])) {
        $title = mysqli_real_escape_string($link,$_POST['postTitle']);
        $main_text = mysqli_real_escape_string($link,$_POST['postContent']);

        if (!$title || !$main_text) die("no data post");
        $title= htmlspecialchars($title, ENT_QUOTES,"UTF-8");
        $main_text = htmlspecialchars($main_text, ENT_QUOTES,"UTF-8");
        $sql="INSERT INTO posts (title, main_text) VALUES ('$title','$main_text')";
        if (!mysqli_query($link,$sql)) die("error insert data post");

        if (!empty($_FILES["file"]))
        {
            $errors = [];             
            $allowedTypes=['image/gif', 'image/jpeg', 'image/jpg', 'image/png'];
            $maxFileSize = 1024000;
            if($_FILES['file']['error']!== UPLOAD_ERR_OK) {
                $errors [] = $_FILES['file']['error']; 
            }
            $realFileSize = filesize($_FILES['file']['tmp_name']);
            if($realFileSize>$maxFileSize){
                $errors [] = $_FILES['file']['error'];
            }
            $fileType = finfo_file(finfo_open(FILEINFO_MIME_TYPE), $_FILES['file']['tmp_name']);
            if(!in_array($fileType, $allowedTypes)) {
                $errors [] = $_FILES['file']['error'];
            }
        }
        if (empty($errors)) {
            $tempPath = $_FILES['file']['tmp_name'];
            $destinationPath = 'upload/'. uniqid() .'_'. basename($_FILES['file']['name']);
            if(move_uploaded_file($tempPath, $destinationPath)){
                echo 'Good upload ' . $destinationPath;
            } else {
                $errors [] = 'Error upload file';
            }
        } else {
            foreach ($errors as $error) {
                echo $error . '<br>';
            }
        }
    }
?>