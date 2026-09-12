<?php
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['name'])) {

    $name  = $_POST['name'];
    $movie = $_POST['movie'] ?? 'Selected Movie';

    header("Location: booking_success.php?name=" . urlencode($name) . "&movie=" . urlencode($movie));
    exit();
}
?>


<!doctype html>
<html lang="en" class="h-full">
 <head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CineMax - Movie Ticket Booking</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&amp;family=Poppins:wght@300;400;500;600;700&amp;display=swap" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script src="/_sdk/element_sdk.js"></script>
  <script src="/_sdk/data_sdk.js"></script>
  <style>
        body {
            box-sizing: border-box;
        }
        
        :root {
            --primary-color: #e50914;
            --secondary-color: #141414;
            --accent-color: #f5c518;
            --text-color: #ffffff;
            --text-muted: #8c8c8c;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        html, body {
            height: 100%;
            width: 100%;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background: var(--secondary-color);
            color: var(--text-color);
            overflow-x: hidden;
        }
        
        .app-wrapper {
            width: 100%;
            height: 100%;
            overflow-y: auto;
            overflow-x: hidden;
            background: linear-gradient(135deg, #0a0a0a 0%, #1a1a2e 50%, #16213e 100%);
        }
        
        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }
        
        ::-webkit-scrollbar-track {
            background: var(--secondary-color);
        }
        
        ::-webkit-scrollbar-thumb {
            background: var(--primary-color);
            border-radius: 4px;
        }
        
        /* Navbar */
        .navbar-custom {
            background: rgba(20, 20, 20, 0.95) !important;
            backdrop-filter: blur(10px);
            padding: 15px 0;
            border-bottom: 1px solid rgba(229, 9, 20, 0.3);
            transition: all 0.3s ease;
        }
        
        .navbar-brand {
            font-family: 'Bebas Neue', cursive;
            font-size: 2.2rem;
            color: var(--primary-color) !important;
            letter-spacing: 3px;
        }
        
        .navbar-brand i {
            margin-right: 8px;
            animation: pulse 2s infinite;
        }
        
        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.1); }
        }
        
        .nav-link {
            color: var(--text-color) !important;
            font-weight: 500;
            margin: 0 10px;
            position: relative;
            transition: color 0.3s ease;
        }
        
        .nav-link:hover {
            color: var(--primary-color) !important;
        }
        
        .nav-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: -5px;
            left: 50%;
            background: var(--primary-color);
            transition: all 0.3s ease;
            transform: translateX(-50%);
        }
        
        .nav-link:hover::after {
            width: 100%;
        }
        
        .btn-login {
            background: linear-gradient(135deg, var(--primary-color), #b20710);
            border: none;
            padding: 10px 25px;
            border-radius: 25px;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(229, 9, 20, 0.4);
        }
        
        /* Hero Section */
        .hero-section {
            min-height: 600px;
            background: linear-gradient(135deg, rgba(10, 10, 10, 0.9), rgba(26, 26, 46, 0.8)),
                        url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="%23e50914" fill-opacity="0.1" d="M0,192L48,197.3C96,203,192,213,288,229.3C384,245,480,267,576,250.7C672,235,768,181,864,181.3C960,181,1056,235,1152,234.7C1248,235,1344,181,1392,154.7L1440,128L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>');
            background-size: cover;
            display: flex;
            align-items: center;
            position: relative;
            overflow: hidden;
        }
        
        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: radial-gradient(circle at 30% 50%, rgba(229, 9, 20, 0.15) 0%, transparent 50%);
        }
        
        .hero-content {
            position: relative;
            z-index: 2;
        }
        
        .hero-title {
            font-family: 'Bebas Neue', cursive;
            font-size: 4rem;
            letter-spacing: 5px;
            text-shadow: 2px 2px 10px rgba(0, 0, 0, 0.5);
            animation: fadeInUp 1s ease;
        }
        
        .hero-subtitle {
            font-size: 1.3rem;
            color: var(--text-muted);
            margin-bottom: 30px;
            animation: fadeInUp 1s ease 0.2s both;
        }
        
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .search-box {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50px;
            padding: 8px;
            backdrop-filter: blur(10px);
            animation: fadeInUp 1s ease 0.4s both;
        }
        
        .search-box input {
            background: transparent;
            border: none;
            color: white;
            padding: 15px 25px;
            font-size: 1rem;
            width: 100%;
        }
        
        .search-box input::placeholder {
            color: var(--text-muted);
        }
        
        .search-box input:focus {
            outline: none;
        }
        
        .btn-search {
            background: var(--primary-color);
            border: none;
            padding: 15px 35px;
            border-radius: 50px;
            font-weight: 600;
        }
        
        /* Section Styles */
        .section-title {
            font-family: 'Bebas Neue', cursive;
            font-size: 2.5rem;
            letter-spacing: 3px;
            margin-bottom: 40px;
            position: relative;
            display: inline-block;
        }
        
        .section-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 0;
            width: 60px;
            height: 4px;
            background: var(--primary-color);
            border-radius: 2px;
        }
        
        /* Movie Cards */
        .movie-card {
            background: rgba(255, 255, 255, 0.05);
            border-radius: 15px;
            overflow: hidden;
            transition: all 0.4s ease;
            cursor: pointer;
            position: relative;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .movie-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(229, 9, 20, 0.3);
            border-color: var(--primary-color);
        }
        
        .movie-poster {
            width: 100%;
            height: 350px;
            background: linear-gradient(135deg, #2d2d2d 0%, #1a1a1a 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 4rem;
            position: relative;
            overflow: hidden;
        }
        
        .movie-poster::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 100px;
            background: linear-gradient(transparent, rgba(20, 20, 20, 0.9));
        }
        
        .movie-rating {
            position: absolute;
            top: 15px;
            right: 15px;
            background: var(--accent-color);
            color: #000;
            padding: 5px 12px;
            border-radius: 20px;
            font-weight: 700;
            font-size: 0.9rem;
            z-index: 2;
        }
        
        .movie-badge {
            position: absolute;
            top: 15px;
            left: 15px;
            background: var(--primary-color);
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            z-index: 2;
        }
        
        .movie-info {
            padding: 20px;
        }
        
        .movie-title {
            font-weight: 600;
            font-size: 1.1rem;
            margin-bottom: 8px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        
        .movie-meta {
            color: var(--text-muted);
            font-size: 0.85rem;
            margin-bottom: 15px;
        }
        
        .movie-genre {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }
        
        .genre-tag {
            background: rgba(229, 9, 20, 0.2);
            color: var(--primary-color);
            padding: 4px 12px;
            border-radius: 15px;
            font-size: 0.75rem;
            font-weight: 500;
        }
        
        .btn-book {
            width: 100%;
            background: linear-gradient(135deg, var(--primary-color), #b20710);
            border: none;
            padding: 12px;
            border-radius: 10px;
            font-weight: 600;
            margin-top: 15px;
            transition: all 0.3s ease;
        }
        
        .btn-book:hover {
            transform: scale(1.02);
            box-shadow: 0 5px 15px rgba(229, 9, 20, 0.4);
        }
        
        /* Theater Cards */
        .theater-card {
            background: rgba(255, 255, 255, 0.05);
            border-radius: 15px;
            padding: 25px;
            transition: all 0.3s ease;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .theater-card:hover {
            background: rgba(255, 255, 255, 0.08);
            border-color: var(--accent-color);
        }
        
        .theater-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, var(--primary-color), #b20710);
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin-bottom: 15px;
        }
        
        .theater-name {
            font-weight: 600;
            font-size: 1.2rem;
            margin-bottom: 5px;
        }
        
        .theater-location {
            color: var(--text-muted);
            font-size: 0.9rem;
            margin-bottom: 15px;
        }
        
        .theater-amenities {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }
        
        .amenity-badge {
            background: rgba(245, 197, 24, 0.2);
            color: var(--accent-color);
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 500;
        }
        
        /* Seat Selection */
        .seat-map-container {
            background: rgba(255, 255, 255, 0.03);
            border-radius: 20px;
            padding: 30px;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .screen {
            background: linear-gradient(135deg, var(--accent-color), #c9a227);
            height: 8px;
            border-radius: 50%;
            margin-bottom: 50px;
            box-shadow: 0 10px 30px rgba(245, 197, 24, 0.3);
        }
        
        .screen-label {
            text-align: center;
            margin-bottom: 10px;
            color: var(--text-muted);
            font-size: 0.9rem;
            letter-spacing: 5px;
        }
        
        .seat-row {
            display: flex;
            justify-content: center;
            gap: 8px;
            margin-bottom: 8px;
        }
        
        .seat-row-label {
            width: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            color: var(--text-muted);
        }
        
        .seat {
            width: 35px;
            height: 35px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 8px 8px 3px 3px;
            cursor: pointer;
            transition: all 0.2s ease;
            border: 2px solid transparent;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.7rem;
        }
        
        .seat:hover:not(.occupied):not(.selected) {
            background: rgba(229, 9, 20, 0.3);
            border-color: var(--primary-color);
        }
        
        .seat.selected {
            background: var(--primary-color);
            border-color: var(--primary-color);
            box-shadow: 0 0 10px rgba(229, 9, 20, 0.5);
        }
        
        .seat.occupied {
            background: rgba(255, 255, 255, 0.03);
            cursor: not-allowed;
            color: rgba(255, 255, 255, 0.2);
        }
        
        .seat.premium {
            background: rgba(245, 197, 24, 0.2);
            border-color: var(--accent-color);
        }
        
        .seat.premium.selected {
            background: var(--accent-color);
            color: #000;
        }
        
        .seat-legend {
            display: flex;
            justify-content: center;
            gap: 30px;
            margin-top: 30px;
            flex-wrap: wrap;
        }
        
        .legend-item {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 0.85rem;
        }
        
        .legend-seat {
            width: 25px;
            height: 25px;
            border-radius: 5px;
        }
        
        /* Food & Beverages */
        .food-card {
            background: rgba(255, 255, 255, 0.05);
            border-radius: 15px;
            overflow: hidden;
            transition: all 0.3s ease;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .food-card:hover {
            transform: translateY(-5px);
            border-color: var(--accent-color);
        }
        
        .food-image {
            height: 150px;
            background: linear-gradient(135deg, #3d3d3d 0%, #2a2a2a 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3rem;
        }
        
        .food-info {
            padding: 20px;
        }
        
        .food-name {
            font-weight: 600;
            margin-bottom: 5px;
        }
        
        .food-description {
            color: var(--text-muted);
            font-size: 0.85rem;
            margin-bottom: 10px;
        }
        
        .food-price {
            font-weight: 700;
            color: var(--accent-color);
            font-size: 1.1rem;
        }
        
        .qty-control {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-top: 15px;
        }
        
        .qty-btn {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            border: 2px solid var(--primary-color);
            background: transparent;
            color: var(--primary-color);
            font-size: 1.2rem;
            cursor: pointer;
            transition: all 0.2s ease;
        }
        
        .qty-btn:hover {
            background: var(--primary-color);
            color: white;
        }
        
        .qty-value {
            font-weight: 600;
            font-size: 1.1rem;
            min-width: 30px;
            text-align: center;
        }
        
        /* Offers Section */
        .offer-card {
            background: linear-gradient(135deg, rgba(229, 9, 20, 0.2), rgba(178, 7, 16, 0.1));
            border-radius: 15px;
            padding: 25px;
            border: 1px dashed var(--primary-color);
            position: relative;
            overflow: hidden;
        }
        
        .offer-card::before {
            content: '';
            position: absolute;
            top: -50px;
            right: -50px;
            width: 100px;
            height: 100px;
            background: var(--primary-color);
            border-radius: 50%;
            opacity: 0.1;
        }
        
        .offer-discount {
            font-family: 'Bebas Neue', cursive;
            font-size: 3rem;
            color: var(--primary-color);
            line-height: 1;
        }
        
        .offer-title {
            font-weight: 600;
            font-size: 1.2rem;
            margin-bottom: 5px;
        }
        
        .offer-code {
            background: rgba(255, 255, 255, 0.1);
            padding: 8px 15px;
            border-radius: 8px;
            font-family: monospace;
            font-size: 1rem;
            letter-spacing: 2px;
            display: inline-block;
            margin-top: 10px;
        }
        
        /* Booking Summary */
        .booking-summary {
            background: rgba(255, 255, 255, 0.05);
            border-radius: 20px;
            padding: 30px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            position: sticky;
            top: 100px;
        }
        
        .summary-title {
            font-family: 'Bebas Neue', cursive;
            font-size: 1.8rem;
            letter-spacing: 2px;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .summary-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
            padding-bottom: 15px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }
        
        .summary-label {
            color: var(--text-muted);
        }
        
        .summary-value {
            font-weight: 600;
        }
        
        .summary-total {
            display: flex;
            justify-content: space-between;
            font-size: 1.3rem;
            font-weight: 700;
            margin-top: 20px;
            padding-top: 20px;
            border-top: 2px solid var(--primary-color);
        }
        
        .btn-checkout {
            width: 100%;
            background: linear-gradient(135deg, var(--primary-color), #b20710);
            border: none;
            padding: 15px;
            border-radius: 10px;
            font-weight: 600;
            font-size: 1.1rem;
            margin-top: 25px;
            transition: all 0.3s ease;
        }
        
        .btn-checkout:hover {
            transform: scale(1.02);
            box-shadow: 0 10px 30px rgba(229, 9, 20, 0.4);
        }
        
        /* Modal Styles */
        .modal-content {
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%);
            border: 1px solid rgba(229, 9, 20, 0.3);
            border-radius: 20px;
        }
        
        .modal-header {
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            padding: 25px 30px;
        }
        
        .modal-title {
            font-family: 'Bebas Neue', cursive;
            font-size: 1.8rem;
            letter-spacing: 2px;
        }
        
        .btn-close {
            filter: invert(1);
        }
        
        .modal-body {
            padding: 30px;
        }
        
        .form-control, .form-select {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: white;
            padding: 12px 20px;
            border-radius: 10px;
        }
        
        .form-control:focus, .form-select:focus {
            background: rgba(255, 255, 255, 0.08);
            border-color: var(--primary-color);
            box-shadow: 0 0 15px rgba(229, 9, 20, 0.2);
            color: white;
        }
        
        .form-control::placeholder {
            color: var(--text-muted);
        }
        
        .form-label {
            font-weight: 500;
            margin-bottom: 8px;
        }
        
        /* My Bookings */
        .booking-card {
            background: rgba(255, 255, 255, 0.05);
            border-radius: 15px;
            overflow: hidden;
            border: 1px solid rgba(255, 255, 255, 0.1);
            margin-bottom: 20px;
        }
        
        .booking-header {
            background: linear-gradient(135deg, var(--primary-color), #b20710);
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .booking-id {
            font-family: monospace;
            font-size: 0.9rem;
            opacity: 0.8;
        }
        
        .booking-status {
            background: rgba(255, 255, 255, 0.2);
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
        }
        
        .booking-status.confirmed {
            background: rgba(39, 174, 96, 0.3);
            color: #2ecc71;
        }
        
        .booking-status.pending {
            background: rgba(241, 196, 15, 0.3);
            color: #f1c40f;
        }
        
        .booking-status.cancelled {
            background: rgba(231, 76, 60, 0.3);
            color: #e74c3c;
        }
        
        .booking-body {
            padding: 25px;
        }
        
        .booking-movie {
            font-size: 1.3rem;
            font-weight: 600;
            margin-bottom: 15px;
        }
        
        .booking-details {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 20px;
        }
        
        .booking-detail {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .booking-detail i {
            color: var(--primary-color);
            font-size: 1.2rem;
        }
        
        .booking-detail-label {
            font-size: 0.8rem;
            color: var(--text-muted);
        }
        
        .booking-detail-value {
            font-weight: 600;
        }
        
        /* Reviews */
        .review-card {
            background: rgba(255, 255, 255, 0.05);
            border-radius: 15px;
            padding: 25px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            margin-bottom: 20px;
        }
        
        .review-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 15px;
        }
        
        .reviewer-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }
        
        .reviewer-avatar {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, var(--primary-color), #b20710);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 1.2rem;
        }
        
        .reviewer-name {
            font-weight: 600;
            margin-bottom: 3px;
        }
        
        .review-date {
            font-size: 0.85rem;
            color: var(--text-muted);
        }
        
        .review-rating {
            display: flex;
            gap: 3px;
        }
        
        .review-rating i {
            color: var(--accent-color);
        }
        
        .review-text {
            color: var(--text-muted);
            line-height: 1.7;
        }
        
        /* Footer */
        .footer {
            background: rgba(10, 10, 10, 0.95);
            padding: 60px 0 30px;
            border-top: 1px solid rgba(229, 9, 20, 0.2);
        }
        
        .footer-logo {
            font-family: 'Bebas Neue', cursive;
            font-size: 2rem;
            color: var(--primary-color);
            letter-spacing: 3px;
            margin-bottom: 20px;
        }
        
        .footer-description {
            color: var(--text-muted);
            max-width: 300px;
            line-height: 1.7;
        }
        
        .footer-title {
            font-weight: 600;
            font-size: 1.1rem;
            margin-bottom: 20px;
            position: relative;
            display: inline-block;
        }
        
        .footer-title::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 30px;
            height: 2px;
            background: var(--primary-color);
        }
        
        .footer-links {
            list-style: none;
        }
        
        .footer-links li {
            margin-bottom: 12px;
        }
        
        .footer-links a {
            color: var(--text-muted);
            text-decoration: none;
            transition: all 0.3s ease;
        }
        
        .footer-links a:hover {
            color: var(--primary-color);
            padding-left: 5px;
        }
        
        .social-links {
            display: flex;
            gap: 15px;
        }
        
        .social-link {
            width: 45px;
            height: 45px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-color);
            text-decoration: none;
            transition: all 0.3s ease;
        }
        
        .social-link:hover {
            background: var(--primary-color);
            transform: translateY(-3px);
        }
        
        .footer-bottom {
            border-top: 1px solid rgba(255, 255, 255, 0.05);
            padding-top: 30px;
            margin-top: 40px;
            text-align: center;
            color: var(--text-muted);
        }
        
        /* Show Timings */
        .time-slot {
            background: rgba(255, 255, 255, 0.05);
            border: 2px solid rgba(255, 255, 255, 0.1);
            padding: 12px 25px;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
            text-align: center;
        }
        
        .time-slot:hover {
            border-color: var(--primary-color);
            background: rgba(229, 9, 20, 0.1);
        }
        
        .time-slot.selected {
            border-color: var(--primary-color);
            background: var(--primary-color);
        }
        
        .time-slot-time {
            font-weight: 600;
            font-size: 1.1rem;
        }
        
        .time-slot-price {
            font-size: 0.85rem;
            color: var(--text-muted);
            margin-top: 5px;
        }
        
        .time-slot.selected .time-slot-price {
            color: rgba(255, 255, 255, 0.8);
        }
        
        /* Date Picker */
        .date-picker {
            display: flex;
            gap: 10px;
            overflow-x: auto;
            padding: 10px 0;
            margin-bottom: 20px;
        }
        
        .date-item {
            min-width: 70px;
            padding: 15px;
            background: rgba(255, 255, 255, 0.05);
            border: 2px solid rgba(255, 255, 255, 0.1);
            border-radius: 10px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .date-item:hover {
            border-color: var(--primary-color);
        }
        
        .date-item.selected {
            border-color: var(--primary-color);
            background: var(--primary-color);
        }
        
        .date-day {
            font-size: 0.8rem;
            color: var(--text-muted);
            text-transform: uppercase;
        }
        
        .date-item.selected .date-day {
            color: rgba(255, 255, 255, 0.8);
        }
        
        .date-num {
            font-size: 1.5rem;
            font-weight: 700;
        }
        
        /* Notifications */
        .notification-item {
            background: rgba(255, 255, 255, 0.05);
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 15px;
            border-left: 4px solid var(--primary-color);
            transition: all 0.3s ease;
        }
        
        .notification-item:hover {
            background: rgba(255, 255, 255, 0.08);
        }
        
        .notification-item.unread {
            border-left-color: var(--accent-color);
        }
        
        .notification-title {
            font-weight: 600;
            margin-bottom: 5px;
        }
        
        .notification-text {
            color: var(--text-muted);
            font-size: 0.9rem;
        }
        
        .notification-time {
            font-size: 0.8rem;
            color: var(--text-muted);
            margin-top: 10px;
        }
        
        /* Contact Form */
        .contact-info {
            background: rgba(255, 255, 255, 0.05);
            border-radius: 15px;
            padding: 30px;
            height: 100%;
        }
        
        .contact-item {
            display: flex;
            align-items: flex-start;
            gap: 15px;
            margin-bottom: 25px;
        }
        
        .contact-icon {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, var(--primary-color), #b20710);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            flex-shrink: 0;
        }
        
        .contact-label {
            font-size: 0.85rem;
            color: var(--text-muted);
            margin-bottom: 3px;
        }
        
        .contact-value {
            font-weight: 600;
        }
        
        /* About Section */
        .about-feature {
            text-align: center;
            padding: 30px;
        }
        
        .about-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, var(--primary-color), #b20710);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            margin: 0 auto 20px;
        }
        
        .about-title {
            font-weight: 600;
            font-size: 1.2rem;
            margin-bottom: 10px;
        }
        
        .about-text {
            color: var(--text-muted);
            font-size: 0.9rem;
        }
        
        /* Toast Notification */
        .toast-container {
            position: fixed;
            top: 100px;
            right: 20px;
            z-index: 9999;
        }
        
        .custom-toast {
            background: linear-gradient(135deg, #1a1a2e, #16213e);
            border: 1px solid var(--primary-color);
            border-radius: 12px;
            padding: 15px 25px;
            color: white;
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 10px;
            animation: slideIn 0.3s ease;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
        }
        
        @keyframes slideIn {
            from {
                transform: translateX(100%);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }
        
        .toast-icon {
            font-size: 1.5rem;
        }
        
        .toast-success .toast-icon {
            color: #2ecc71;
        }
        
        .toast-error .toast-icon {
            color: #e74c3c;
        }
        
        .toast-info .toast-icon {
            color: #3498db;
        }
        
        /* Section backgrounds */
        .section {
            padding: 80px 0;
        }
        
        .section-alt {
            background: rgba(0, 0, 0, 0.3);
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.5rem;
            }
            
            .hero-subtitle {
                font-size: 1rem;
            }
            
            .section-title {
                font-size: 2rem;
            }
            
            .movie-poster {
                height: 250px;
            }
            
            .seat {
                width: 28px;
                height: 28px;
            }
            
            .booking-summary {
                position: static;
                margin-top: 30px;
            }
        }
        
        /* Loading Spinner */
        .spinner {
            width: 20px;
            height: 20px;
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-top-color: white;
            border-radius: 50%;
            animation: spin 0.8s linear infinite;
            display: inline-block;
        }
        
        @keyframes spin {
            to { transform: rotate(360deg); }
        }
        
        /* Page sections visibility */
        .page-section {
            display: none;
        }
        
        .page-section.active {
            display: block;
        }
        
        /* Payment Form */
        .payment-form-container {
            background: rgba(255, 255, 255, 0.05);
            border-radius: 20px;
            padding: 35px;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .order-summary-box {
            background: rgba(255, 255, 255, 0.05);
            border-radius: 20px;
            padding: 30px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            position: sticky;
            top: 100px;
        }
        
        .payment-success-modal {
            background: linear-gradient(135deg, #1a1a2e, #16213e);
            border-radius: 20px;
            padding: 40px;
            text-align: center;
            max-width: 600px;
            margin: 0 auto;
        }
        
        .success-icon {
            width: 100px;
            height: 100px;
            background: linear-gradient(135deg, #2ecc71, #27ae60);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 25px;
            font-size: 3rem;
            animation: scaleIn 0.5s ease;
        }
        
        @keyframes scaleIn {
            from {
                transform: scale(0);
                opacity: 0;
            }
            to {
                transform: scale(1);
                opacity: 1;
            }
        }
        
        .payment-detail-item {
            display: flex;
            justify-content: space-between;
            padding: 12px 0;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }
        
        .payment-detail-label {
            color: var(--text-muted);
            font-size: 0.9rem;
        }
        
        .payment-detail-value {
            font-weight: 600;
            font-size: 0.95rem;
        }
        
        /* Delete Confirmation */
        .delete-confirm {
            display: inline-flex;
            gap: 5px;
        }
        
        .btn-confirm-delete {
            background: #e74c3c;
            border: none;
            padding: 5px 15px;
            border-radius: 5px;
            font-size: 0.8rem;
        }
        
        .btn-cancel-delete {
            background: rgba(255, 255, 255, 0.1);
            border: none;
            padding: 5px 15px;
            border-radius: 5px;
            font-size: 0.8rem;
        }
    </style>
  <style>@view-transition { navigation: auto; }</style>
  <script src="https://cdn.tailwindcss.com" type="text/javascript"></script>
 </head>
 <body class="h-full">
  <div class="app-wrapper" id="appWrapper"><!-- Toast Container -->
   <div class="toast-container" id="toastContainer"></div><!-- Navigation -->
   <nav class="navbar navbar-expand-lg navbar-custom fixed-top">
    <div class="container"><a class="navbar-brand" href="#" data-page="home"> <i class="bi bi-film"></i> <span id="siteName">CINEMAX</span> </a> <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"> <span class="navbar-toggler-icon"></span> </button>
     <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav mx-auto">
       <li class="nav-item"><a class="nav-link" href="#" data-page="home">Home</a></li>
       <li class="nav-item"><a class="nav-link" href="#" data-page="now-showing">Now Showing</a></li>
       <li class="nav-item"><a class="nav-link" href="#" data-page="upcoming">Upcoming</a></li>
       <li class="nav-item"><a class="nav-link" href="#" data-page="theaters">Theaters</a></li>
       <li class="nav-item"><a class="nav-link" href="#" data-page="offers">Offers</a></li>
       <li class="nav-item"><a class="nav-link" href="#" data-page="food">Food</a></li>
      </ul>
      <div class="d-flex align-items-center gap-3"><a href="#" class="nav-link" data-page="bookings"> <i class="bi bi-ticket-perforated me-1"></i> My Bookings </a> <button class="btn btn-login" id="loginBtn"> <i class="bi bi-person-circle me-2"></i>Login </button>
      </div>
     </div>
    </div>
   </nav><!-- Main Content -->
   <main id="mainContent" style="padding-top: 80px;"><!-- Home Page -->
    <div class="page-section active" id="page-home"><!-- Hero Section -->
     <section class="hero-section">
      <div class="container">
       <div class="row align-items-center">
        <div class="col-lg-6 hero-content">
         <h1 class="hero-title" id="heroTitle">BOOK YOUR MOVIE EXPERIENCE</h1>
         <p class="hero-subtitle" id="heroSubtitle">Discover the latest blockbusters, reserve your seats, and enjoy cinema like never before.</p>
         <div class="search-box d-flex"><input type="text" placeholder="Search for movies, theaters..." id="searchInput"> <button class="btn btn-search" id="searchBtn"> <i class="bi bi-search"></i> Search </button>
         </div>
         <div class="mt-4 d-flex gap-3 flex-wrap" style="animation: fadeInUp 1s ease 0.6s both;"><span class="badge bg-danger p-2">🎬 100+ Movies</span> <span class="badge bg-warning text-dark p-2">🏆 Premium Experience</span> <span class="badge bg-info p-2">🍿 Food &amp; Drinks</span>
         </div>
        </div>
        <div class="col-lg-6 d-none d-lg-block text-center">
         <div style="font-size: 15rem; animation: pulse 3s infinite;">
          🎬
         </div>
        </div>
       </div>
      </div>
     </section><!-- Now Showing Preview -->
     <section class="section" id="nowShowingSection">
      <div class="container">
       <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="section-title">NOW SHOWING</h2><a href="#" class="btn btn-outline-danger" data-page="now-showing">View All <i class="bi bi-arrow-right"></i></a>
       </div>
       <div class="row g-4" id="nowShowingMovies"><!-- Movies will be rendered here -->
       </div>
      </div>
     </section><!-- Upcoming Preview -->
     <section class="section section-alt">
      <div class="container">
       <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="section-title">COMING SOON</h2><a href="#" class="btn btn-outline-warning" data-page="upcoming">View All <i class="bi bi-arrow-right"></i></a>
       </div>
       <div class="row g-4" id="upcomingMovies"><!-- Movies will be rendered here -->
       </div>
      </div>
     </section><!-- Offers Preview -->
     <section class="section">
      <div class="container">
       <h2 class="section-title">EXCLUSIVE OFFERS</h2>
       <div class="row g-4" id="offersPreview"><!-- Offers will be rendered here -->
       </div>
      </div>
     </section>
    </div><!-- Now Showing Page -->
    <div class="page-section" id="page-now-showing">
     <section class="section">
      <div class="container">
       <h2 class="section-title">NOW SHOWING</h2>
       <div class="row g-4" id="allNowShowingMovies"><!-- All now showing movies -->
       </div>
      </div>
     </section>
    </div><!-- Upcoming Page -->
    <div class="page-section" id="page-upcoming">
     <section class="section">
      <div class="container">
       <h2 class="section-title">UPCOMING MOVIES</h2>
       <div class="row g-4" id="allUpcomingMovies"><!-- All upcoming movies -->
       </div>
      </div>
     </section>
    </div><!-- Movie Details Page -->
    <div class="page-section" id="page-movie-details">
     <section class="section">
      <div class="container">
       <div id="movieDetailsContent"><!-- Movie details will be rendered here -->
       </div>
      </div>
     </section>
    </div><!-- Theaters Page -->
    <div class="page-section" id="page-theaters">
     <section class="section">
      <div class="container">
       <h2 class="section-title">OUR THEATERS</h2>
       <div class="row g-4" id="theatersList"><!-- Theaters will be rendered here -->
       </div>
      </div>
     </section>
    </div><!-- Book Tickets Page -->
    <div class="page-section" id="page-book-tickets">
     <section class="section">
      <div class="container">
       <div class="row">
        <div class="col-lg-8">
         <div id="bookingContent"><!-- Booking content will be rendered here -->
         </div>
        </div>
        <div class="col-lg-4">
         <div class="booking-summary" id="bookingSummary">
          <h3 class="summary-title">BOOKING SUMMARY</h3>
          <div id="summaryContent">
           <p class="text-muted">Select a movie and show time to continue</p>
          </div>
         </div>
        </div>
       </div>
      </div>
     </section>
    </div><!-- Offers Page -->
    <div class="page-section" id="page-offers">
     <section class="section">
      <div class="container">
       <h2 class="section-title">OFFERS &amp; DISCOUNTS</h2>
       <div class="row g-4" id="allOffers"><!-- All offers will be rendered here -->
       </div>
      </div>
     </section>
    </div><!-- Food Page -->
    <div class="page-section" id="page-food">
     <section class="section">
      <div class="container">
       <h2 class="section-title">FOOD &amp; BEVERAGES</h2>
       <div class="row g-4" id="foodMenu"><!-- Food menu will be rendered here -->
       </div>
      </div>
     </section>
    </div><!-- My Bookings Page -->
    <div class="page-section" id="page-bookings">
     <section class="section">
      <div class="container">
       <h2 class="section-title">MY BOOKINGS</h2>
       <div id="bookingsList"><!-- User bookings will be rendered here -->
       </div>
      </div>
     </section>
    </div><!-- Reviews Page -->
    <div class="page-section" id="page-reviews">
     <section class="section">
      <div class="container">
       <h2 class="section-title">REVIEWS &amp; RATINGS</h2>
       <div id="reviewsList"><!-- Reviews will be rendered here -->
       </div>
      </div>
     </section>
    </div><!-- Notifications Page -->
    <div class="page-section" id="page-notifications">
     <section class="section">
      <div class="container">
       <h2 class="section-title">NOTIFICATIONS</h2>
       <div id="notificationsList"><!-- Notifications will be rendered here -->
       </div>
      </div>
     </section>
    </div><!-- Help Page -->
    <div class="page-section" id="page-help">
     <section class="section">
      <div class="container">
       <h2 class="section-title">HELP &amp; SUPPORT</h2>
       <div class="row g-4">
        <div class="col-lg-8">
         <div class="accordion" id="faqAccordion">
          <div class="accordion-item" style="background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1);">
           <h2 class="accordion-header"><button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq1" style="background: rgba(255,255,255,0.05); color: white;"> How do I book tickets? </button></h2>
           <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
            <div class="accordion-body" style="color: var(--text-muted);">
             Select a movie from Now Showing, choose your preferred theater and show time, select your seats, add any food items, and proceed to checkout. You'll receive a confirmation with your booking details.
            </div>
           </div>
          </div>
          <div class="accordion-item" style="background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1);">
           <h2 class="accordion-header"><button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2" style="background: rgba(255,255,255,0.05); color: white;"> Can I cancel my booking? </button></h2>
           <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
            <div class="accordion-body" style="color: var(--text-muted);">
             Yes, you can cancel your booking up to 2 hours before the show time. Go to My Bookings, find your booking, and click on Cancel. Refunds will be processed within 5-7 business days.
            </div>
           </div>
          </div>
          <div class="accordion-item" style="background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1);">
           <h2 class="accordion-header"><button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3" style="background: rgba(255,255,255,0.05); color: white;"> How do I apply discount codes? </button></h2>
           <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
            <div class="accordion-body" style="color: var(--text-muted);">
             During checkout, you'll see a field to enter your promo code. Enter the code and click Apply. The discount will be reflected in your total amount.
            </div>
           </div>
          </div>
         </div>
        </div>
        <div class="col-lg-4">
         <div class="contact-info">
          <h4 class="mb-4">Need More Help?</h4>
          <div class="contact-item">
           <div class="contact-icon">
            <i class="bi bi-telephone"></i>
           </div>
           <div>
            <div class="contact-label">
             Call Us
            </div>
            <div class="contact-value">
             1800-123-4567
            </div>
           </div>
          </div>
          <div class="contact-item">
           <div class="contact-icon">
            <i class="bi bi-envelope"></i>
           </div>
           <div>
            <div class="contact-label">
             Email
            </div>
            <div class="contact-value">
             support@cinemax.com
            </div>
           </div>
          </div>
          <div class="contact-item">
           <div class="contact-icon">
            <i class="bi bi-chat-dots"></i>
           </div>
           <div>
            <div class="contact-label">
             Live Chat
            </div>
            <div class="contact-value">
             Available 24/7
            </div>
           </div>
          </div>
         </div>
        </div>
       </div>
      </div>
     </section>
    </div><!-- Contact Page -->
    <div class="page-section" id="page-contact">
     <section class="section">
      <div class="container">
       <h2 class="section-title">CONTACT US</h2>
       <div class="row g-4">
        <div class="col-lg-6">
         <form id="contactForm">
          <div class="mb-3"><label class="form-label">Your Name</label> <input type="text" class="form-control" id="contactName" required>
          </div>
          <div class="mb-3"><label class="form-label">Email Address</label> <input type="email" class="form-control" id="contactEmail" required>
          </div>
          <div class="mb-3"><label class="form-label">Subject</label> <select class="form-select" id="contactSubject"> <option>General Inquiry</option> <option>Booking Issue</option> <option>Refund Request</option> <option>Feedback</option> <option>Other</option> </select>
          </div>
          <div class="mb-3"><label class="form-label">Message</label> <textarea class="form-control" rows="5" id="contactMessage" required></textarea>
          </div><button type="submit" class="btn btn-login w-100"> <i class="bi bi-send me-2"></i>Send Message </button>
         </form>
        </div>
        <div class="col-lg-6">
         <div class="contact-info h-100">
          <h4 class="mb-4">Get In Touch</h4>
          <div class="contact-item">
           <div class="contact-icon">
            <i class="bi bi-geo-alt"></i>
           </div>
           <div>
            <div class="contact-label">
             Address
            </div>
            <div class="contact-value">
             123 Cinema Street, Movie City, MC 12345
            </div>
           </div>
          </div>
          <div class="contact-item">
           <div class="contact-icon">
            <i class="bi bi-telephone"></i>
           </div>
           <div>
            <div class="contact-label">
             Phone
            </div>
            <div class="contact-value">
             1800-123-4567
            </div>
           </div>
          </div>
          <div class="contact-item">
           <div class="contact-icon">
            <i class="bi bi-envelope"></i>
           </div>
           <div>
            <div class="contact-label">
             Email
            </div>
            <div class="contact-value">
             info@cinemax.com
            </div>
           </div>
          </div>
          <div class="contact-item">
           <div class="contact-icon">
            <i class="bi bi-clock"></i>
           </div>
           <div>
            <div class="contact-label">
             Working Hours
            </div>
            <div class="contact-value">
             Mon - Sun: 9:00 AM - 11:00 PM
            </div>
           </div>
          </div>
          <div class="mt-4">
           <h5 class="mb-3">Follow Us</h5>
           <div class="social-links"><a href="#" class="social-link"><i class="bi bi-facebook"></i></a> <a href="#" class="social-link"><i class="bi bi-twitter-x"></i></a> <a href="#" class="social-link"><i class="bi bi-instagram"></i></a> <a href="#" class="social-link"><i class="bi bi-youtube"></i></a>
           </div>
          </div>
         </div>
        </div>
       </div>
      </div>
     </section>
    </div><!-- About Page -->
    <div class="page-section" id="page-about">
     <section class="section">
      <div class="container">
       <h2 class="section-title">ABOUT US</h2>
       <div class="row mb-5">
        <div class="col-lg-6">
         <p style="color: var(--text-muted); line-height: 1.8; font-size: 1.1rem;">Welcome to <strong style="color: var(--primary-color);">CineMax</strong>, your premier destination for the ultimate movie experience. Since our establishment, we've been committed to bringing the magic of cinema to audiences with state-of-the-art technology, comfortable seating, and exceptional service.</p>
         <p style="color: var(--text-muted); line-height: 1.8; font-size: 1.1rem;">Our mission is to create unforgettable entertainment experiences that bring people together. With multiple screens featuring the latest releases and classic favorites, premium sound systems, and a diverse selection of refreshments, we ensure every visit is special.</p>
        </div>
        <div class="col-lg-6 text-center">
         <div style="font-size: 10rem;">
          🎭
         </div>
        </div>
       </div>
       <div class="row g-4">
        <div class="col-md-3">
         <div class="about-feature">
          <div class="about-icon">
           🎬
          </div>
          <h4 class="about-title">100+ Movies</h4>
          <p class="about-text">Wide selection of latest blockbusters and classic films</p>
         </div>
        </div>
        <div class="col-md-3">
         <div class="about-feature">
          <div class="about-icon">
           🏢
          </div>
          <h4 class="about-title">15+ Theaters</h4>
          <p class="about-text">Premium locations across the city with modern facilities</p>
         </div>
        </div>
        <div class="col-md-3">
         <div class="about-feature">
          <div class="about-icon">
           🎧
          </div>
          <h4 class="about-title">Dolby Atmos</h4>
          <p class="about-text">Immersive audio experience with cutting-edge technology</p>
         </div>
        </div>
        <div class="col-md-3">
         <div class="about-feature">
          <div class="about-icon">
           ⭐
          </div>
          <h4 class="about-title">1M+ Customers</h4>
          <p class="about-text">Trusted by millions of happy moviegoers</p>
         </div>
        </div>
       </div>
      </div>
     </section>
    </div><!-- Payment Page -->
    <div class="page-section" id="page-payment">
     <section class="section">
      <div class="container">
       <h2 class="section-title">PAYMENT CHECKOUT</h2>
       <div class="row">
        <div class="col-lg-7">
         <div class="payment-form-container">
          <form id="paymentForm" method="post" action="booking_success.php">
           <h5 class="mb-4">Payment Information</h5><!-- Payment Method -->
           <div class="mb-4"><label for="paymentMethod" class="form-label">Payment Method *</label> <select class="form-select" id="paymentMethod" required> <option value="">Select Payment Method</option> <option value="credit-card">Credit Card</option> <option value="debit-card">Debit Card</option> <option value="paypal">PayPal</option> </select>
           </div><!-- Card Details (shown only for card payments) -->
           <div id="cardDetails" style="display: none;">
            <div class="mb-3"><label for="cardholderName" class="form-label">Cardholder Name *</label> <input type="text" class="form-control" id="cardholderName" placeholder="John Doe">
            </div>
            <div class="mb-3"><label for="cardNumber" class="form-label">Card Number *</label> <input type="text" class="form-control" id="cardNumber" placeholder="1234 5678 9012 3456" maxlength="19"> <small class="text-muted">Enter 16-digit card number</small>
            </div>
            <div class="row">
             <div class="col-md-4">
              <div class="mb-3"><label for="expiryMonth" class="form-label">Expiry Month *</label> <select class="form-select" id="expiryMonth"> <option value="">MM</option> <option value="01">01</option> <option value="02">02</option> <option value="03">03</option> <option value="04">04</option> <option value="05">05</option> <option value="06">06</option> <option value="07">07</option> <option value="08">08</option> <option value="09">09</option> <option value="10">10</option> <option value="11">11</option> <option value="12">12</option> </select>
              </div>
             </div>
             <div class="col-md-4">
              <div class="mb-3"><label for="expiryYear" class="form-label">Expiry Year *</label> <select class="form-select" id="expiryYear"> <option value="">YYYY</option> <option value="2024">2024</option> <option value="2025">2025</option> <option value="2026">2026</option> <option value="2027">2027</option> <option value="2028">2028</option> <option value="2029">2029</option> <option value="2030">2030</option> </select>
              </div>
             </div>
             <div class="col-md-4">
              <div class="mb-3"><label for="cvv" class="form-label">CVV *</label> <input type="text" class="form-control" id="cvv" placeholder="123" maxlength="3">
              </div>
             </div>
            </div>
           </div><!-- PayPal Details -->
           <div id="paypalDetails" style="display: none;">
            <div class="mb-3"><label for="paypalEmail" class="form-label">PayPal Email *</label> <input type="email" class="form-control" id="paypalEmail" placeholder="your@email.com">
            </div>
            <div class="alert" style="background: rgba(0, 123, 255, 0.1); border: 1px solid rgba(0, 123, 255, 0.3); color: #4dabf7;"><i class="bi bi-info-circle me-2"></i>You will be redirected to PayPal to complete your payment.
            </div>
           </div>
           <hr style="border-color: rgba(255,255,255,0.1); margin: 30px 0;"><!-- Billing Information -->
           <h5 class="mb-4">Billing Information</h5>
           <div class="mb-3"><label for="billingName" class="form-label">Full Name *</label> <input type="text" class="form-control" id="billingName" required>
           </div>
           <div class="mb-3"><label for="billingEmail" class="form-label">Email Address *</label> <input type="email" class="form-control" id="billingEmail" required>
           </div>
           <div class="mb-3"><label for="billingPhone" class="form-label">Phone Number *</label> <input type="tel" class="form-control" id="billingPhone" required>
           </div>
           <div class="mb-3"><label for="billingAddress" class="form-label">Address *</label> <textarea class="form-control" id="billingAddress" rows="2" required></textarea>
           </div>
           <div class="row">
            <div class="col-md-6">
             <div class="mb-3"><label for="billingCity" class="form-label">City *</label> <input type="text" class="form-control" id="billingCity" required>
             </div>
            </div>
            <div class="col-md-6">
             <div class="mb-3"><label for="billingZip" class="form-label">ZIP Code *</label> <input type="text" class="form-control" id="billingZip" required>
             </div>
            </div>
           </div>
           <div class="form-check mb-4"><input class="form-check-input" type="checkbox" id="termsCheck" required> <label class="form-check-label" for="termsCheck"> I agree to the Terms &amp; Conditions and Privacy Policy </label>
           </div>
           <div class="d-flex gap-3"><button type="button" class="btn btn-outline-light" onclick="renderFoodSelection()"> <i class="bi bi-arrow-left me-2"></i>Back </button> <button type="submit" class="btn btn-login btn-lg flex-grow-1" id="submitPaymentBtn"> <i class="bi bi-lock me-2"></i>Complete Payment </button>
           </div>
          </form>
         </div>
        </div>
        <div class="col-lg-5">
         <div class="order-summary-box">
          <h4 class="summary-title">ORDER SUMMARY</h4>
          <div id="orderSummaryContent"><!-- Order summary will be populated here -->
          </div>
         </div>
        </div>
       </div>
      </div>
     </section>
    </div>
   </main><!-- Footer -->
   <footer class="footer">
    <div class="container">
     <div class="row g-4">
      <div class="col-lg-4">
       <div class="footer-logo"><i class="bi bi-film"></i> CINEMAX
       </div>
       <p class="footer-description">Your ultimate destination for movie magic. Experience cinema like never before with premium screens, immersive sound, and unforgettable moments.</p>
       <div class="social-links mt-4"><a href="#" class="social-link"><i class="bi bi-facebook"></i></a> <a href="#" class="social-link"><i class="bi bi-twitter-x"></i></a> <a href="#" class="social-link"><i class="bi bi-instagram"></i></a> <a href="#" class="social-link"><i class="bi bi-youtube"></i></a>
       </div>
      </div>
      <div class="col-lg-2 col-md-4">
       <h5 class="footer-title">Quick Links</h5>
       <ul class="footer-links">
        <li><a href="#" data-page="home">Home</a></li>
        <li><a href="#" data-page="now-showing">Now Showing</a></li>
        <li><a href="#" data-page="upcoming">Upcoming</a></li>
        <li><a href="#" data-page="theaters">Theaters</a></li>
        <li><a href="#" data-page="offers">Offers</a></li>
       </ul>
      </div>
      <div class="col-lg-2 col-md-4">
       <h5 class="footer-title">Support</h5>
       <ul class="footer-links">
        <li><a href="#" data-page="help">Help &amp; FAQ</a></li>
        <li><a href="#" data-page="contact">Contact Us</a></li>
        <li><a href="#" data-page="about">About Us</a></li>
        <li><a href="#">Terms &amp; Conditions</a></li>
        <li><a href="#">Privacy Policy</a></li>
       </ul>
      </div>
      <div class="col-lg-4 col-md-4">
       <h5 class="footer-title">Newsletter</h5>
       <p style="color: var(--text-muted); font-size: 0.9rem;">Subscribe to get exclusive offers and movie updates!</p>
       <form class="mt-3" id="newsletterForm">
        <div class="input-group"><input type="email" class="form-control" placeholder="Your email address" id="newsletterEmail"> <button class="btn btn-login" type="submit">Subscribe</button>
        </div>
       </form>
      </div>
     </div>
     <div class="footer-bottom">
      <p>© 2024 CineMax. All rights reserved. Made with ❤️ for movie lovers.</p>
     </div>
    </div>
   </footer><!-- Login Modal -->
   <div class="modal fade" id="loginModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
     <div class="modal-content">
      <div class="modal-header">
       <h5 class="modal-title" id="loginModalLabel">LOGIN</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
       <ul class="nav nav-tabs mb-4" id="authTabs">
        <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab" href="#loginTab" style="color: white;">Login</a></li>
        <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#registerTab" style="color: white;">Register</a></li>
       </ul>
       <div class="tab-content">
        <div class="tab-pane fade show active" id="loginTab">
         <form id="loginForm">
          <div class="mb-3"><label class="form-label">Email</label> <input type="email" class="form-control" id="loginEmail" required>
          </div>
          <div class="mb-3"><label class="form-label">Password</label> <input type="password" class="form-control" id="loginPassword" required>
          </div>
          <div class="d-flex justify-content-between align-items-center mb-3">
           <div class="form-check"><input class="form-check-input" type="checkbox" id="rememberMe"> <label class="form-check-label" for="rememberMe">Remember me</label>
           </div><a href="#" style="color: var(--primary-color);">Forgot Password?</a>
          </div><button type="submit" class="btn btn-login w-100">Login</button>
         </form>
        </div>
        <div class="tab-pane fade" id="registerTab">
         <form id="registerForm">
          <div class="mb-3"><label class="form-label">Full Name</label> <input type="text" class="form-control" id="registerName" required>
          </div>
          <div class="mb-3"><label class="form-label">Email</label> <input type="email" class="form-control" id="registerEmail" required>
          </div>
          <div class="mb-3"><label class="form-label">Phone</label> <input type="tel" class="form-control" id="registerPhone" required>
          </div>
          <div class="mb-3"><label class="form-label">Password</label> <input type="password" class="form-control" id="registerPassword" required>
          </div><button type="submit" class="btn btn-login w-100">Create Account</button>
         </form>
        </div>
       </div>
      </div>
     </div>
    </div>
   </div>
  </div>
  <script>
        // ==================== DATA ====================
        const moviesData = {
            nowShowing: [
                { id: 'movie1', title: 'Cosmic Odyssey', genre: ['Sci-Fi', 'Adventure'], rating: 8.7, duration: '2h 35m', language: 'English', emoji: '🚀', release: '2024' },
                { id: 'movie2', title: 'The Shadow Protocol', genre: ['Action', 'Thriller'], rating: 8.4, duration: '2h 15m', language: 'English', emoji: '🕵️', release: '2024' },
                { id: 'movie3', title: 'Hearts Entwined', genre: ['Romance', 'Drama'], rating: 7.9, duration: '2h 05m', language: 'English', emoji: '💕', release: '2024' },
                { id: 'movie4', title: 'Laugh Factory', genre: ['Comedy'], rating: 7.5, duration: '1h 50m', language: 'English', emoji: '😂', release: '2024' },
                { id: 'movie5', title: 'Nightmare Lane', genre: ['Horror', 'Mystery'], rating: 8.1, duration: '2h 00m', language: 'English', emoji: '👻', release: '2024' },
                { id: 'movie6', title: 'Racing Thunder', genre: ['Action', 'Sports'], rating: 8.0, duration: '2h 10m', language: 'English', emoji: '🏎️', release: '2024' }
            ],
            upcoming: [
                { id: 'movie7', title: 'Dragon\'s Legacy', genre: ['Fantasy', 'Adventure'], rating: 0, duration: '2h 45m', language: 'English', emoji: '🐉', release: 'Dec 25' },
                { id: 'movie8', title: 'Ocean\'s Mystery', genre: ['Mystery', 'Drama'], rating: 0, duration: '2h 20m', language: 'English', emoji: '🌊', release: 'Jan 10' },
                { id: 'movie9', title: 'Super Squad', genre: ['Action', 'Superhero'], rating: 0, duration: '2h 30m', language: 'English', emoji: '🦸', release: 'Jan 20' },
                { id: 'movie10', title: 'Love in Paris', genre: ['Romance', 'Comedy'], rating: 0, duration: '1h 55m', language: 'English', emoji: '🗼', release: 'Feb 14' }
            ]
        };

        const theatersData = [
            { id: 't1', name: 'CineMax Central', location: 'Downtown Mall, City Center', amenities: ['IMAX', 'Dolby Atmos', 'Recliner'], screens: 8 },
            { id: 't2', name: 'CineMax Metro', location: 'Metro Plaza, East Side', amenities: ['4DX', 'Dolby', 'Premium'], screens: 6 },
            { id: 't3', name: 'CineMax Galleria', location: 'Galleria Shopping Center', amenities: ['IMAX', '3D', 'VIP Lounge'], screens: 10 },
            { id: 't4', name: 'CineMax Riverside', location: 'Riverside Drive, West End', amenities: ['Dolby Atmos', 'Recliner', 'Parking'], screens: 5 }
        ];

        const showTimings = ['10:00 AM', '1:30 PM', '4:45 PM', '7:30 PM', '10:15 PM'];

        const foodItems = [
            { id: 'f1', name: 'Large Popcorn', description: 'Classic buttered popcorn', price: 250, emoji: '🍿', category: 'Snacks' },
            { id: 'f2', name: 'Nachos Supreme', description: 'Crispy nachos with cheese & salsa', price: 320, emoji: '🧀', category: 'Snacks' },
            { id: 'f3', name: 'Cola Large', description: 'Refreshing cold drink', price: 150, emoji: '🥤', category: 'Beverages' },
            { id: 'f4', name: 'Hot Dog Combo', description: 'Hot dog with fries & drink', price: 380, emoji: '🌭', category: 'Combos' },
            { id: 'f5', name: 'Ice Cream Sundae', description: 'Vanilla with chocolate sauce', price: 180, emoji: '🍨', category: 'Desserts' },
            { id: 'f6', name: 'Movie Combo', description: 'Popcorn + 2 Drinks + Nachos', price: 550, emoji: '🎬', category: 'Combos' }
        ];

        const offersData = [
            { id: 'o1', discount: '20% OFF', title: 'Weekday Special', description: 'Book any movie Mon-Thu and get 20% off', code: 'WEEKDAY20', validTill: 'Dec 31, 2024' },
            { id: 'o2', discount: '₹100 OFF', title: 'First Booking', description: 'Get ₹100 off on your first booking', code: 'FIRST100', validTill: 'Dec 31, 2024' },
            { id: 'o3', discount: 'BOGO', title: 'Buy 1 Get 1', description: 'Buy 1 ticket, get 1 free on select shows', code: 'BOGO2024', validTill: 'Dec 15, 2024' },
            { id: 'o4', discount: '30% OFF', title: 'Food Combo Deal', description: '30% off on all food combos', code: 'FOOD30', validTill: 'Dec 31, 2024' }
        ];

        // ==================== STATE ====================
        let currentUser = null;
        let selectedMovie = null;
        let selectedTheater = null;
        let selectedDate = null;
        let selectedTime = null;
        let selectedSeats = [];
        let selectedFood = {};
        let userBookings = [];
        let recordCount = 0;

        // ==================== DEFAULT CONFIG ====================
        const defaultConfig = {
            site_name: 'CINEMAX',
            tagline: 'Experience Cinema Like Never Before',
            hero_title: 'BOOK YOUR MOVIE EXPERIENCE',
            hero_subtitle: 'Discover the latest blockbusters, reserve your seats, and enjoy cinema like never before.',
            primary_color: '#e50914',
            secondary_color: '#141414',
            accent_color: '#f5c518',
            text_color: '#ffffff',
            background_color: '#0a0a0a'
        };

        // ==================== ELEMENT SDK ====================
        if (window.elementSdk) {
            window.elementSdk.init({
                defaultConfig,
                onConfigChange: async (config) => {
                    // Update site name
                    const siteNameEl = document.getElementById('siteName');
                    if (siteNameEl) siteNameEl.textContent = config.site_name || defaultConfig.site_name;

                    // Update hero content
                    const heroTitleEl = document.getElementById('heroTitle');
                    if (heroTitleEl) heroTitleEl.textContent = config.hero_title || defaultConfig.hero_title;

                    const heroSubtitleEl = document.getElementById('heroSubtitle');
                    if (heroSubtitleEl) heroSubtitleEl.textContent = config.hero_subtitle || defaultConfig.hero_subtitle;

                    // Update colors
                    const primaryColor = config.primary_color || defaultConfig.primary_color;
                    const accentColor = config.accent_color || defaultConfig.accent_color;
                    const backgroundColor = config.background_color || defaultConfig.background_color;
                    const textColor = config.text_color || defaultConfig.text_color;

                    document.documentElement.style.setProperty('--primary-color', primaryColor);
                    document.documentElement.style.setProperty('--accent-color', accentColor);
                    document.documentElement.style.setProperty('--secondary-color', backgroundColor);
                    document.documentElement.style.setProperty('--text-color', textColor);
                },
                mapToCapabilities: (config) => ({
                    recolorables: [
                        {
                            get: () => config.background_color || defaultConfig.background_color,
                            set: (value) => { config.background_color = value; window.elementSdk.setConfig({ background_color: value }); }
                        },
                        {
                            get: () => config.primary_color || defaultConfig.primary_color,
                            set: (value) => { config.primary_color = value; window.elementSdk.setConfig({ primary_color: value }); }
                        },
                        {
                            get: () => config.accent_color || defaultConfig.accent_color,
                            set: (value) => { config.accent_color = value; window.elementSdk.setConfig({ accent_color: value }); }
                        },
                        {
                            get: () => config.text_color || defaultConfig.text_color,
                            set: (value) => { config.text_color = value; window.elementSdk.setConfig({ text_color: value }); }
                        }
                    ],
                    borderables: [],
                    fontEditable: undefined,
                    fontSizeable: undefined
                }),
                mapToEditPanelValues: (config) => new Map([
                    ['site_name', config.site_name || defaultConfig.site_name],
                    ['tagline', config.tagline || defaultConfig.tagline],
                    ['hero_title', config.hero_title || defaultConfig.hero_title],
                    ['hero_subtitle', config.hero_subtitle || defaultConfig.hero_subtitle]
                ])
            });
        }

        // ==================== DATA SDK ====================
        const dataHandler = {
            onDataChanged(data) {
                userBookings = data.filter(d => d.type === 'booking');
                recordCount = data.length;
                renderMyBookings();
            }
        };

        async function initDataSdk() {
            if (window.dataSdk) {
                const result = await window.dataSdk.init(dataHandler);
                if (!result.isOk) {
                    console.error('Failed to initialize Data SDK');
                }
            }
        }

        initDataSdk();

        // ==================== UTILITY FUNCTIONS ====================
        function showToast(message, type = 'success') {
            const container = document.getElementById('toastContainer');
            const toast = document.createElement('div');
            toast.className = `custom-toast toast-${type}`;
            
            let icon = 'bi-check-circle-fill';
            if (type === 'error') icon = 'bi-x-circle-fill';
            if (type === 'info') icon = 'bi-info-circle-fill';
            
            toast.innerHTML = `
                <i class="bi ${icon} toast-icon"></i>
                <span>${message}</span>
            `;
            container.appendChild(toast);
            
            setTimeout(() => {
                toast.style.animation = 'slideIn 0.3s ease reverse';
                setTimeout(() => toast.remove(), 300);
            }, 3000);
        }

        function generateBookingId() {
            return 'CX' + Date.now().toString(36).toUpperCase() + Math.random().toString(36).substr(2, 4).toUpperCase();
        }

        function formatDate(date) {
            const options = { weekday: 'short', month: 'short', day: 'numeric' };
            return date.toLocaleDateString('en-US', options);
        }

        // ==================== NAVIGATION ====================
        function showPage(pageId) {
            document.querySelectorAll('.page-section').forEach(section => {
                section.classList.remove('active');
            });
            const page = document.getElementById(`page-${pageId}`);
            if (page) {
                page.classList.add('active');
                window.scrollTo({ top: 0, behavior: 'smooth' });
            }
        }

        document.querySelectorAll('[data-page]').forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const page = this.getAttribute('data-page');
                showPage(page);
                
                // Close mobile menu
                const navCollapse = document.getElementById('navbarNav');
                if (navCollapse.classList.contains('show')) {
                    bootstrap.Collapse.getInstance(navCollapse)?.hide();
                }
            });
        });

        // ==================== RENDER FUNCTIONS ====================
        function renderMovieCard(movie, showBookBtn = true) {
            const isUpcoming = movie.rating === 0;
            return `
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="movie-card" data-movie-id="${movie.id}">
                        <div class="movie-poster">
                            ${isUpcoming ? `<span class="movie-badge">Coming ${movie.release}</span>` : ''}
                            ${!isUpcoming ? `<span class="movie-rating"><i class="bi bi-star-fill"></i> ${movie.rating}</span>` : ''}
                            <span style="z-index: 1;">${movie.emoji}</span>
                        </div>
                        <div class="movie-info">
                            <h5 class="movie-title">${movie.title}</h5>
                            <p class="movie-meta">${movie.duration} | ${movie.language}</p>
                            <div class="movie-genre">
                                ${movie.genre.map(g => `<span class="genre-tag">${g}</span>`).join('')}
                            </div>
                            ${showBookBtn && !isUpcoming ? `<button class="btn btn-book" onclick="startBooking('${movie.id}')">Book Now</button>` : ''}
                            ${isUpcoming ? `<button class="btn btn-book" style="background: linear-gradient(135deg, var(--accent-color), #c9a227); color: #000;" disabled>Notify Me</button>` : ''}
                        </div>
                    </div>
                </div>
            `;
        }

        function renderTheaterCard(theater) {
            return `
                <div class="col-lg-6">
                    <div class="theater-card">
                        <div class="theater-icon"><i class="bi bi-building"></i></div>
                        <h4 class="theater-name">${theater.name}</h4>
                        <p class="theater-location"><i class="bi bi-geo-alt me-2"></i>${theater.location}</p>
                        <div class="theater-amenities">
                            ${theater.amenities.map(a => `<span class="amenity-badge">${a}</span>`).join('')}
                        </div>
                        <p class="mt-3 mb-0" style="color: var(--text-muted);"><i class="bi bi-display me-2"></i>${theater.screens} Screens</p>
                    </div>
                </div>
            `;
        }

        function renderOfferCard(offer) {
            return `
                <div class="col-lg-6">
                    <div class="offer-card">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <div class="offer-discount">${offer.discount}</div>
                            </div>
                            <div class="col">
                                <h4 class="offer-title">${offer.title}</h4>
                                <p style="color: var(--text-muted); margin-bottom: 0;">${offer.description}</p>
                                <span class="offer-code">${offer.code}</span>
                                <p style="color: var(--text-muted); font-size: 0.8rem; margin-top: 10px; margin-bottom: 0;">Valid till: ${offer.validTill}</p>
                            </div>
                        </div>
                    </div>
                </div>
            `;
        }

        function renderFoodCard(item) {
            const qty = selectedFood[item.id] || 0;
            return `
                <div class="col-lg-4 col-md-6">
                    <div class="food-card">
                        <div class="food-image">${item.emoji}</div>
                        <div class="food-info">
                            <h5 class="food-name">${item.name}</h5>
                            <p class="food-description">${item.description}</p>
                            <p class="food-price">₹${item.price}</p>
                            <div class="qty-control">
                                <button class="qty-btn" onclick="updateFoodQty('${item.id}', -1)">-</button>
                                <span class="qty-value" id="food-qty-${item.id}">${qty}</span>
                                <button class="qty-btn" onclick="updateFoodQty('${item.id}', 1)">+</button>
                            </div>
                        </div>
                    </div>
                </div>
            `;
        }

        function renderNotifications() {
            const notifications = [
                { id: 1, title: 'New Movie Alert!', text: 'Dragon\'s Legacy is coming soon. Be the first to book!', time: '2 hours ago', unread: true },
                { id: 2, title: 'Booking Confirmed', text: 'Your booking for Cosmic Odyssey has been confirmed.', time: '1 day ago', unread: false },
                { id: 3, title: 'Special Offer', text: 'Get 30% off on your next booking. Use code WEEKEND30.', time: '2 days ago', unread: false }
            ];
            
            return notifications.map(n => `
                <div class="notification-item ${n.unread ? 'unread' : ''}">
                    <h5 class="notification-title">${n.title}</h5>
                    <p class="notification-text">${n.text}</p>
                    <p class="notification-time"><i class="bi bi-clock me-1"></i>${n.time}</p>
                </div>
            `).join('');
        }

        function renderMyBookings() {
            const container = document.getElementById('bookingsList');
            if (!container) return;
            
            if (userBookings.length === 0) {
                container.innerHTML = `
                    <div class="text-center py-5">
                        <div style="font-size: 5rem; margin-bottom: 20px;">🎫</div>
                        <h4>No Bookings Yet</h4>
                        <p style="color: var(--text-muted);">Start by booking your first movie!</p>
                        <button class="btn btn-login" onclick="showPage('now-showing')">Browse Movies</button>
                    </div>
                `;
                return;
            }
            
            container.innerHTML = userBookings.map(booking => `
                <div class="booking-card" data-booking-id="${booking.__backendId}">
                    <div class="booking-header">
                        <div>
                            <div class="booking-id">Booking ID: ${booking.id}</div>
                        </div>
                        <span class="booking-status ${booking.status}">${booking.status}</span>
                    </div>
                    <div class="booking-body">
                        <h4 class="booking-movie">${booking.movieTitle}</h4>
                        <div class="booking-details">
                            <div class="booking-detail">
                                <i class="bi bi-calendar3"></i>
                                <div>
                                    <div class="booking-detail-label">Date</div>
                                    <div class="booking-detail-value">${booking.showDate}</div>
                                </div>
                            </div>
                            <div class="booking-detail">
                                <i class="bi bi-clock"></i>
                                <div>
                                    <div class="booking-detail-label">Time</div>
                                    <div class="booking-detail-value">${booking.showTime}</div>
                                </div>
                            </div>
                            <div class="booking-detail">
                                <i class="bi bi-geo-alt"></i>
                                <div>
                                    <div class="booking-detail-label">Theater</div>
                                    <div class="booking-detail-value">${booking.theater}</div>
                                </div>
                            </div>
                            <div class="booking-detail">
                                <i class="bi bi-grid-3x3"></i>
                                <div>
                                    <div class="booking-detail-label">Seats</div>
                                    <div class="booking-detail-value">${booking.seats}</div>
                                </div>
                            </div>
                            <div class="booking-detail">
                                <i class="bi bi-currency-rupee"></i>
                                <div>
                                    <div class="booking-detail-label">Total</div>
                                    <div class="booking-detail-value">₹${booking.totalAmount}</div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-3 d-flex gap-2 flex-wrap">
                            <button class="btn btn-outline-danger btn-sm" onclick="confirmCancelBooking('${booking.__backendId}')">
                                <i class="bi bi-x-circle me-1"></i>Cancel Booking
                            </button>
                            <button class="btn btn-outline-warning btn-sm" onclick="showPage('reviews')">
                                <i class="bi bi-star me-1"></i>Write Review
                            </button>
                        </div>
                    </div>
                </div>
            `).join('');
        }

        // ==================== BOOKING FLOW ====================
        function startBooking(movieId) {
            const movie = [...moviesData.nowShowing, ...moviesData.upcoming].find(m => m.id === movieId);
            if (!movie) return;
            
            selectedMovie = movie;
            selectedTheater = null;
            selectedDate = null;
            selectedTime = null;
            selectedSeats = [];
            selectedFood = {};
            
            renderBookingStep1();
            showPage('book-tickets');
        }

        function renderBookingStep1() {
            const dates = [];
            for (let i = 0; i < 7; i++) {
                const date = new Date();
                date.setDate(date.getDate() + i);
                dates.push(date);
            }
            
            const content = document.getElementById('bookingContent');
            content.innerHTML = `
                <div class="mb-4">
                    <h3 style="font-family: 'Bebas Neue', cursive; font-size: 2rem; letter-spacing: 2px;">
                        ${selectedMovie.emoji} ${selectedMovie.title}
                    </h3>
                    <p style="color: var(--text-muted);">${selectedMovie.duration} | ${selectedMovie.language} | ${selectedMovie.genre.join(', ')}</p>
                </div>
                
                <h5 class="mb-3">Select Date</h5>
                <div class="date-picker mb-4">
                    ${dates.map((d, i) => `
                        <div class="date-item ${i === 0 ? 'selected' : ''}" onclick="selectDate(${i}, this)" data-date="${d.toISOString()}">
                            <div class="date-day">${d.toLocaleDateString('en-US', { weekday: 'short' })}</div>
                            <div class="date-num">${d.getDate()}</div>
                        </div>
                    `).join('')}
                </div>
                
                <h5 class="mb-3">Select Theater</h5>
                <div class="row g-3 mb-4">
                    ${theatersData.map((t, i) => `
                        <div class="col-md-6">
                            <div class="theater-card ${i === 0 ? 'selected' : ''}" style="cursor: pointer; ${i === 0 ? 'border-color: var(--primary-color);' : ''}" onclick="selectTheater('${t.id}', this)">
                                <h5 class="theater-name mb-2">${t.name}</h5>
                                <p class="theater-location mb-2"><i class="bi bi-geo-alt me-2"></i>${t.location}</p>
                                <div class="theater-amenities">
                                    ${t.amenities.map(a => `<span class="amenity-badge">${a}</span>`).join('')}
                                </div>
                            </div>
                        </div>
                    `).join('')}
                </div>
                
                <h5 class="mb-3">Select Show Time</h5>
                <div class="row g-3 mb-4">
                    ${showTimings.map((t, i) => `
                        <div class="col-auto">
                            <div class="time-slot ${i === 0 ? 'selected' : ''}" onclick="selectTime('${t}', this)">
                                <div class="time-slot-time">${t}</div>
                                <div class="time-slot-price">₹${i < 2 ? '200' : '250'}</div>
                            </div>
                        </div>
                    `).join('')}
                </div>
                
                <button class="btn btn-login btn-lg" onclick="proceedToSeatSelection()">
                    Continue to Seat Selection <i class="bi bi-arrow-right ms-2"></i>
                </button>
            `;
            
            // Set initial selections
            selectedDate = dates[0].toISOString();
            selectedTheater = theatersData[0];
            selectedTime = showTimings[0];
            updateSummary();
        }

        function selectDate(index, element) {
            document.querySelectorAll('.date-item').forEach(el => el.classList.remove('selected'));
            element.classList.add('selected');
            selectedDate = element.getAttribute('data-date');
            updateSummary();
        }

        function selectTheater(theaterId, element) {
            document.querySelectorAll('.theater-card').forEach(el => {
                el.classList.remove('selected');
                el.style.borderColor = 'rgba(255, 255, 255, 0.1)';
            });
            element.classList.add('selected');
            element.style.borderColor = 'var(--primary-color)';
            selectedTheater = theatersData.find(t => t.id === theaterId);
            updateSummary();
        }

        function selectTime(time, element) {
            document.querySelectorAll('.time-slot').forEach(el => el.classList.remove('selected'));
            element.classList.add('selected');
            selectedTime = time;
            updateSummary();
        }

        function proceedToSeatSelection() {
            renderSeatSelection();
        }

        function renderSeatSelection() {
            const rows = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H'];
            const seatsPerRow = 12;
            const occupiedSeats = ['A3', 'A4', 'B5', 'B6', 'C7', 'D2', 'E8', 'F1', 'G10', 'H5', 'H6'];
            const premiumRows = ['G', 'H'];
            
            const content = document.getElementById('bookingContent');
            content.innerHTML = `
                <h4 class="mb-4" style="font-family: 'Bebas Neue', cursive; letter-spacing: 2px;">SELECT YOUR SEATS</h4>
                
                <div class="seat-map-container">
                    <div class="screen-label">SCREEN</div>
                    <div class="screen"></div>
                    
                    <div class="seat-map">
                        ${rows.map(row => `
                            <div class="seat-row">
                                <span class="seat-row-label">${row}</span>
                                ${Array.from({ length: seatsPerRow }, (_, i) => {
                                    const seatId = `${row}${i + 1}`;
                                    const isOccupied = occupiedSeats.includes(seatId);
                                    const isPremium = premiumRows.includes(row);
                                    return `
                                        <div class="seat ${isOccupied ? 'occupied' : ''} ${isPremium ? 'premium' : ''}" 
                                             data-seat="${seatId}" 
                                             onclick="${!isOccupied ? `toggleSeat('${seatId}', this)` : ''}">
                                            ${i + 1}
                                        </div>
                                    `;
                                }).join('')}
                                <span class="seat-row-label">${row}</span>
                            </div>
                        `).join('')}
                    </div>
                    
                    <div class="seat-legend">
                        <div class="legend-item">
                            <div class="legend-seat" style="background: rgba(255, 255, 255, 0.1);"></div>
                            <span>Available (₹200)</span>
                        </div>
                        <div class="legend-item">
                            <div class="legend-seat" style="background: rgba(245, 197, 24, 0.2); border: 2px solid var(--accent-color);"></div>
                            <span>Premium (₹350)</span>
                        </div>
                        <div class="legend-item">
                            <div class="legend-seat" style="background: var(--primary-color);"></div>
                            <span>Selected</span>
                        </div>
                        <div class="legend-item">
                            <div class="legend-seat" style="background: rgba(255, 255, 255, 0.03);"></div>
                            <span>Occupied</span>
                        </div>
                    </div>
                </div>
                
                <div class="d-flex gap-3 mt-4">
                    <button class="btn btn-outline-light" onclick="renderBookingStep1()">
                        <i class="bi bi-arrow-left me-2"></i>Back
                    </button>
                    <button class="btn btn-login btn-lg flex-grow-1" onclick="proceedToFood()">
                        Continue to Food & Beverages <i class="bi bi-arrow-right ms-2"></i>
                    </button>
                </div>
            `;
        }

        function toggleSeat(seatId, element) {
            const index = selectedSeats.indexOf(seatId);
            if (index > -1) {
                selectedSeats.splice(index, 1);
                element.classList.remove('selected');
            } else {
                if (selectedSeats.length >= 10) {
                    showToast('Maximum 10 seats can be selected', 'error');
                    return;
                }
                selectedSeats.push(seatId);
                element.classList.add('selected');
            }
            updateSummary();
        }

        function proceedToFood() {
            if (selectedSeats.length === 0) {
                showToast('Please select at least one seat', 'error');
                return;
            }
            renderFoodSelection();
        }

        function renderFoodSelection() {
            const content = document.getElementById('bookingContent');
            content.innerHTML = `
                <h4 class="mb-4" style="font-family: 'Bebas Neue', cursive; letter-spacing: 2px;">ADD FOOD & BEVERAGES</h4>
                <p style="color: var(--text-muted);">Enhance your movie experience with delicious snacks and drinks!</p>
                
                <div class="row g-4 mb-4">
                    ${foodItems.map(item => renderFoodCard(item)).join('')}
                </div>
                
                <div class="d-flex gap-3">
                    <button class="btn btn-outline-light" onclick="renderSeatSelection()">
                        <i class="bi bi-arrow-left me-2"></i>Back
                    </button>
                    <button class="btn btn-login btn-lg flex-grow-1" onclick="proceedToPayment()">
                        Proceed to Payment <i class="bi bi-arrow-right ms-2"></i>
                    </button>
                </div>
            `;
        }

        function updateFoodQty(itemId, change) {
            const currentQty = selectedFood[itemId] || 0;
            const newQty = Math.max(0, Math.min(10, currentQty + change));
            
            if (newQty === 0) {
                delete selectedFood[itemId];
            } else {
                selectedFood[itemId] = newQty;
            }
            
            const qtyElement = document.getElementById(`food-qty-${itemId}`);
            if (qtyElement) qtyElement.textContent = newQty;
            updateSummary();
        }
        
        function proceedToPayment() {
            renderPaymentPage();
            showPage('payment');
        }
        
        function renderPaymentPage() {
            updateOrderSummary();
            
            // Reset form
            const form = document.getElementById('paymentForm');
            if (form) form.reset();
        }
        
        function updateOrderSummary() {
            const container = document.getElementById('orderSummaryContent');
            if (!container || !selectedMovie) return;
            
            const premiumRows = ['G', 'H'];
            let ticketTotal = 0;
            const ticketDetails = [];
            
            selectedSeats.forEach(seat => {
                const row = seat.charAt(0);
                const price = premiumRows.includes(row) ? 350 : 200;
                ticketTotal += price;
            });
            
            let foodTotal = 0;
            const foodDetails = [];
            Object.entries(selectedFood).forEach(([itemId, qty]) => {
                const item = foodItems.find(f => f.id === itemId);
                if (item) {
                    const itemTotal = item.price * qty;
                    foodTotal += itemTotal;
                    foodDetails.push({ name: item.name, qty, price: item.price, total: itemTotal });
                }
            });
            
            const subtotal = ticketTotal + foodTotal;
            const tax = Math.round(subtotal * 0.18);
            const convenienceFee = 50;
            const total = subtotal + tax + convenienceFee;
            
            const dateStr = selectedDate ? new Date(selectedDate).toLocaleDateString('en-US', { weekday: 'short', month: 'short', day: 'numeric' }) : '-';
            
            container.innerHTML = `
                <div class="mb-4">
                    <h6 style="font-weight: 600; margin-bottom: 15px;">${selectedMovie.emoji} ${selectedMovie.title}</h6>
                    <p style="color: var(--text-muted); font-size: 0.9rem; margin-bottom: 5px;">
                        <i class="bi bi-building me-2"></i>${selectedTheater.name}
                    </p>
                    <p style="color: var(--text-muted); font-size: 0.9rem; margin-bottom: 5px;">
                        <i class="bi bi-calendar3 me-2"></i>${dateStr}
                    </p>
                    <p style="color: var(--text-muted); font-size: 0.9rem; margin-bottom: 5px;">
                        <i class="bi bi-clock me-2"></i>${selectedTime}
                    </p>
                    <p style="color: var(--text-muted); font-size: 0.9rem;">
                        <i class="bi bi-grid-3x3 me-2"></i>${selectedSeats.join(', ')}
                    </p>
                </div>
                
                <hr style="border-color: rgba(255,255,255,0.1); margin: 20px 0;">
                
                <div class="summary-item">
                    <span class="summary-label">Tickets (${selectedSeats.length})</span>
                    <span class="summary-value">₹${ticketTotal}</span>
                </div>
                
                ${foodDetails.length > 0 ? `
                    <div class="mt-3 mb-3">
                        <h6 style="font-weight: 600; margin-bottom: 10px;">Food & Beverages</h6>
                        ${foodDetails.map(f => `
                            <div class="summary-item">
                                <span class="summary-label">${f.name} x${f.qty}</span>
                                <span class="summary-value">₹${f.total}</span>
                            </div>
                        `).join('')}
                    </div>
                ` : ''}
                
                <div class="summary-item">
                    <span class="summary-label">Subtotal</span>
                    <span class="summary-value">₹${subtotal}</span>
                </div>
                <div class="summary-item">
                    <span class="summary-label">GST (18%)</span>
                    <span class="summary-value">₹${tax}</span>
                </div>
                <div class="summary-item">
                    <span class="summary-label">Convenience Fee</span>
                    <span class="summary-value">₹${convenienceFee}</span>
                </div>
                
                <div class="summary-total">
                    <span>Total Amount</span>
                    <span>₹${total}</span>
                </div>
                
                <div class="mt-4 p-3" style="background: rgba(46, 204, 113, 0.1); border-radius: 10px; border: 1px solid rgba(46, 204, 113, 0.3);">
                    <p style="color: #2ecc71; font-size: 0.85rem; margin: 0;">
                        <i class="bi bi-shield-check me-2"></i>Your payment is 100% secure
                    </p>
                </div>
            `;
        }

        function updateSummary() {
            const summaryContent = document.getElementById('summaryContent');
            if (!selectedMovie) return;
            
            const premiumRows = ['G', 'H'];
            let ticketTotal = 0;
            selectedSeats.forEach(seat => {
                const row = seat.charAt(0);
                ticketTotal += premiumRows.includes(row) ? 350 : 200;
            });
            
            let foodTotal = 0;
            Object.entries(selectedFood).forEach(([itemId, qty]) => {
                const item = foodItems.find(f => f.id === itemId);
                if (item) foodTotal += item.price * qty;
            });
            
            const total = ticketTotal + foodTotal;
            const dateStr = selectedDate ? new Date(selectedDate).toLocaleDateString('en-US', { weekday: 'short', month: 'short', day: 'numeric' }) : '-';
            
            summaryContent.innerHTML = `
                <div class="summary-item">
                    <span class="summary-label">Movie</span>
                    <span class="summary-value">${selectedMovie.title}</span>
                </div>
                <div class="summary-item">
                    <span class="summary-label">Theater</span>
                    <span class="summary-value">${selectedTheater ? selectedTheater.name : '-'}</span>
                </div>
                <div class="summary-item">
                    <span class="summary-label">Date</span>
                    <span class="summary-value">${dateStr}</span>
                </div>
                <div class="summary-item">
                    <span class="summary-label">Time</span>
                    <span class="summary-value">${selectedTime || '-'}</span>
                </div>
                <div class="summary-item">
                    <span class="summary-label">Seats (${selectedSeats.length})</span>
                    <span class="summary-value">${selectedSeats.length > 0 ? selectedSeats.join(', ') : '-'}</span>
                </div>
                <div class="summary-item">
                    <span class="summary-label">Tickets</span>
                    <span class="summary-value">₹${ticketTotal}</span>
                </div>
                ${foodTotal > 0 ? `
                <div class="summary-item">
                    <span class="summary-label">Food & Beverages</span>
                    <span class="summary-value">₹${foodTotal}</span>
                </div>
                ` : ''}
                <div class="summary-total">
                    <span>Total</span>
                    <span>₹${total}</span>
                </div>
            `;
        }

        async function proceedToCheckout() {
            if (selectedSeats.length === 0) {
                showToast('Please select at least one seat', 'error');
                return;
            }
            
            if (recordCount >= 999) {
                showToast('Maximum booking limit reached. Please contact support.', 'error');
                return;
            }
            
            const premiumRows = ['G', 'H'];
            let ticketTotal = 0;
            selectedSeats.forEach(seat => {
                const row = seat.charAt(0);
                ticketTotal += premiumRows.includes(row) ? 350 : 200;
            });
            
            let foodTotal = 0;
            const foodItemsList = [];
            Object.entries(selectedFood).forEach(([itemId, qty]) => {
                const item = foodItems.find(f => f.id === itemId);
                if (item) {
                    foodTotal += item.price * qty;
                    foodItemsList.push(`${item.name} x${qty}`);
                }
            });
            
            const booking = {
                id: generateBookingId(),
                type: 'booking',
                movieId: selectedMovie.id,
                movieTitle: selectedMovie.title,
                theater: selectedTheater.name,
                showTime: selectedTime,
                showDate: new Date(selectedDate).toLocaleDateString('en-US', { weekday: 'short', month: 'short', day: 'numeric' }),
                seats: selectedSeats.join(', '),
                totalAmount: ticketTotal + foodTotal,
                foodItems: foodItemsList.join(', '),
                userId: currentUser ? currentUser.email : 'guest',
                userName: currentUser ? currentUser.name : 'Guest User',
                userEmail: currentUser ? currentUser.email : '',
                bookingDate: new Date().toISOString(),
                status: 'confirmed',
                rating: 0,
                review: ''
            };
            
            if (window.dataSdk) {
                const checkoutBtn = document.querySelector('.btn-checkout');
                if (checkoutBtn) {
                    checkoutBtn.disabled = true;
                    checkoutBtn.innerHTML = '<span class="spinner"></span> Processing...';
                }
                
                const result = await window.dataSdk.create(booking);
                
                if (result.isOk) {
                    showToast('Booking confirmed! Enjoy your movie! 🎬', 'success');
                    showPage('bookings');
                } else {
                    showToast('Booking failed. Please try again.', 'error');
                    if (checkoutBtn) {
                        checkoutBtn.disabled = false;
                        checkoutBtn.innerHTML = 'Complete Booking';
                    }
                }
            } else {
                showToast('Booking confirmed! Enjoy your movie! 🎬', 'success');
                showPage('bookings');
            }
        }

        // Cancel Booking
        let pendingDeleteId = null;

        function confirmCancelBooking(bookingId) {
            const card = document.querySelector(`[data-booking-id="${bookingId}"]`);
            const cancelBtn = card.querySelector('.btn-outline-danger');
            
            cancelBtn.outerHTML = `
                <div class="delete-confirm">
                    <button class="btn btn-confirm-delete" onclick="cancelBooking('${bookingId}')">Confirm Cancel</button>
                    <button class="btn btn-cancel-delete" onclick="cancelDeleteConfirm('${bookingId}')">Keep</button>
                </div>
            `;
        }

        function cancelDeleteConfirm(bookingId) {
            renderMyBookings();
        }

        async function cancelBooking(bookingId) {
            const booking = userBookings.find(b => b.__backendId === bookingId);
            if (!booking || !window.dataSdk) return;
            
            const confirmDiv = document.querySelector(`[data-booking-id="${bookingId}"] .delete-confirm`);
            if (confirmDiv) {
                confirmDiv.innerHTML = '<span class="spinner"></span> Cancelling...';
            }
            
            const result = await window.dataSdk.delete(booking);
            
            if (result.isOk) {
                showToast('Booking cancelled successfully', 'info');
            } else {
                showToast('Failed to cancel booking', 'error');
                renderMyBookings();
            }
        }

        // ==================== INITIAL RENDER ====================
        function initApp() {
            // Render Now Showing
            const nowShowingContainer = document.getElementById('nowShowingMovies');
            if (nowShowingContainer) {
                nowShowingContainer.innerHTML = moviesData.nowShowing.slice(0, 4).map(movie => renderMovieCard(movie)).join('');
            }
            
            // Render All Now Showing
            const allNowShowingContainer = document.getElementById('allNowShowingMovies');
            if (allNowShowingContainer) {
                allNowShowingContainer.innerHTML = moviesData.nowShowing.map(movie => renderMovieCard(movie)).join('');
            }
            
            // Render Upcoming
            const upcomingContainer = document.getElementById('upcomingMovies');
            if (upcomingContainer) {
                upcomingContainer.innerHTML = moviesData.upcoming.slice(0, 4).map(movie => renderMovieCard(movie, false)).join('');
            }
            
            // Render All Upcoming
            const allUpcomingContainer = document.getElementById('allUpcomingMovies');
            if (allUpcomingContainer) {
                allUpcomingContainer.innerHTML = moviesData.upcoming.map(movie => renderMovieCard(movie, false)).join('');
            }
            
            // Render Theaters
            const theatersContainer = document.getElementById('theatersList');
            if (theatersContainer) {
                theatersContainer.innerHTML = theatersData.map(theater => renderTheaterCard(theater)).join('');
            }
            
            // Render Offers Preview
            const offersPreview = document.getElementById('offersPreview');
            if (offersPreview) {
                offersPreview.innerHTML = offersData.slice(0, 2).map(offer => renderOfferCard(offer)).join('');
            }
            
            // Render All Offers
            const allOffers = document.getElementById('allOffers');
            if (allOffers) {
                allOffers.innerHTML = offersData.map(offer => renderOfferCard(offer)).join('');
            }
            
            // Render Food Menu
            const foodMenu = document.getElementById('foodMenu');
            if (foodMenu) {
                foodMenu.innerHTML = foodItems.map(item => renderFoodCard(item)).join('');
            }
            
            // Render Notifications
            const notificationsList = document.getElementById('notificationsList');
            if (notificationsList) {
                notificationsList.innerHTML = renderNotifications();
            }
            
            // Render Reviews (sample)
            const reviewsList = document.getElementById('reviewsList');
            if (reviewsList) {
                reviewsList.innerHTML = `
                    <div class="review-card">
                        <div class="review-header">
                            <div class="reviewer-info">
                                <div class="reviewer-avatar">JD</div>
                                <div>
                                    <div class="reviewer-name">John Doe</div>
                                    <div class="review-date">Cosmic Odyssey • 2 days ago</div>
                                </div>
                            </div>
                            <div class="review-rating">
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-half"></i>
                            </div>
                        </div>
                        <p class="review-text">Amazing visual effects and compelling storyline! The IMAX experience at CineMax Central was absolutely breathtaking. The Dolby Atmos sound made me feel like I was floating in space. Highly recommend!</p>
                    </div>
                    <div class="review-card">
                        <div class="review-header">
                            <div class="reviewer-info">
                                <div class="reviewer-avatar">AS</div>
                                <div>
                                    <div class="reviewer-name">Alice Smith</div>
                                    <div class="review-date">The Shadow Protocol • 1 week ago</div>
                                </div>
                            </div>
                            <div class="review-rating">
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star"></i>
                            </div>
                        </div>
                        <p class="review-text">Edge-of-your-seat thriller with incredible action sequences. The recliner seats at CineMax made the 2-hour movie fly by. Great popcorn too!</p>
                    </div>
                `;
            }
            
            renderMyBookings();
        }

        // ==================== EVENT HANDLERS ====================
        
        // Payment Method Change
        $(document).on('change', '#paymentMethod', function() {
            const method = $(this).val();
            const cardDetails = $('#cardDetails');
            const paypalDetails = $('#paypalDetails');
            
            cardDetails.hide();
            paypalDetails.hide();
            
            // Remove required attributes
            $('#cardholderName, #cardNumber, #expiryMonth, #expiryYear, #cvv, #paypalEmail').removeAttr('required');
            
            if (method === 'credit-card' || method === 'debit-card') {
                cardDetails.show();
                $('#cardholderName, #cardNumber, #expiryMonth, #expiryYear, #cvv').attr('required', 'required');
            } else if (method === 'paypal') {
                paypalDetails.show();
                $('#paypalEmail').attr('required', 'required');
            }
        });
        
        // Card Number Formatting
        $(document).on('input', '#cardNumber', function() {
            let value = $(this).val().replace(/\s/g, '');
            value = value.replace(/\D/g, '');
            value = value.substring(0, 16);
            
            let formatted = value.match(/.{1,4}/g);
            if (formatted) {
                $(this).val(formatted.join(' '));
            } else {
                $(this).val(value);
            }
        });
        
        // CVV Input - Only Numbers
        $(document).on('input', '#cvv', function() {
            let value = $(this).val().replace(/\D/g, '');
            $(this).val(value.substring(0, 3));
        });
        
        // Payment Form Submission
        $(document).on('submit', '#paymentForm', async function(e) {
            // e.preventDefault();
            
            const paymentMethod = $('#paymentMethod').val();
            const billingName = $('#billingName').val();
            const billingEmail = $('#billingEmail').val();
            const billingPhone = $('#billingPhone').val();
            const billingAddress = $('#billingAddress').val();
            const billingCity = $('#billingCity').val();
            const billingZip = $('#billingZip').val();
            
            let paymentDetails = {
                method: paymentMethod,
                billingName,
                billingEmail,
                billingPhone,
                billingAddress,
                billingCity,
                billingZip
            };
            
            if (paymentMethod === 'credit-card' || paymentMethod === 'debit-card') {
                const cardholderName = $('#cardholderName').val();
                const cardNumber = $('#cardNumber').val().replace(/\s/g, '');
                const expiryMonth = $('#expiryMonth').val();
                const expiryYear = $('#expiryYear').val();
                const cvv = $('#cvv').val();
                
                // Validation
                if (cardNumber.length !== 16) {
                    showToast('Card number must be 16 digits', 'error');
                    return;
                }
                
                if (cvv.length !== 3) {
                    showToast('CVV must be 3 digits', 'error');
                    return;
                }
                
                paymentDetails = {
                    ...paymentDetails,
                    cardholderName,
                    cardNumber: '**** **** **** ' + cardNumber.slice(-4),
                    expiryDate: `${expiryMonth}/${expiryYear}`,
                    cvv: '***'
                };
            } else if (paymentMethod === 'paypal') {
                const paypalEmail = $('#paypalEmail').val();
                paymentDetails = {
                    ...paymentDetails,
                    paypalEmail
                };
            }
            
            // Calculate totals
            const premiumRows = ['G', 'H'];
            let ticketTotal = 0;
            selectedSeats.forEach(seat => {
                const row = seat.charAt(0);
                ticketTotal += premiumRows.includes(row) ? 350 : 200;
            });
            
            let foodTotal = 0;
            Object.entries(selectedFood).forEach(([itemId, qty]) => {
                const item = foodItems.find(f => f.id === itemId);
                if (item) foodTotal += item.price * qty;
            });
            
            const subtotal = ticketTotal + foodTotal;
            const tax = Math.round(subtotal * 0.18);
            const convenienceFee = 50;
            const total = subtotal + tax + convenienceFee;
            
            // Show loading
            const submitBtn = $('#submitPaymentBtn');
            submitBtn.prop('disabled', true).html('<span class="spinner"></span> Processing Payment...');
            
            // Simulate payment processing
            setTimeout(async () => {
                // Create booking in database
                if (recordCount >= 999) {
                    showToast('Maximum booking limit reached. Please contact support.', 'error');
                    submitBtn.prop('disabled', false).html('<i class="bi bi-lock me-2"></i>Complete Payment');
                    return;
                }
                
                const booking = {
                    id: generateBookingId(),
                    type: 'booking',
                    movieId: selectedMovie.id,
                    movieTitle: selectedMovie.title,
                    theater: selectedTheater.name,
                    showTime: selectedTime,
                    showDate: new Date(selectedDate).toLocaleDateString('en-US', { weekday: 'short', month: 'short', day: 'numeric' }),
                    seats: selectedSeats.join(', '),
                    totalAmount: total,
                    foodItems: Object.entries(selectedFood).map(([itemId, qty]) => {
                        const item = foodItems.find(f => f.id === itemId);
                        return item ? `${item.name} x${qty}` : '';
                    }).filter(x => x).join(', '),
                    userId: currentUser ? currentUser.email : 'guest',
                    userName: billingName,
                    userEmail: billingEmail,
                    bookingDate: new Date().toISOString(),
                    status: 'confirmed',
                    rating: 0,
                    review: ''
                };
                
                if (window.dataSdk) {
                    const result = await window.dataSdk.create(booking);
                    
                    if (result.isOk) {
                        showPaymentSuccess(paymentDetails, total, booking.id);
                    } else {
                        showToast('Payment failed. Please try again.', 'error');
                        submitBtn.prop('disabled', false).html('<i class="bi bi-lock me-2"></i>Complete Payment');
                    }
                } else {
                    showPaymentSuccess(paymentDetails, total, booking.id);
                }
            }, 2000);
        });
        
        function showPaymentSuccess(paymentDetails, amount, bookingId) {
            const content = document.getElementById('bookingContent');
            const orderSummary = document.getElementById('orderSummaryContent');
            
            const dateStr = selectedDate ? new Date(selectedDate).toLocaleDateString('en-US', { weekday: 'short', month: 'short', day: 'numeric' }) : '-';
            
            let paymentMethodDisplay = '';
            if (paymentDetails.method === 'credit-card') {
                paymentMethodDisplay = `Credit Card (${paymentDetails.cardNumber})`;
            } else if (paymentDetails.method === 'debit-card') {
                paymentMethodDisplay = `Debit Card (${paymentDetails.cardNumber})`;
            } else if (paymentDetails.method === 'paypal') {
                paymentMethodDisplay = `PayPal (${paymentDetails.paypalEmail})`;
            }
            
            const successHTML = `
                <div class="payment-success-modal">
                    <div class="success-icon">✓</div>
                    <h2 style="font-family: 'Bebas Neue', cursive; font-size: 2.5rem; letter-spacing: 3px; margin-bottom: 15px;">PAYMENT SUCCESSFUL!</h2>
                    <p style="color: var(--text-muted); font-size: 1.1rem; margin-bottom: 30px;">Your booking has been confirmed</p>
                    
                    <div style="background: rgba(255, 255, 255, 0.05); border-radius: 15px; padding: 30px; text-align: left; margin-bottom: 25px;">
                        <h5 style="font-weight: 600; margin-bottom: 20px; text-align: center;">Payment Summary</h5>
                        
                        <div class="payment-detail-item">
                            <span class="payment-detail-label">Booking ID</span>
                            <span class="payment-detail-value">${bookingId}</span>
                        </div>
                        <div class="payment-detail-item">
                            <span class="payment-detail-label">Movie</span>
                            <span class="payment-detail-value">${selectedMovie.title}</span>
                        </div>
                        <div class="payment-detail-item">
                            <span class="payment-detail-label">Theater</span>
                            <span class="payment-detail-value">${selectedTheater.name}</span>
                        </div>
                        <div class="payment-detail-item">
                            <span class="payment-detail-label">Date & Time</span>
                            <span class="payment-detail-value">${dateStr}, ${selectedTime}</span>
                        </div>
                        <div class="payment-detail-item">
                            <span class="payment-detail-label">Seats</span>
                            <span class="payment-detail-value">${selectedSeats.join(', ')}</span>
                        </div>
                        <div class="payment-detail-item">
                            <span class="payment-detail-label">Payment Method</span>
                            <span class="payment-detail-value">${paymentMethodDisplay}</span>
                        </div>
                        <div class="payment-detail-item">
                            <span class="payment-detail-label">Billing Name</span>
                            <span class="payment-detail-value">${paymentDetails.billingName}</span>
                        </div>
                        <div class="payment-detail-item" style="border: none; padding-top: 20px; margin-top: 20px; border-top: 2px solid var(--primary-color);">
                            <span style="font-size: 1.1rem; font-weight: 600;">Total Paid</span>
                            <span style="font-size: 1.3rem; font-weight: 700; color: var(--accent-color);">₹${amount}</span>
                        </div>
                    </div>
                    
                    <p style="color: var(--text-muted); font-size: 0.9rem; margin-bottom: 25px;">
                        A confirmation email has been sent to <strong>${paymentDetails.billingEmail}</strong>
                    </p>
                    
                    <div class="d-flex gap-3 justify-content-center">
                        <button class="btn btn-login" onclick="showPage('bookings')">
                            <i class="bi bi-ticket-perforated me-2"></i>View My Bookings
                        </button>
                        <button class="btn btn-outline-light" onclick="showPage('home')">
                            <i class="bi bi-house me-2"></i>Back to Home
                        </button>
                    </div>
                </div>
            `;
            
            content.innerHTML = successHTML;
            orderSummary.innerHTML = `
                <div class="text-center py-5">
                    <div style="font-size: 4rem; margin-bottom: 15px;">🎉</div>
                    <h5 style="color: #2ecc71;">Payment Complete!</h5>
                    <p style="color: var(--text-muted); font-size: 0.9rem;">Thank you for your booking</p>
                </div>
            `;
            
            showToast('Payment successful! Enjoy your movie! 🎬', 'success');
        }
        
        // Login Modal
        document.getElementById('loginBtn').addEventListener('click', function() {
            const modal = new bootstrap.Modal(document.getElementById('loginModal'));
            modal.show();
        });
        
        // Login Form
        document.getElementById('loginForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const email = document.getElementById('loginEmail').value;
            currentUser = { email, name: email.split('@')[0] };
            showToast('Welcome back! ' + currentUser.name, 'success');
            bootstrap.Modal.getInstance(document.getElementById('loginModal')).hide();
            document.getElementById('loginBtn').innerHTML = `<i class="bi bi-person-circle me-2"></i>${currentUser.name}`;
        });
        
        // Register Form
        document.getElementById('registerForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const name = document.getElementById('registerName').value;
            const email = document.getElementById('registerEmail').value;
            currentUser = { name, email };
            showToast('Account created successfully! Welcome ' + name, 'success');
            bootstrap.Modal.getInstance(document.getElementById('loginModal')).hide();
            document.getElementById('loginBtn').innerHTML = `<i class="bi bi-person-circle me-2"></i>${name}`;
        });
        
        // Contact Form
        document.getElementById('contactForm').addEventListener('submit', function(e) {
            e.preventDefault();
            showToast('Message sent successfully! We\'ll get back to you soon.', 'success');
            this.reset();
        });
        
        // Newsletter Form
        document.getElementById('newsletterForm').addEventListener('submit', function(e) {
            e.preventDefault();
            showToast('Thanks for subscribing! 🎉', 'success');
            document.getElementById('newsletterEmail').value = '';
        });
        
        // Search
        document.getElementById('searchBtn').addEventListener('click', function() {
            const query = document.getElementById('searchInput').value.toLowerCase();
            if (!query) return;
            
            const allMovies = [...moviesData.nowShowing, ...moviesData.upcoming];
            const found = allMovies.filter(m => m.title.toLowerCase().includes(query));
            
            if (found.length > 0) {
                showToast(`Found ${found.length} movie(s) matching "${query}"`, 'info');
                showPage('now-showing');
            } else {
                showToast('No movies found matching your search', 'info');
            }
        });
        
        document.getElementById('searchInput').addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                document.getElementById('searchBtn').click();
            }
        });
        
        // Initialize App
        $(document).ready(function() {
            initApp();
        });
    </script>
 <script>(function(){function c(){var b=a.contentDocument||a.contentWindow.document;if(b){var d=b.createElement('script');d.innerHTML="window.__CF$cv$params={r:'9c717845728b3e39',t:'MTc2OTk0OTEyOS4wMDAwMDA='};var a=document.createElement('script');a.nonce='';a.src='/cdn-cgi/challenge-platform/scripts/jsd/main.js';document.getElementsByTagName('head')[0].appendChild(a);";b.getElementsByTagName('head')[0].appendChild(d)}}if(document.body){var a=document.createElement('iframe');a.height=1;a.width=1;a.style.position='absolute';a.style.top=0;a.style.left=0;a.style.border='none';a.style.visibility='hidden';document.body.appendChild(a);if('loading'!==document.readyState)c();else if(window.addEventListener)document.addEventListener('DOMContentLoaded',c);else{var e=document.onreadystatechange||function(){};document.onreadystatechange=function(b){e(b);'loading'!==document.readyState&&(document.onreadystatechange=e,c())}}}})();</script></body>
</html>