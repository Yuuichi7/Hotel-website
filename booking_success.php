<?php
include 'db_connect.php';

$booking_id = $_GET['id'];
$result = $conn->query("
    SELECT b.*, h.name as hotel_name, h.location 
    FROM bookings b 
    JOIN hotels h ON b.hotel_id = h.id 
    WHERE b.id = $booking_id
");
$booking = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Booking Confirmation</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <div class="booking-confirmation">
        <div class="confirmation-header">
            <i class="fas fa-check-circle"></i>
            <h1>Booking Confirmed!</h1>
            <p>Thank you for choosing <?php echo $booking['hotel_name']; ?></p>
        </div>

        <div class="booking-details">
            <h2>Booking Details</h2>
            <div class="details-grid">
                <div class="detail-item">
                    <span class="label">Booking ID:</span>
                    <span class="value">#<?php echo $booking['id']; ?></span>
                </div>
                <div class="detail-item">
                    <span class="label">Hotel:</span>
                    <span class="value"><?php echo $booking['hotel_name']; ?></span>
                </div>
                <div class="detail-item">
                    <span class="label">Location:</span>
                    <span class="value"><?php echo $booking['location']; ?></span>
                </div>
                <div class="detail-item">
                    <span class="label">Check-in:</span>
                    <span class="value"><?php echo date('F j, Y', strtotime($booking['check_in'])); ?></span>
                </div>
                <div class="detail-item">
                    <span class="label">Check-out:</span>
                    <span class="value"><?php echo date('F j, Y', strtotime($booking['check_out'])); ?></span>
                </div>
                <div class="detail-item">
                    <span class="label">Guests:</span>
                    <span class="value"><?php echo $booking['adults']; ?> Adults, <?php echo $booking['children']; ?> Children</span>
                </div>
            </div>

            <div class="price-details">
                <h2>Price Details</h2>
                <div class="price-grid">
                    <div class="price-item">
                        <span class="label">Base Price:</span>
                        <span class="value">DZD<?php echo number_format($booking['total_price'], 2); ?></span>
                    </div>
                    <?php if ($booking['discount_amount'] > 0): ?>
                    <div class="price-item discount">
                        <span class="label">Discount (<?php echo $booking['discount_reason']; ?>):</span>
                        <span class="value">-DZD<?php echo number_format($booking['discount_amount'], 2); ?></span>
                    </div>
                    <?php endif; ?>
                    <div class="price-item total">
                        <span class="label">Final Price:</span>
                        <span class="value">DZD<?php echo number_format($booking['final_price'], 2); ?></span>
                    </div>
                </div>
            </div>

            <?php if (!empty($booking['special_requests'])): ?>
            <div class="special-requests">
                <h2>Special Requests</h2>
                <p><?php echo $booking['special_requests']; ?></p>
            </div>
            <?php endif; ?>
        </div>

        <div class="confirmation-footer">
            <p>A confirmation email has been sent to <?php echo $booking['email']; ?></p>
            <a href="index.php" class="back-home-btn">Back to Home</a>
        </div>
    </div>
</body>
</html>
