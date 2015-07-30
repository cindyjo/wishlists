<!doctype html>
<html lang="en">
<head>
    <title>My Wish List</title>
    <style type="text/css">
        #wrapper {
            font-family: sans-serif;   
        }
        table, tr, th, td {
            border: 1px solid silver;
            padding: 5px;
        }
        table {
            border-collapse: collapse;
            width: 80%;
            margin-bottom: 30px;
        }
        #log_off, #add_item{
            margin-left: 910px;
        }
    </style>
</head>
<body>
	<div id="wrapper"> 
        <a id="log_off" href="/logoff">Logout</a>
	    <h1>Hello, <?=$this->session->userdata['logged_user']['name']?>!</h1>
        <div id="your_list">

            <p>Your Wish List: </p>
            <table>
                <tr>
                    <th>Item</th>
                    <th>Added by</th>
                    <th>Date Added</th>
                    <th>Action</th>
                </tr>
<?php           if(!empty($user))
                {
                    $wish_items=[];
                    for($i = 0; $i<count($user['wishlist']); $i++)
                    {   
                        $wish_items[]=$user['wishlist'][$i]['id'];
                        ?>
                        <tr>
                            <td><a href="/wish_items/<?=$user['wishlist'][$i]['id']?>"><?=$user['wishlist'][$i]['item']?></a></td>
                            <td><?=$user['added_by'][$i]['name']?></td>
                            <td><?=$user['wishlist'][$i]['created_at']?></td>
<?php                       if($user['added_by'][$i]['name'] === $this->session->userdata['logged_user']['name'])
                            { ?>
                                <td><a href="delete/wishlist/<?=$user['wishlist'][$i]['id']?>">Delete</a></td>
<?php                       } 
                            else 
                            { ?>
                                <td><a href="/remove/wishlist/<?=$user['wishlist'][$i]['id']?>">Remove from my Wishlist</a></td>
<?php                       } ?>
                        </tr>
<?php               }                       
                }   ?>
            </table>
        </div>     
        <div id = "other_list">
            <p>Other User's Wish List</p>
            <table>
                <tr>
                    <th>Item</th>
                    <th>Added by</th>
                    <th>Date Added</th>
                    <th>Action</th>
                </tr>
<?php           if(!empty($other))
                {
                    for($i = 0; $i<count($other['wishlist']); $i++)
                    {   
                        if(!in_array($other['wishlist'][$i]['id'], $wish_items))
                        {?>
                        <tr>
                            <td><a href="/wish_items/<?=$other['wishlist'][$i]['id']?>"><?=$other['wishlist'][$i]['item']?></a></td>
                            <td><?=$other['added_by'][$i]['name']?></td>
                            <td><?=$other['wishlist'][$i]['created_at']?></td>
                            <td><a href="/add/wishlist/<?=$other['wishlist'][$i]['id']?>">Add to my Wishlist</a></td>
                        </tr>
<?php               }                       
                }   
            }?>
            </table>

        </div>
         <a id="add_item" href="/wish_items/create">Add Item</a>    
    </div>
</body>
</html>
