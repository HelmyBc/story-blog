<?php
require_once('config.php');
session_start();
if (!isset($_SESSION["username"])) {
    header("location:index.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Feed</title>
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
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
                    <h1>My Stories</h1>
                </div>
                <div>
                    <div class="card">

                        <div class="card-table">
                            <h2>My pending stories</h2>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Title</th>
                                        <th>Summary</th>
                                        <th>Category</th>
                                        <th>Author</th>
                                        <th>file</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $current_username = $_SESSION["username"];
                                    $sql4 = "SELECT * FROM stories WHERE is_approuved=0 AND author='$current_username'";
                                    $result = $conn->query($sql4);
                                    if (!$result) {
                                        die("invalid query: " . $conn->error);
                                    }
                                    //read data of each row
                                    while ($row = $result->fetch_assoc()) {
                                        $file = "uploads/" . $row['file'];
                                        echo "<tr>
                <td>" . $row['id'] . "</td>
                <td>" . $row['title'] . "</td>
                <td>" . $row['summary'] . "</td>
                <td>" . $row['category'] . "</td>
                <td>" . $row['author'] . "</td>
                <td>" . $row['file'] . "</td>
                <td>
                    <a href='$file'>Download</a>
                    <a name='approuve' href='deletemine.php?file=" . $row['id'] . "'>Delete</a>
                </td>
            </tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>

                    </div>
                    <div class="card">

                        <div class="card-table">
                            <h2>My published stories</h2>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Title</th>
                                        <th>Summary</th>
                                        <th>Category</th>
                                        <th>Author</th>
                                        <th>file</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $current_username = $_SESSION["username"];
                                    $sql4 = "SELECT * FROM stories WHERE is_approuved=1 AND author='$current_username'";
                                    $result = $conn->query($sql4);
                                    if (!$result) {
                                        die("invalid query: " . $conn->error);
                                    }
                                    //read data of each row
                                    while ($row = $result->fetch_assoc()) {
                                        $file = "uploads/" . $row['file'];
                                        echo "<tr>
            <td>" . $row['id'] . "</td>
            <td>" . $row['title'] . "</td>
            <td>" . $row['summary'] . "</td>
            <td>" . $row['category'] . "</td>
            <td>" . $row['author'] . "</td>
            <td>" . $row['file'] . "</td>
            <td>
                <a href='$file'>Download</a>
                <a name='approuve' href='deletemine.php?file=" . $row['id'] . "'>Delete</a>
            </tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </section>
    </main>
</body>

</html>