<?php
include('config.php');
require_once('config.php');
session_start();
if (!isset($_SESSION["username"])) {
    header("location:index.php");
}

if (isset($_POST['createstory'])) {

    $title = $_POST["title"];
    $summary = $_POST["summary"];
    $category = $_POST["categories"];
    $author =  $_SESSION["username"];

    $file = rand(1000, 100000) . "-" . $_FILES['file']['name'];
    $file_loc = $_FILES['file']['tmp_name'];
    $file_size = $_FILES['file']['size'];
    $file_type = $_FILES['file']['type'];
    $folder = "uploads/";

    /* new file size in KB */
    $new_size = $file_size / 1024;
    /* new file size in KB */

    /* make file name in lower case */
    $new_file_name = strtolower($file);
    /* make file name in lower case */

    $final_file = str_replace(' ', '-', $new_file_name);

    if (move_uploaded_file($file_loc, $folder . $final_file)) {
        $sql2 = " INSERT INTO stories (title, summary, category,author,file ) VALUES('$title','$summary','$category','$author','$final_file')";
        mysqli_query($conn, $sql2);
        echo '<script> alert("File sucessfully uploaded")</script>';
    } else {
        echo '<script> alert("An error has occured")</script>';
    }
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Feed</title>
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="./stylefeed.css" />
</head>

<body style="background-image: url('library.jpg'); background-repeat: no-repeat;background-size: cover;">
    <main>
        <section class="glass">
            <div class="dashboard">
                <div class="user">
                    <img src="default_profile_image.png" alt="" style="height: 90px; width:90px;border-radius:50%;" />
                    <h3> <?php echo $_SESSION['username']; ?></h3>
                    <p>User type : Author</p>
                    <a href="logout.php">Logout</a>
                </div>
                <div class="links">
                    <div class="link">
                        <h2> <a class="link_a" href="feed.php" style="text-decoration: none;"> Discover Stories </a></h2>
                    </div>
                    <div class="link">
                        <h2> <a class="link_a" href="addpost.php" style="text-decoration: none;"> Publish a story </a></h2>
                    </div>
                    <div class="link">
                        <h2> <a class="link_a" href="mystories.php" style="text-decoration: none;"> My stories </a></h2>
                    </div>
                </div>
                <div class="pro">
                    <h2>Become a gold member for free stories.</h2>
                    <img src="vip.jpg" style="height: 60px; width:60px;border-radius:50%;" alt="" />
                </div>
            </div>
            <div class="games">
                <div class="status">
                    <h1>Publish a story</h1>
                </div>
                <div>
                    <div class="card">

                        <div class="card-info">
                            <h2>Request publishing a new story</h2>
                            <form action="#" method="POST" enctype="multipart/form-data">
                                <br>
                                <input type="text" name="title" placeholder="title" required />
                                <input type="text" name="summary" placeholder="summary" required />
                                <label for="categories">Choose a category:</label>
                                <br>
                                <select name="categories" id="categories">
                                    <option value="Action">Action</option>
                                    <option value="Drama">Drama</option>
                                    <option value="Comedy">Comedy</option>
                                    <option value="Sci-Fi">SCi-Fi</option>
                                    <option value="Thriller">Thriller</option>
                                    <option value="Romance">Romance</option>
                                </select>
                                <br>
                                <label>Upload the story file</label>
                                <br>
                                <input type="file" name="file" />
                                <br>
                                <button type="submit" name="createstory">Publish</button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </section>
    </main>
</body>

</html>