<!DOCTYPE html>
<html lang="en">

<head>

    <link rel="stylesheet" href="css/bootstrap.css">
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital@1&family=Ubuntu&display=swap" rel="stylesheet">
</head>

<body>

    <div class="maindiv px-5 pt-3">

        <nav class="navbar navbar-dark  navbar-fixed-top ">
            <div class="navbar-brand">
                <h1>Welcome
                    <?php echo " username"; ?>
                </h1>
            </div>
            <div class="nav navbar-nav navbar-right pointer" id="profile">
                <div id="profile_pic"></div>
                <h3>username</h3>
            </div>
        </nav>

        <!-- DEBUG SECTION-->
        <div class="debug">

            <?php
            require_once("database.php");

            ?>
        </div>
        <!-- MAIN CONTENT SECTION -->
        <div class="row mx-2">
            <div class="main col col-lg-8 col-sm-12">
                <fieldset class="border border-primary pt-5">
                    <legend>
                        <h1>Your Tasks</h1>
                    </legend>

                    <div class="row content">

                        <!-- create tiles for each item in the table -->


                        <?php

                        $rqst = mysqli_query($sql, 'select items.itemlink from usingitm inner join items on usingitm.itemcode = items.itemcode where usingitm.id=1');

                        if (!$rqst) {
                            die("extraction error" . mysqli_connect_errno());
                        }

                        while ($fetch = mysqli_fetch_array($rqst)) {
                            echo '<div class="col col-lg-3 col-md-4 col-sm-6 col-6 mx-5 my-5 item"><a href="' . $fetch["itemlink"] . '" target="_blank"><div style="background-image:url('.$fetch["itemlink"].'/favicon.ico);" class="item insideitem"></div></a></div>';
                        }

                        ?>







                        <div class="col col-lg-3 mx-5 my-5 adder">

                            <div class="add pointer" onclick="newitem();">
                                <div class="inside_add">+</div>
                            </div>
                            <h6 class="pointer" onclick="newitem();">add</h6>
                        </div>

                    </div>

                    <div>

                    </div>
                </fieldset>
            </div>
        </div>

    </div>
    <div id="regform">
        <button onclick="newitem();">
            <div id="close"></div>
        </button>
        <form class="border border-primary py-5 px-5 mt-5" action="index.php" method="POST">
            <div class="form-group">
                <small class="form-text text-muted mx-3">ENter the link of place you want to bookmark</small>
                <label for="inputLink">LINK</label>
                <input type="text" name="inputLink" class="form-control" placeholder="ex:- https://youtube.com">



                <button type="submit" name="submit" class="btn btn-primary my-5">Submit</button>
            </div>
        </form>

    </div>
    <?php
    $link = null;
    if (isset($_POST["submit"])) {
        require_once("database.php");
        $link = $_POST["inputLink"];
        // echo "<h1>".$link."</h1>";
    

        // INSERT INTO ITEMS
        $storeReq = mysqli_query($sql, 'insert into items (itemlink) values("' . $link . '")');


        if (!$storeReq) {
            die("connection error" . mysqli_connect_error());
        }


        // $getItemComm=mysqli_query($sql,"select MAX(itemcode) from items");
        // $getItemCode=mysqli_fetch_array($getItemComm);
    


        // INSERT TO USINGITM
    
        $settle = mysqli_query($sql, 'insert into usingitm(id,itemcode) values(1,(select MAX(itemcode) from items))');

        if (!$settle) {
            die("comm error" . mysqli_connect_error());
        }

        header("location: index.php");
    }

    ?>



    <script>
        var regform = document.getElementById("regform");

        function newitem() {

            if (regform.style.visibility === "hidden") {
                regform.style.visibility = "visible";
            } else {
                regform.style.visibility = "hidden";
            }
            // if(regform.style.visibility==="hidden"){
            //     regform.style.visibility="visible";

            // }
            // else{
            //     regform.style.visibility="hidden";
            // }
        }
    </script>
    <script src="js/bootstrap.js"></script>
    <!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" 
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>-->
</body>


</html>