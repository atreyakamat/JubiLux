<!DOCTYPE html>
<html lang="en">
<head>
    <title>Jubilux Entertainment</title>
    <link rel="stylesheet" href="index.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
            background-color: #230c33;
            color: white;
        }

        header {
            background-color: #9984d4;
            height: 150px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 20px;
        }

        .Jubilux-Logo-head {
            width: 130px;
        }

        .title-home {
            font-weight: bold;
            font-size: 40px;
            text-align: center;
            flex: 1;
        }

        .btn {
            margin-left: 10px;
            padding: 10px 20px;
            background-color: #7f5dc7;
            border: none;
            border-radius: 5px;
            color: white;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .btn:hover {
            background-color: #9984d4;
        }

        .image-container {
            display: flex;
            overflow: hidden;
            white-space: nowrap;
            width: 100%;
            position: relative;
        }

        .images {
            display: inline-block;
            object-fit: fill;
            padding: 0;
            margin-right: 20px;
            width: 300px;
            border-radius: 8px;
        }

        .images:hover {
            box-shadow: 5px 5px 5px #caa8f5;
        }

        section {
            padding: 20px;
            margin: 10px;
            background-color: #3f2a60;
            border-radius: 8px;
        }

        h2 {
            text-align: center;
        }

        .flex-container {
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
        }

        .card {
            background: #fff;
            padding: 20px;
            margin: 10px;
            border-radius: 8px;
            color: black;
            width: 300px;
            text-align: center;
        }

        .testimonial {
            border-left: 4px solid #9984d4;
            padding: 10px;
            width: 300px;
            margin: 10px;
        }

        input[type="email"] {
            padding: 10px;
            margin: 10px;
            width: 300px;
        }

        footer {
            background-color: #9984d4;
            text-align: center;
            padding: 10px 0;
        }

        a {
            color: #7f5dc7;
            text-decoration: none;
        }
        
        .faq-container {
            display: flex;
            flex-direction: column;
            gap: 10px;
            max-width: 800px;
            margin: auto;
            color: black;
        }

        .faq-item {
            background-color: #f9f9f9;
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 15px;
            transition: box-shadow 0.3s;
        }

        .faq-item summary {
            font-weight: bold;
            cursor: pointer;
        }

        .faq-item:hover {
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        .faq-item p {
            margin-top: 10px;
            line-height: 1.5;
        }
    </style>
</head>
<body>
<header>
        <img class="Jubilux-Logo-head" src="images/jubilux logo.png" alt="Jubilux Logo">
        <span class="title-home">Jubilux Entertainment</span>
        <div>
            <a href="signin.html"><button class="btn">Sign In</button></a>
            <a href="signup.html"><button class="btn">Sign Up</button></a>
            <a href="search.php"><button class="btn">Search</button></a>
        </div>
</header>
    
<h2>Upcoming Events</h2>
<div class="image-container">
    <?php
    $eventImages = glob("uploads/*.{jpg,jpeg,png,gif}", GLOB_BRACE);
    foreach ($eventImages as $eventImage) {
        $eventName = htmlspecialchars(basename($eventImage));
        echo '<div class="images">';
        echo '<img src="' . $eventImage . '" alt="' . $eventName . '" class="images">';
        echo '</div>';
    }
    ?>
</div>

<section>
    <h2>Featured Events</h2>
    <div class="flex-container">
        <div class="card">
            <img src="images/sunburn.jpeg" alt="Event 1" style="width: 100%; border-radius: 8px;">
            <h3>Sunburn Festival</h3>
            <p>Date: Dec 27-28, 2024</p>
            <a href="event-details.html">View Details</a>
        </div>
        <div class="card">
            <img src="images/goa-carnival.png" alt="Event 2" style="width: 100%; border-radius: 8px;">
            <h3>Goa Carnival</h3>
            <p>Date: Feb 2025</p>
            <a href="event-details.html">View Details</a>
        </div>
    </div>
</section>

<section>
    <h2>What Our Attendees Say</h2>
    <div class="flex-container">
        <blockquote class="testimonial">
            "Had an amazing experience at the Goa Carnival! Highly recommend it!"
            <cite>- Sarah, Attendee</cite>
        </blockquote>
        <blockquote class="testimonial">
            "The Sunburn Festival was unforgettable. Can't wait for next year!"
            <cite>- John, Attendee</cite>
        </blockquote>
    </div>
</section>

<section>
    <h2>Stay Updated!</h2>
    <form style="display: flex; flex-direction: column; align-items: center;">
        <input type="email" placeholder="Enter your email" required>
        <button type="submit" class="btn">Subscribe</button>
    </form>
</section>

<section>
    <h2>Explore Event Categories</h2>
    <div class="flex-container">
        <div class="card">
            <div style="text-align: center;">
                <img src="images/music-event.jpg" alt="Music" style="width: 100%; border-radius: 8px;">
                <h3>Music Festivals</h3>
            </div>
        </div>
        <div class="card">
            <div style="text-align: center;">
                <img src="images/culturalevent.png" alt="Culture" style="width: 100%; border-radius: 8px;">
                <h3>Cultural Events</h3>
            </div>
        </div>
        <div class="card">
            <div style="text-align: center;">
                <img src="images/sports.jpg" alt="Sports" style="width: 100%; border-radius: 8px;">
                <h3>Sports Events</h3>
            </div>
        </div>
    </div>
</section>

<section>
    <h2>Follow Us</h2>
    <div style="display: flex; justify-content: center;">
        <a href="https://facebook.com" target="_blank"><img src="images/facebook-icon.png" alt="Facebook" style="width: 40px; margin: 0 10px;"></a>
        <a href="https://twitter.com" target="_blank"><img src="images/xapp.png" alt="Twitter" style="width: 40px; margin: 0 10px;"></a>
        <a href="https://instagram.com" target="_blank"><img src="images/isntagram.png" alt="Instagram" style="width: 40px; margin: 0 10px;"></a>
    </div>
</section>

<section>
    <h2>Frequently Asked Questions</h2>
    <div class="faq-container">
        <details class="faq-item">
            <summary>What types of events does Jubilux Entertainment organize?</summary>
            <p>Jubilux Entertainment organizes a variety of events including music festivals, cultural celebrations, sports competitions, and community gatherings.</p>
        </details>
        <details class="faq-item">
            <summary>How can I purchase tickets for events?</summary>
            <p>Tickets can be purchased directly through our website or at the venue on the day of the event, subject to availability.</p>
        </details>
        <details class="faq-item">
            <summary>Is there an age limit for attending events?</summary>
            <p>Age limits may vary depending on the event. Please refer to the specific event details for more information.</p>
        </details>
        <details class="faq-item">
            <summary>What should I do if I lost my ticket?</summary>
            <p>If you lose your ticket, please contact our customer support team for assistance. We will verify your purchase and help you gain entry to the event.</p>
        </details>
    </div>
</section>

<footer>
    <p>&copy; 2024 Jubilux Entertainment. All rights reserved. <br> <a href="terms.html">Terms of Service</a> | <a href="privacy.html">Privacy Policy</a></p>
</footer>
</body>
</html>
