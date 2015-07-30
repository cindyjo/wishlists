<!doctype html>
<html lang="en">
<head>
    <title>Create Item</title>

    <style type="text/css">
    *{
      font-family: sans-serif;
    }
    ul, li{
    	display: inline-block;
   	}
   	ul {
   		margin-left: 700px;
   	}
    #home {
    	margin-right: 20px;
    }
    #add {
    	background-color: black;
    	color: white;
    	display: block;
    	margin-top: 15px;
    	margin-left: 185px;
    }

    </style>

</head>

<body>
	<div id="wrapper">
		<ul>
	        <li><a id="home" href="/dashboard">Home</a></li>
	        <li><a id="log_off" href="/logoff">Logout</a></li>
	    </ul>
		<h1>Create a New Wish List Item!</h1>
<?php   if(!empty($this->session->flashdata('errors')))
        {
         echo $this->session->flashdata('errors');
        } ?>
		<form action="/wish_items/create_item" method="post">
			<label>Item/Product: <input type="text" name="item"></label>
			<input id = "add" type="submit" value="Add">
		</form>

	</div>


</body>
</html>
