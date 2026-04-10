<?php
// search.php
session_start();
require_once 'config.php';

$search = $_GET['query'] ?? '';

// If search is empty, redirect back to home
if (empty($search)) {
    header("Location: index.php");
    exit();
}

// Search in database
$stmt = $pdo->prepare("SELECT * FROM products WHERE brand LIKE ? OR model LIKE ?");
$search_term = "%$search%";
$stmt->execute([$search_term, $search_term]);
$products = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results - Luxury</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">
</head>
<body>
    <!-- Copy your exact header from index.html -->
    <img id="logo" src="E:\projectshtml\e-com\Luxury_Modern_Swiss_Watch_Clock_Logo__1_-removebg-preview.png" alt="Logo">
    <nav>
        <ul>
            <li><a href="E:\projectshtml\anizone\resource\index.html"><i class="fas fa-house-chimney"></i> Home</a></li>
            <li><a href="E:\projectshtml\anizone\resource\about.html"><i class="fas fa-microscope"></i> About</a></li>
            <li><a href="E:\projectshtml\anizone\resource\feedback.html"><i class="fas fa-comments"></i> Feedback</a></li>
            <li><a href="E:\projectshtml\anizone\resource\shorts.html"><i class="fa-solid fa-cart-arrow-down"></i>Cart</a></li>
            <li> <button onclick="openLoginForm()" id="seb"><i class="fa-solid fa-user"></i></button></li>
        </ul>
    </nav>

    <div style="padding: 40px 20px; max-width: 1200px; margin: 0 auto;">
        <h1>Search Results for "<?php echo htmlspecialchars($search); ?>"</h1>
        
        <?php if(empty($products)): ?>
            <div style="text-align: center; padding: 40px;">
                <i class="fas fa-search" style="font-size: 48px; color: #ccc; margin-bottom: 20px;"></i>
                <h3>No products found</h3>
                <p>Try searching for different brands or models</p>
                <a href="index.php" style="color: #d4af37; text-decoration: none;">← Back to Home</a>
            </div>
        <?php else: ?>
            <p style="margin-bottom: 30px;">Found <?php echo count($products); ?> product(s)</p>
            
            <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 20px;">
                <?php foreach($products as $product): ?>
                <div style="border: 1px solid #ddd; padding: 20px; border-radius: 10px;">
                    <h3><?php echo htmlspecialchars($product['brand'] . ' ' . $product['model']); ?></h3>
                    <p style="color: #666;"><?php echo htmlspecialchars(substr($product['description'], 0, 100)); ?>...</p>
                    <p style="font-size: 20px; font-weight: bold; color: #d4af37;">$<?php echo number_format($product['price'], 2); ?></p>
                    <button style="background: #d4af37; color: white; border: none; padding: 10px 15px; border-radius: 5px; cursor: pointer;">
                        <i class="fa-solid fa-cart-arrow-down"></i> Add to Cart
                    </button>
                </div>
                <?php endforeach; ?>
            </div>
            
            <div style="text-align: center; margin-top: 40px;">
                <a href="index.php" style="color: #d4af37; text-decoration: none;">← Back to Home</a>
            </div>
        <?php endif; ?>
    </div>

    <!-- Copy your exact footer from index.html -->
    <footer>
        <div id="ftdetl">
            <!-- Your footer content here -->
        </div>
    </footer>
</body>
</html>