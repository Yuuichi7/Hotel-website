CREATE DATABASE IF NOT EXISTS hotel_booking;
USE hotel_booking;

CREATE TABLE hotels (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    location VARCHAR(255),
    description TEXT,
    price_per_night DECIMAL(10,2),
    rating DECIMAL(2,1),
    amenities TEXT
);

CREATE TABLE bookings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    hotel_id INT,
    name VARCHAR(100),
    email VARCHAR(100),
    check_in DATE,
    check_out DATE,
    adults INT,
    children INT,
    special_requests TEXT,
    total_price DECIMAL(10,2),
    discount_amount DECIMAL(10,2),
    final_price DECIMAL(10,2),
    discount_reason VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (hotel_id) REFERENCES hotels(id)
);

-- Sample data for hotels in Algeria
INSERT INTO hotels (name, location, description, price_per_night, rating, amenities) VALUES
('Holiday Inn Algiers', 'Algiers', 'The Holiday Inn Algiers – Cheraga Tower combines contemporary prestige and comfort, making it the perfect destination for business trips, corporate meetings, or family events.', 20000, 4.5, 'Restaurant, Swimming Pool, Spa, Fitness Center, Free WiFi, Parking'),
('Palm Hotel', 'Biskra', 'Large rooms with welcoming and available staff. The bedding is very comfortable, the complex has thermal baths (spa and hammam) you will find masseuses and thermal agents who take care of you', 12000, 4.2, 'Restaurant, Swimming Pool, Spa, Thermal Baths, Free WiFi'),
('Sheraton Club des Pins Resort', 'Algiers', 'Luxurious beachfront resort with stunning Mediterranean views, multiple restaurants, and extensive leisure facilities.', 25000, 4.7, 'Restaurant, Swimming Pool, Private Beach, Spa, Fitness Center, Free WiFi, Parking'),
('El Aurassi Hotel', 'Algiers', 'Iconic hotel with panoramic views of Algiers Bay, featuring elegant rooms and excellent conference facilities.', 18000, 4.3, 'Restaurant, Swimming Pool, Conference Rooms, Free WiFi, Parking'),
('Mercure Oran', 'Oran', 'Modern hotel in the heart of Oran, perfect for both business and leisure travelers.', 15000, 4.1, 'Restaurant, Swimming Pool, Fitness Center, Free WiFi, Parking'),
('Hotel El Djazair', 'Algiers', 'Historic luxury hotel with colonial architecture, offering refined service and elegant accommodations.', 22000, 4.6, 'Restaurant, Swimming Pool, Spa, Fitness Center, Free WiFi, Parking'),
('Hotel Royal', 'Constantine', 'Contemporary hotel with stunning views of the Rhumel Gorge, featuring modern amenities and excellent service.', 16000, 4.2, 'Restaurant, Swimming Pool, Fitness Center, Free WiFi, Parking'),
('Hotel Sabri', 'Annaba', 'Beachfront hotel with comfortable rooms and easy access to the city center and tourist attractions.', 14000, 4.0, 'Restaurant, Swimming Pool, Private Beach, Free WiFi, Parking'),
('Hotel Mercure Tlemcen', 'Tlemcen', 'Modern hotel in the historic city of Tlemcen, offering comfortable accommodations and excellent facilities.', 13000, 4.1, 'Restaurant, Swimming Pool, Fitness Center, Free WiFi, Parking'),
-- New hotels in Oran
('Hotel Le Meridien Oran', 'Oran', 'Luxury hotel with stunning sea views, featuring elegant rooms, multiple restaurants, and a private beach.', 22000, 4.8, 'Restaurant, Swimming Pool, Private Beach, Spa, Fitness Center, Free WiFi, Parking'),
('Hotel Sheraton Oran', 'Oran', 'Modern hotel with panoramic views of the Mediterranean, offering premium services and facilities.', 19000, 4.6, 'Restaurant, Swimming Pool, Spa, Fitness Center, Free WiFi, Parking'),
('Hotel Ibis Oran', 'Oran', 'Comfortable and affordable hotel in the city center, perfect for business and leisure travelers.', 12000, 4.0, 'Restaurant, Free WiFi, Parking'),
-- New hotels in Annaba
('Hotel Seybouse International', 'Annaba', 'Luxury hotel with modern amenities and excellent service, located near the city center.', 18000, 4.5, 'Restaurant, Swimming Pool, Spa, Fitness Center, Free WiFi, Parking'),
('Hotel El Mountazah', 'Annaba', 'Beachfront hotel with comfortable rooms and stunning sea views.', 16000, 4.3, 'Restaurant, Swimming Pool, Private Beach, Free WiFi, Parking'),
('Hotel La Coupole', 'Annaba', 'Modern hotel with excellent facilities and convenient location.', 14000, 4.2, 'Restaurant, Swimming Pool, Fitness Center, Free WiFi, Parking'),
-- New hotels in Constantine
('Hotel Ibis Constantine', 'Constantine', 'Modern hotel with comfortable rooms and excellent service, perfect for business travelers.', 13000, 4.1, 'Restaurant, Free WiFi, Parking'),
('Hotel Cirta', 'Constantine', 'Historic hotel with elegant rooms and stunning views of the city.', 17000, 4.4, 'Restaurant, Swimming Pool, Fitness Center, Free WiFi, Parking'),
('Hotel Novotel Constantine', 'Constantine', 'Contemporary hotel with modern amenities and excellent conference facilities.', 19000, 4.5, 'Restaurant, Swimming Pool, Conference Rooms, Free WiFi, Parking');
