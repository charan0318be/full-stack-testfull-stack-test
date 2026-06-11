<?php
include "config/db.php";

/* Get all tabs */
$tabQuery = "SELECT * FROM tabs";
$tabResult = mysqli_query($conn, $tabQuery);

/* Default tab = Learning */
$tabId = isset($_GET['tab']) ? (int)$_GET['tab'] : 1;

/* Get selected slide */
$slideQuery = "SELECT * FROM slides WHERE tab_id = $tabId LIMIT 1";
$slideResult = mysqli_query($conn, $slideQuery);
$slide = mysqli_fetch_assoc($slideResult);
?>

<!DOCTYPE html>
<html>
<head>
    <title>WPoets Assignment</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>

    *{
        margin:0;
        padding:0;
        box-sizing:border-box;
        font-family:Arial,sans-serif;
    }

    body{
        padding:40px;
        background:#0d3557;
    }

    h1{
        color:white;
        margin-bottom:30px;
    }

    .container{
        display:flex;
        gap:25px;
         align-items:stretch;

    }

    .tabs{
        width:30%;
    }

    .content{
        width:67%;
        display:flex;
        gap:20px;
    }

    .tab-box{
        background:white;
        border:1px solid #ddd;
        padding:30px;
        margin-bottom:15px;
        cursor:pointer;
        transition:.3s;
    }

    .tab-box:hover{
        transform:translateY(-3px);
    }

    .active-tab{
        border-left:6px solid #4ec5e8;
    }

    .tab-header{
        display:flex;
        justify-content:space-between;
        align-items:center;
    }

    .tab-left{
        display:flex;
        align-items:center;
        gap:20px;
    }

    .tab-left h3{
        color:black;
        margin:0;
    }

    .tab-box img{
        margin-bottom:0;
    }

    .left-content{
        flex:1;
        background:#8bc7d5;
        color:white;
        padding:40px;
        
    }

    .left-content h3{
        margin-bottom:20px;
    }

    .left-content h2{
    margin-bottom:25px;
    font-size:34px;
    line-height:1.2;
    font-weight:700;
}

    .left-content p{
        font-size:20px;
        line-height:1.6;
    }

    .right-content{
        flex:1;
    }

    .right-content img{
        width:100%;
        height:100%;
        object-fit:cover;
    }

    a{
        text-decoration:none;
    }

    .mobile-content{
    display:none;
}
    /* MOBILE VIEW */

    @media screen and (max-width:768px){

        body{
            padding:15px;
        }

        
        h1{
            font-size:30px;
            text-align:center;
            margin-bottom:20px;
        }

        .container{
            display:block !important;
        }

        .tabs{
            width:100% !important;
        }

        .content{
    display:none !important;
    width:0 !important;
    overflow:hidden;
}

        .mobile-content{
            display:block !important;
            margin-bottom:15px;
        }

        .tab-box{
            padding:20px;
        }

        .tab-left img{
            width:50px;
        }

        .tab-left h3{
            font-size:20px;
        }

        .mobile-slide{
            background:#8bc7d5;
            color:white;
            padding:20px;
            text-align:center;
        }

        .mobile-slide h4{
            margin-bottom:10px;
        }

        .mobile-slide h2{
            font-size:28px;
            line-height:1.3;
            margin-bottom:15px;
        }

        .mobile-slide p{
            font-size:16px;
            margin-bottom:15px;
        }

        .mobile-slide img{
            width:100%;
            height:auto;
            display:block;
        }
    }

    </style>
</head>

<body>

<h1>WPoets Assignment</h1>

<div class="container">

    <!-- Tabs -->
    <div class="tabs">

        <?php while($tab = mysqli_fetch_assoc($tabResult)) { ?>

    <a href="?tab=<?php echo $tab['id']; ?>">

        <div class="tab-box <?php echo ($tab['id'] == $tabId) ? 'active-tab' : ''; ?>">

            <div class="tab-header">

                <div class="tab-left">
                    <img src="assets/icons/<?php echo $tab['icon']; ?>" width="60">
                    <h3><?php echo $tab['name']; ?></h3>
                </div>

                <div>
                    <?php if($tab['id'] == $tabId){ ?>
                        <img src="assets/icons/minus-01.svg" width="25">
                    <?php } else { ?>
                        <img src="assets/icons/plus-01.svg" width="25">
                    <?php } ?>
                </div>

            </div>

        </div>

    </a>

    <?php if($tab['id'] == $tabId){ ?>

        <div class="mobile-content">

            <div class="mobile-slide">

                <h4><?php echo $slide['category']; ?></h4>

                <h2><?php echo $slide['title']; ?></h2>

                <p><?php echo $slide['description']; ?></p>

                <img src="assets/images/<?php echo $slide['image']; ?>">

            </div>

        </div>

    <?php } ?>

<?php } ?>

    </div>

    <!-- Slide Content -->
    <div class="content">

        <div class="left-content">

            <h3><?php echo $slide['category']; ?></h3>

            <br>

            <h2><?php echo $slide['title']; ?></h2>

            <br>

            <p><?php echo $slide['description']; ?></p>

        </div>

        <div class="right-content">

            <img src="assets/images/<?php echo $slide['image']; ?>">

        </div>

    </div>

</div>

</body>
</html> 