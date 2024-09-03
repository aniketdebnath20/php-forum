<?php
session_start();

echo '

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid ">
        <a class="navbar-brand" href="index.php">Discuss_code</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button> 

       <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link " aria-current="page" href="index.php">Home</a>
                </li> 
                <li class="nav-item">
                    <a class="nav-link" href="about.php">About</a>
                </li> 

                   <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Category
            </a>
            <ul class="dropdown-menu">';

$sql = "SELECT category_name, category_id FROM `category`";
$result = mysqli_query($con, $sql);
while ($row = mysqli_fetch_assoc($result)) {
    echo ' <li><a class="dropdown-item" href="threadlits.php?getid=' . $row['category_id'] . '">' . $row['category_name'] . '</a></li> ';
}
;

echo '            
             
            </ul>
          </li> 

                <li class="nav-item">
                    <a class="nav-link" href="contact.php">Contact</a>
                </li>
            </ul> ';



// echo' 

// <input class="form-control me-2 w-25" type="search" placeholder="Search" aria-label="Search">
//     <button class="btn btn-outline-success" type="submit">Search</button>';



if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    echo '  
<form  method="get" action="search.php"  style=display:flex;width:400px;>
<input class="form-control me-2" type="search" name="search" placeholder="Search" aria-label="Search">
<button class="btn btn-success me-3" type="submit">Search</button>
</form>
    <p class="text-light m-0">   Welcome  ' . $_SESSION['useremail'] . '  </p>    
    <a role="button" href="_content/logout.php"  class="btn btn-outline-success px-4 mx-3"> Logout </a>

    ';
} else {
    echo ' 
               
            <input class="form-control me-2 w-25" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-success me-5" type="submit">Search</button>
            <button class="btn btn-outline-success px-4 me-2" data-bs-toggle="modal" data-bs-target="#loginModal">Login</button>
            <button class="btn btn-outline-success px-4 me-1" data-bs-toggle="modal" data-bs-target="#sigupModal">Sigup</button>
             ';
}




echo ' </div>
    </div>
</nav>  ';

include '_content/loginModal.php';
include '_content/sigupModal.php';

if (isset($_GET['signupsuccess']) && $_GET['signupsuccess'] == "true") {
    echo " <div class='alert alert-success alert-dismissible fade show m-0' role='alert'>
                  <strong> Success!</strong> You can login 
                  <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
               </div>";
}
;

// if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == "ture") {
//     echo "<div class='alert alert-success alert-dismissible fade show m-0' role='alert'>
//       <strong> Success</strong>  " . $_SESSION['useremail'] . " You Have loggdin! 
//       <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
//    </div>";
// }


//    if('$userLogout == false'){
//     echo "<div class='alert alert-success alert-dismissible fade show m-0' role='alert'>
//     <strong> Success</strong> You Have Logout From iDiscuss!
//     <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
//  </div>";
//    }

?>