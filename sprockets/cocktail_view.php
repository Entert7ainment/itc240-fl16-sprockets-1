<?php include 'includes/config.php'; ?>
<?php
if(isset($_GET['id']))
{
    $id = (int)$_GET['id'];   
}else{
    header('Location:cocktails_list.php');
}




$sql = "select * from Cocktails where CocktailsID = $id";


$iConn = @mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME) or die(myerror(__FILE__,__LINE__,mysqli_connect_error()));
$result = mysqli_query($iConn,$sql) or die(myerror(__FILE__,__LINE__,mysqli_error($iConn)));
if (mysqli_num_rows($result) > 0)//at least one record!
{//show results
	while ($row = mysqli_fetch_assoc($result))
    {
	 $Name = stripslashes($row['Name']);
     $Ingredients = stripslashes($row['Ingredients']);
     $Description = stripslashes($row['Description']);
     $Category = stripslashes($row['Category']);
     $Price = stripslashes($row['Price']);
     $title = "Title Page for " . $Name;
     $pageID = $Name;
     $Feedback = '';
    }
}else{//no records
	$Feedback = '<p>This cocktail does not exist</p>';
}
?>
<?php include 'includes/header.php';?>
<h1><?=$pageID?></h1>
<?php
if($Feedback == '')
{
echo '<p>';
    echo 'Name: <b>' . $Name . '</b><br/>';
    echo 'Ingredients: <b>' . $Ingredients . '</b><br/>';
    echo 'Description: <b>' . $Description . '</b><br/>';
    echo 'Category: <b>' . $Category . '</b><br/>';
    echo 'Price: <b>' . $Price . '</b><br/>';
    
    echo '<img src="uploads/cocktails' . $id . '.jpg" />';
    echo '</p>';

}else{
    echo $Feedback;
}
echo '<p><a href="cocktails_list.php">Go Back</a></p>';
@mysqli_free_result($result); //releases web server memory
@mysqli_close($iConn); //close connection to database

?>

<?php include 'includes/footer.php'; ?>
