<!doctype html>
<html lang="en">
<head>
    <title>iPhone 9</title>

    <style type="text/css">
        *{
            font-family: sans-serif;
        }
        #wrapper {
            padding: 10px 30px;
        }
        #bar {
            margin-left: 700px;
        }
        #bar ul, #bar li {
            display: inline-block;
        }
        #home {
            margin-right: 15px;
        }
        .user ul li{
            margin-left: 20px;
        }
    </style>

</head>

<body>
	<div id="wrapper"> 
        <ul id="bar">
            <li><a id="home" href="/dashboard">Home</a></li>
            <li><a id="log_off" href="/logoff">Log Off</a></li>
        </ul>
        <h1><?=$item['item']?></h1>
        <p>Users who added this product/item under their wish list:</p>
<?php   if(!empty($users))
        { ?>
            <ul>
<?php           foreach($users AS $row)
                { ?>
                    <li class="user"><?=$row['name']?></li>
<?php           } ?>
            <ul>
<?php   } ?>
    </div>

</body>
</html>
