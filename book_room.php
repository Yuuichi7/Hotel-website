<?php
include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $hotel_id = $_POST['hotel_id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $check_in = $_POST['check_in'];
    $check_out = $_POST['check_out'];
    $adults = $_POST['adults'];
    $children = $_POST['children'];
    $special_requests = $_POST['special_requests'];

    // Calculate number of nights
    $check_in_date = new DateTime($check_in);
    $check_out_date = new DateTime($check_out);
    $nights = $check_out_date->diff($check_in_date)->days;

    // Get hotel price
    $result = $conn->query("SELECT price_per_night FROM hotels WHERE id = $hotel_id");
    $hotel = $result->fetch_assoc();
    $base_price = $hotel['price_per_night'];

    // Calculate total price
    $total_price = $base_price * $nights;

    // Apply discounts
    $discount = 0;
    $discount_reason = '';

    // 3 nights stay discount
    if ($nights >= 3) {
        $discount = 0.10;
        $discount_reason = '10% off for 3+ nights stay';
    }

    // Early booking discount (30 days in advance)
    $booking_date = new DateTime();
    $days_until_checkin = $check_in_date->diff($booking_date)->days;
    if ($days_until_checkin >= 30) {
        $discount = max($discount, 0.15);
        $discount_reason = '15% off for booking 30+ days in advance';
    }

    // Family package discount
    if ($adults == 2 && $children == 2) {
        $discount = max($discount, 0.20);
        $discount_reason = '20% off for family package (2 adults + 2 children)';
    }

    // Calculate final price
    $discount_amount = $total_price * $discount;
    $final_price = $total_price - $discount_amount;

    // Insert booking into database
    $stmt = $conn->prepare("INSERT INTO bookings (hotel_id, name, email, check_in, check_out, adults, children, special_requests, total_price, discount_amount, final_price, discount_reason) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("issssiisddds", $hotel_id, $name, $email, $check_in, $check_out, $adults, $children, $special_requests, $total_price, $discount_amount, $final_price, $discount_reason);
    
    if ($stmt->execute()) {
        header("Location: booking_success.php?id=" . $stmt->insert_id);
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}
?>
