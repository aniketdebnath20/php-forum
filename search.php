<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Discuss-coding Forum</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>

    <?php include "_content/dbconnect.php"; ?>
    <?php include "_content/header.php"; ?>




    <div class="container my-5 mt-4 col-8">
        <h2 class="mb-4">Search result <em class="text-danger"> "<?php echo $_GET['search'] ?>" </em> </h2>


        <?php
        $noResult = true;
        $query = $_GET['search'];
        $sql = "SELECT * FROM threads WHERE MATCH(thread_title, thread_desc) AGAINST ('$query')";
        $result = mysqli_query($con, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $title = $row['thread_title'];
            $desc = $row['thread_desc'];
            $thread_id = $row['thread_id'];
            $url = "thread.php?threadid=" . $thread_id;
            $noResult = false;

            echo '<div class="result">
            <h4 class="mb-0"><a href="' . $url . '" class="text-decoration-none"> ' . $title . ' </a></h4>
            <p>' . $desc . '</p>
       </div>';
        }
        if ($noResult) {
            echo ' <div class="container  bg-black text-white px-4 py-5 my-5 ">
                         <div class="jumbotron">
                               <h1>No result Found</h1>
                               <p>  Be the first person to ask question  </p>
                         </div>
                    </div>';
        }

        ?>

    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
        </script>
</body>

</html>