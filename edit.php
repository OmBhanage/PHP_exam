<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $id = $_POST['id'];
    $p_name = $_POST['p_name'];
    $category = $_POST['category'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $s_name = $_POST['s_name'];

    $sql = $conn->prepare("update products1 SET p_name=?, category=?, price=?, quantity=?, s_name=? WHERE id=?");
    $sql->bind_param("ssdisi",$p_name,$category,$price,$quantity,$s_name,$id);

}

    if ($sql->execute()) {
        header("Location: dashboard.php");
        exit;
}

$id = $_GET['id'];
$sql = $conn->prepare("select * from products1 where id=?");
$sql->bind_param("i", $id);
$sql->execute();

$result = $sql->get_result();
$row = $result->fetch_assoc();

?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h2>Edit Product</h2>

    <form method="POST" action="edit.php">
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">

        <label>Product Name</label>
        <input type="text" name="p_name" class="form-control"
               value="<?php echo htmlspecialchars($row['p_name']); ?>" required>

        <label>Category</label>
        <input type="text" name="category" class="form-control"
               value="<?php echo htmlspecialchars($row['category']); ?>" required>

        <label>Price</label>
        <input type="number" step="0.01" name="price" class="form-control"
               value="<?php echo $row['price']; ?>" required>

        <label>Quantity</label>
        <input type="number" name="quantity" class="form-control"
               value="<?php echo $row['quantity']; ?>" required>

        <label>Supplier Name</label>
        <input type="text" name="s_name" class="form-control"
               value="<?php echo htmlspecialchars($row['s_name']); ?>" required>

        <button type="submit" class="btn btn-success mt-3">Update</button>
        <a href="dashboard.php" class="btn btn-secondary mt-3">Cancel</a>
    </form>
</div>

</body>
</html>