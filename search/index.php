<?php
$db = new mysqli('localhost', 'root', '', 'test');
session_start();
	if(isset($_POST['submit']))
	{
		$search=$_POST['search'];
		$_SESSION['title']= $search;
		if(($_SESSION['title'])!="")
		{
		header("location:index.php");
		}
		else
		{
		echo "<script> alert('search box as been empty') </script>";
		}
	}
?>
<html>
<head>
<title>mostlikers</title>
<link rel="stylesheet" href="st.css" />
</head>
<body>
<div class="login">
</form>
<form method="post">
<p align="center"><img src="http://2.bp.blogspot.com/-Hl_N3uKjgCg/UXKQ-5Am80I/AAAAAAAAAP0/hQlND-p7P6I/s1600/logos.png" /></p>
<p>
<?php if(isset($_SESSION['title'])) { ?>
<input name="search" type="search" list="searchkey" value="<?php echo $_SESSION['title'];?>" class="search" />
<?php } else { ?>
<input name="search" type="search" list="searchkey" placeholder="Just type your text here press enter ex : Mostlikers"  class="search" />
<?php } ?>
</p>
<datalist id="searchkey">
<?php
$tile=$db->query("SELECT * FROM `search`");
while($storetitle=mysqli_fetch_object($tile))
{
?>
<option  value="<?php echo $storetitle->title ?>">
<?php } ?>
</datalist>
<p align="center">
<input type="submit" name="submit" id="click" class="but" value="Mostliker search"  />
<input type="submit" name="submit" class="but" value="I m Feeling lucky" /> </p> 
<p class="lang">Add content: 
<a href="add-view.php">Hindi</a>&nbsp;<a href="add-view.php"> Bengali </a>&nbsp;
<a href="add-view.php">Telugu </a>&nbsp;<a href="add-view.php">Marathi </a>&nbsp;
<a href="add-view.php">Tamil </a>&nbsp;<a href="add-view.php">Gujarati</a><a href="add-view.php">
Kannada</a>&nbsp;<a href="add-view.php"> Malayalam</a></p>

<?php if(isset($_SESSION['title'])) {
if(($_SESSION['title']!=""))
{
$data=$_SESSION['title'];
$view=$db->query("select * from search where title like '%$data%' || desp like '%$data%' limit 10 ");
$check=mysqli_num_rows($view);
if($check!="")
{
while($descri=mysqli_fetch_object($view))
{
?>
<div class="reslt">
<h3 id="resuil-title"><?php echo $descri->title; ?></h3>
<p class="Description">
<?php $description = str_replace($data, '<span class="highlight">'.$data."</span>", $descri->desp);
echo $description;
?><p>
<hr>
</div>
<?php } } else { ?>
<div class="reslt">
<h3 id="resuil-title">Searching Data not fond</h3>
<p class="Description">
Add new data enter and check the correct keyword
<p><hr>
</div>
<?php } } } ?>
</form>

</div>
</body>
</html>