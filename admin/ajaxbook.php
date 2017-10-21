<?php
require_once('../includes/db.php');
$categoryID = (int)$_POST['categoryID'];
// $selected = $_POST['selected'];
$sql="SELECT * FROM books WHERE CatId=:categoryID ORDER BY BookName";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':categoryID', $categoryID, PDO::PARAM_INT);
$stmt->execute();
$results=$stmt->fetchAll(PDO::FETCH_ASSOC);
// var_dump($results);
ob_start();
?>
<option value="">select book</option>
<?php foreach ($results as $result):?>
   <option value="<?php echo $result['id'];?>"><?=$result['BookName'];?></option>
<?php endforeach; ?>

<?php echo ob_get_clean();?>
