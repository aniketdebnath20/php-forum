<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>

    <?php include "_content/dbconnect.php"; ?>
    <?php include "_content/header.php" ?>

    <?php
    $id = $_GET['threadid'];
    $sql = "SELECT * FROM `threads` WHERE thread_id= $id";
    $result = mysqli_query($con, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $title = $row['thread_title'];
        $desc = $row['thread_desc'];
        $thread_user_id = $row['thread_user_id'];

        $sql2 = "SELECT user_email FROM `users` WHERE srno='$thread_user_id'";
        $result2 = mysqli_query($con, $sql2);
        $row2 = mysqli_fetch_assoc($result2);
        $posted_by = $row2['user_email'];
    }



    ?>




    <?php

    $show_alert = false;
    $method = $_SERVER['REQUEST_METHOD'];
    if ($method == 'POST') {
        $comment = $_POST['comment'];
        $comment = str_replace("<", "&lt;", $comment);
        $comment = str_replace(">", "&gt;", $comment);
        $srno = $_POST['srno'];
        $sql = "INSERT INTO `comment` (`comment_content`, `thread_id`, `comment_by`, `comment_time`) VALUES ('$comment', '$id', '$srno', current_timestamp())";
        $result = mysqli_query($con, $sql);
        $show_alert = true;

        if ($show_alert) {
            echo " <div class='alert alert-success alert-dismissible fade show' role='alert'>
        <strong> Success!</strong> Your Comment has been added!
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
    </div>";
        }


    }

    ?>



    <div class="container bg-black text-white px-4 py-4 my-5 ">
        <div class="jumbotron">
            <h1> <?php echo $title; ?> </h1>
            <p> <?php echo $desc; ?> </p>
        </div>
        <p>This is some text.</p>
        <hr>
        <p>This is another text.<?php echo $posted_by; ?> </p>
    </div>


    <?php

    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == "ture") {

        echo '
 <div class="container">
        <h2 class="text-center"> Post a Comment </h2>
        <div class="container col-md-7">
            <form action="' . $_SERVER['REQUEST_URI'] . '" method="post">
                <div class="form-group mb-4">
                    <label for="comment" class="form-label"> Type a Comment </label>
                    <textarea class="form-control" name="comment" id="comment" rows="3"></textarea>
                        <input type="hidden" name="srno" value="' . $_SESSION["srno"] . '">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div> ';

    } else {
        echo '
    <div class="container my-0 mb-4">
      <h2 class="text-center"> Post a Comment </h2>
    <h5 class="text-center">You are not logged in. please logged in to able to post comment </h5>
    </div> ';
    }


    ?>







    <div class="container pt-4">
        <h3> Discussion </h3>
        <?php
        $id = $_GET['threadid'];
        $sql = "SELECT * FROM `comment` WHERE thread_id = $id";
        $result = mysqli_query($con, $sql);
        $noResult = true;
        while ($row = mysqli_fetch_assoc($result)) {
            $noResult = false;
            $id = $row['comment_id'];
            $content = $row['comment_content'];
            $comment_time = $row['comment_time'];

            $thread_user_id = $row['comment_by'];
            $sql2 = "SELECT user_email FROM `users` WHERE srno='$thread_user_id'";
            $result2 = mysqli_query($con, $sql2);
            $row2 = mysqli_fetch_assoc($result2);


            echo '  <div class="media my-3 container pb-1">
           <img src="img_avatar1.png" class="media-object" style="width:60px">
           <div class="media-body">
           <p class="font-weight-bold my-o"> ' . $row2['user_email'] . ' at ' . $comment_time . ' </p>
            <p>' . $content . '</p>
           </div>
       </div>
   </div> ';

        }
        ;

        if ($noResult) {
            echo '  
                <div class="container  bg-black text-white px-4 py-5 my-5 ">
                  <div class="jumbotron">
                     <h1>No result Found</h1>
                     <p>  Be the first person to ask question  </p>
                  </div>
                </div> ';
        }

        ?>



    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
        </script>
</body>

</html>


<!-- https://unsplash.com/photos/close-up-of-a-woman-hacker-hands-at-keyboard-computer-in-the-dark-room-at-night-cyberwar-concept-high-angle-view-YkibINt3MXo
https://plus.unsplash.com/premium_photo-1663100722417-6e36673fe0ed?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MXx8Y29kaW5nfGVufDB8fDB8fHww -->