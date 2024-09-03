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


    <div id="carouselExample" class="carousel slide">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="..." class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="..." class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="..." class="d-block w-100" alt="...">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>


    <div class="container">
        <h3 class="text-center my-3">Discuss-Browse Category</h3>
        <div class="row">
            <!-- fetch all the category -->
            <?php

            $sql = "SELECT * FROM `category`";
            $result = mysqli_query($con, $sql);
            while ($row = mysqli_fetch_assoc($result)) {
                $id = $row['category_id'];
                $category_name = $row['category_name'];
                $category_description = $row['category_description'];

                echo '<div class="col-md-4 my-2">
              <div class="card" style="width:16rem;">
              <img src="https://unsplash.com/photos/close-up-of-a-woman-hacker-hands-at-keyboard-computer-in-the-dark-room-at-night-cyberwar-concept-high-angle-view-YkibINt3MXo" alt="">
                  <div class="card-body">
                    <h5 class="card-title"><a href="threadlits.php?getid=' . $id . '">' . $category_name . '</a></h5>
                    <p class="card-text"> ' . substr($category_description, 0, 90) . ' ... </p>
                    <a href="threadlits.php?getid=' . $id . '" class="btn btn-primary">View Thread</a>
                  </div>
               </div>
            </div> ';
            }
      
            ?>

        </div>
    </div>


    https://github.com/aniketdebnath20/php-forum.git

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>




