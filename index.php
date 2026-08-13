<?php include 'db_connect.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Booking in Algeria</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <header class="main-header">
        <nav class="main-nav">
            <div class="logo">
                <i class="fas fa-hotel"></i>
                <span>Hotel Booking</span>
            </div>
            <div class="nav-links">
                <a href="#"><i class="fas fa-home"></i> Home</a>
                <a href="#"><i class="fas fa-info-circle"></i> About</a>
                <a href="#"><i class="fas fa-phone"></i> Contact</a>
            </div>
        </nav>
        
        <div class="hero-section">
            <div class="hero-content">
                <h1>Discover the Best Hotels in Algeria</h1>
                <p>Book your stay in the finest hotels with exclusive offers and premium services</p>
                <form method="GET" class="search-form">
                    <div class="search-input">
                        <i class="fas fa-map-marker-alt"></i>
                        <input type="text" name="location" placeholder="Enter city or region" value="<?php echo $_GET['location'] ?? ''; ?>">
                    </div>
                    <button type="submit" class="search-btn">
                        <i class="fas fa-search"></i>
                        Search
                    </button>
                </form>
            </div>
        </div>
    </header>

    <main class="main-content">
        <section class="featured-hotels">
            <h2>Featured Hotels</h2>
            <div class="hotel-grid">
                <?php
                $location = $_GET['location'] ?? '';
                $query = "SELECT * FROM hotels";
                if (!empty($location)) {
                    $query .= " WHERE location LIKE '%$location%'";
                }
                $result = $conn->query($query);

                while ($hotel = $result->fetch_assoc()) {
                    echo "<div class='hotel-card'>";
                    echo "<div class='hotel-image'>";
                    $image_path = 'images/hotel' . $hotel['id'] . '.jpg';
                    $fallback_image = 'images/default-hotel.jpg';
                    echo "<img src='" . (file_exists($image_path) ? $image_path : $fallback_image) . "' alt='{$hotel['name']}'>";
                    echo "<div class='hotel-rating'>";
                    for ($i = 0; $i < floor($hotel['rating']); $i++) {
                        echo "<i class='fas fa-star'></i>";
                    }
                    if ($hotel['rating'] - floor($hotel['rating']) >= 0.5) {
                        echo "<i class='fas fa-star-half-alt'></i>";
                    }
                    echo "</div>";
                    echo "</div>";
                    echo "<div class='hotel-info'>";
                    echo "<h3>{$hotel['name']}</h3>";
                    echo "<p class='location'><i class='fas fa-map-marker-alt'></i> {$hotel['location']}</p>";
                    echo "<div class='amenities'>";
                    $amenities = explode(',', $hotel['amenities']);
                    foreach (array_slice($amenities, 0, 3) as $amenity) {
                        echo "<span class='amenity'><i class='fas fa-check'></i> " . trim($amenity) . "</span>";
                    }
                    echo "</div>";
                    echo "<div class='price'>";
                    echo "<span class='amount'>DZD" . number_format($hotel['price_per_night']) . "</span>";
                    echo "<span class='per-night'>/ night</span>";
                    echo "</div>";
                    echo "<a href='hotel.php?id={$hotel['id']}' class='view-btn'>View Details</a>";
                    echo "</div></div>";
                }
                ?>
            </div>
        </section>

        <section class="features">
            <div class="feature">
                <i class="fas fa-shield-alt"></i>
                <h3>Secure Booking</h3>
                <p>We ensure secure booking with the highest protection standards</p>
            </div>
            <div class="feature">
                <i class="fas fa-percent"></i>
                <h3>Special Offers</h3>
                <p>Take advantage of the best exclusive offers and discounts</p>
            </div>
            <div class="feature">
                <i class="fas fa-headset"></i>
                <h3>24/7 Support</h3>
                <p>Customer service available around the clock</p>
            </div>
        </section>
    </main>

    <footer class="main-footer">
        <div class="footer-content">
            <div class="footer-section">
                <h3>About Us</h3>
                <p>We provide the best hotel booking service in Algeria with guaranteed best prices and services.</p>
            </div>
            <div class="footer-section">
                <h3>Quick Links</h3>
                <a href="#">Home</a>
                <a href="#">Hotels</a>
                <a href="#">Offers</a>
                <a href="#">Contact Us</a>
            </div>
            <div class="footer-section">
                <h3>Connect With Us</h3>
                <div class="social-links">
                    <a href="#"><i class="fab fa-facebook"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <p>All Rights Reserved &copy; <?php echo date('Y'); ?></p>
        </div>
    </footer>
</body>
</html>
