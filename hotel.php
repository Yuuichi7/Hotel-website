<?php include 'db_connect.php';

$id = $_GET['id'];
$result = $conn->query("SELECT * FROM hotels WHERE id = $id");
$hotel = $result->fetch_assoc();

// Get related hotels
$related_hotels_query = "SELECT * FROM hotels WHERE id != $id AND location LIKE '%Algeria%' LIMIT 8";
$related_hotels = $conn->query($related_hotels_query);
?>
<!DOCTYPE html>
<html>
<head>
    <title><?php echo $hotel['name']; ?> - Book Now</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <div class="hotel-header">
        <div class="hotel-gallery">
            <img src="images/hotel<?php echo $hotel['id']; ?>.jpg" alt="<?php echo $hotel['name']; ?>">
            <div class="gallery-thumbnails">
                <img src="images/hotel<?php echo $hotel['id']; ?>_1.jpg" alt="Gallery 1">
                <img src="images/hotel<?php echo $hotel['id']; ?>_2.jpg" alt="Gallery 2">
                <img src="images/hotel<?php echo $hotel['id']; ?>_3.jpg" alt="Gallery 3">
            </div>
        </div>
        <div class="hotel-title">
            <h1><?php echo $hotel['name']; ?></h1>
            <p class="location"><i class="fas fa-map-marker-alt"></i> <?php echo $hotel['location']; ?></p>
            <div class="rating">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star-half-alt"></i>
            </div>
        </div>
    </div>

    <div class="hotel-detail-container">
        <div class="hotel-info-left">
            <div class="description-box">
                <h2>Description</h2>
                <p><?php echo $hotel['description']; ?></p>
            </div>

            <div class="services-box">
                <h2>Services & Amenities</h2>
                <div class="services-grid">
                    <div class="service-item">
                        <i class="fas fa-utensils"></i>
                        <span>Restaurant</span>
                    </div>
                    <div class="service-item">
                        <i class="fas fa-swimming-pool"></i>
                        <span>Swimming Pool</span>
                    </div>
                    <div class="service-item">
                        <i class="fas fa-wifi"></i>
                        <span>Free WiFi</span>
                    </div>
                    <div class="service-item">
                        <i class="fas fa-parking"></i>
                        <span>Free Parking</span>
                    </div>
                    <div class="service-item">
                        <i class="fas fa-spa"></i>
                        <span>Spa</span>
                    </div>
                    <div class="service-item">
                        <i class="fas fa-dumbbell"></i>
                        <span>Fitness Center</span>
                    </div>
                </div>
            </div>

            <div class="related-hotels">
                <h2>Other Hotels in Algeria</h2>
                <div class="related-hotels-grid">
                    <?php while($related = $related_hotels->fetch_assoc()): ?>
                    <div class="related-hotel-card">
                        <img src="images/hotel<?php echo $related['id']; ?>.jpg" alt="<?php echo $related['name']; ?>">
                        <h3><?php echo $related['name']; ?></h3>
                        <p class="price">DZD<?php echo $related['price_per_night']; ?>/night</p>
                        <a href="hotel.php?id=<?php echo $related['id']; ?>" class="view-btn">View Hotel</a>
                    </div>
                    <?php endwhile; ?>
                </div>
            </div>
        </div>

        <div class="booking-form-right">
            <div class="price-box">
                <h2>DZD<?php echo $hotel['price_per_night']; ?> <span>/ night</span></h2>
                <div class="discount-box">
                    <h3>Special Offers</h3>
                    <ul>
                        <li>Stay 3 nights, get 10% off</li>
                        <li>Book 30 days in advance, get 15% off</li>
                        <li>Family package (2 adults + 2 children), get 20% off</li>
                    </ul>
                </div>
            </div>

            <form action="book_room.php" method="POST" class="booking-form">
                <input type="hidden" name="hotel_id" value="<?php echo $hotel['id']; ?>">
                
                <div class="form-group">
                    <label>Full Name</label>
                    <input type="text" name="name" required>
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" required>
                </div>

                <div class="form-group">
                    <label>Check-in Date</label>
                    <input type="date" name="check_in" required>
                </div>

                <div class="form-group">
                    <label>Check-out Date</label>
                    <input type="date" name="check_out" required>
                </div>

                <div class="guests-group">
                    <div class="form-group">
                        <label>Adults</label>
                        <input type="number" name="adults" min="1" value="1" required>
                    </div>
                    <div class="form-group">
                        <label>Children</label>
                        <input type="number" name="children" min="0" value="0">
                    </div>
                </div>

                <div class="form-group">
                    <label>Special Requests</label>
                    <textarea name="special_requests" rows="3"></textarea>
                </div>

                <button type="submit" class="book-now-btn">Book Now</button>
            </form>
        </div>
    </div>
</body>
</html>
