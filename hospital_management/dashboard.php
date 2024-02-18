<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hospital Dashboard</title>
    <style>
        
        body {
            background-color: #D3D3D3;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        nav {
            background-color:#00008B;
            color: white;
            padding: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        nav ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            display: flex;
            gap: 20px;
        }

        nav a {
            text-decoration: none;
            color: white;
            padding: 15px;
            transition: background-color 0.3s;
            border-radius: 5px;
        }

        nav a:hover {
            background-color: #555;
        }

        .social-icons {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .social-icons a {
            color: white;
            text-decoration: none;
            font-size: 20px;
            transition: transform 0.3s;
        }

        .social-icons a:hover {
            transform: scale(1.2);
            
        }

        .social-icons a img {
        width: 30px; /* Adjust the width as needed */
        height: auto;
        transition: transform 0.3s;  
         }

        .CON {
        list-style-type: None;
            }

        .slideshow-container {
            max-width: 80%;
            margin: auto;
            overflow: hidden;
        }

        .mySlides {
            display: none;
        }

        .mySlides img {
            width: 100%;
            height: auto;
        }

        .static-image-container {
            max-width: 100%;
            margin: auto;
            text-align: center;
            margin-top: 1px;
        }

        .static-image img {
            width: 100%;
            height: auto;
        }
        .image2{
            max-width: 100%;
            margin: auto;
            text-align: center;
            margin-top: 0px;
        }
         .image2{
            width: 100%;
            height: 50%;
         }

        .content {
            padding: 20px;
            text-align: center;
        }

        .about-section {
            background-color: #f4f4f4;
            padding: 20px;
            text-align: center;
        }

        p {
            margin-top: 0;
        }

        .logout-link {
            text-align: center;
            margin-top: 20px;
        }

        /* Style for clickable images */
        .image-container {
            display: flex;
            justify-content: space-around;
            margin: 5px auto;
        }

        .image-container .image-item {
            text-align: center;
            size: 100cm;
        }

        .image-container img {
            width: 50px; /* Adjust the width as needed */
            height: auto;
            cursor: pointer;
            transition: transform 0.3s;
        }

        .image-container img:hover {
            transform: scale(1.2);
        }

        .image-container p {
            margin: 5px 0;
        }
    </style>
</head>

<body>
    <nav>
        <ul>
            <li><a href="./dashboard.php">Home</a></li>
            <li><a href="./navbar/services.php">Services</a></li>
            <li><a href="./navbar/aboutus.php">About Us</a></li>
            <li><a href="./navbar/news.php">News</a></li>
            <li><a href="./navbar/contact.php">Contact</a></li>
        </ul>
        <div class="social-icons">
            <a href="https://www.instagram.com/azam_pasha_aa?igsh=MXhtNGg2M3Uzejkwcw==" target="_blank"><img src="./IMG/instagram.png" alt="Instagram"></a>
            <a href="https://www.facebook.com/home.php" target="_blank"><img src="./IMG/facebook.png" alt="Facebook"></a>
            <a href="https://twitter.com/i/flow/login" target="_blank"><img src="./IMG/twitter.png" alt="Twitter"></a>
        </div>
    </nav>

    <!-- Clickable images section -->
    <div class="image-container">
        <div class="image-item">
            <img src="./IMG/patient.png" alt="Patients" onclick="location.href='./patients/patients.php';">
            <p>Patients</p>
        </div>
        <div class="image-item">
            <img src="./IMG/doctor.png" alt="Appointments" onclick="location.href='./doctors/doctor.php';">
            <p>Doctors</p>
        </div>
        <div class="image-item">
            <img src="./IMG/appointment.png" alt="Appointments" onclick="location.href='./appointments/appointments.php';">
            <p>Appointments</p>
        </div>
        <div class="image-item">
            <img src="./IMG/department.png" alt="Departments" onclick="location.href='./departments/departments.php';">
            <p>Departments</p>
        </div>
        <div class="image-item">
            <img src="./IMG/med.png" alt="Medical Records" onclick="location.href='./Medical records/medicalrecords.php';">
            <p>Medical Records</p>
        </div>
    </div>

    <!-- Static image container with text -->
    <div class="static-image-container">
        <div class="static-image">
            <img src="./IMG/lp.jpg" alt="Static Image">
        </div>
    </div>

    <div class="slideshow-container">
        <div class="mySlides">
            <img src="./IMG/3.jpg" alt="Slide 1">
        </div>
        <div class="mySlides">
            <img src="./IMG/4.jpg" alt="Slide 2">
        </div>
        <div class="mySlides">
            <img src="./IMG/1.jpg" alt="Slide 3">
        </div>
        <div class="mySlides">
            <img src="./IMG/2.jpg" alt="Slide 4">
        </div>
    </div>

    <div class="content">
        <p><b><i>Why Choose Apollo Healthcare?</i></b></p>
<p>
Established by Dr Prathap C Reddy in 1983, Apollo Healthcare has a robust presence across the healthcare ecosystem. From routine wellness & preventive health care to innovative life-saving treatments and diagnostic services, Apollo Hospitals has touched more than 120 million lives from over 120 countries, offering the best clinical outcomes.
<br>
<ul class="CON">
    <li>
<b>7,000+ Healing Hands</b></li>
Largest network of the world’s finest and brightest medical experts who provide compassionate care using outstanding expertise and advanced technology. <br>
<br><li><b>4,000+ Pharmacies</b></li>

Apollo Pharmacy is India’s first, largest and most trusted branded pharmacy network, with over 4000 plus outlets covering the entire nation <br>

<br><li><b>Most Advanced Healthcare Technology</b></li>
Apollo Hospitals has been the pioneer in bringing ground-breaking healthcare technologies to India. <br>

<br><li><b>Best Clinical Outcomes</b></li>
Leveraging its vast medical expertise & technological advantage, Apollo Hospitals has consistently delivered best in class clinical outcomes..</ul></p>
    </div>

    <!-- Static image container with text -->
    <div class="image2">
        <div class="static-image">
            <img src="./IMG/apollohealthcare.jpg" alt="Static Image">
        </div>
    </div>

    <div class="about-section">
        <h2>About Hospital</h2>
        <i><p>Apollo Hospitals is a leading healthcare provider with a legacy of healing that spans several decades. Founded in 1983, Apollo Hospitals has been at the forefront of medical excellence, offering state-of-the-art facilities and a patient-centric approach to healthcare.</p>
        <p>Our dedicated team of healthcare professionals is committed to providing comprehensive and compassionate care to patients. With a network of hospitals and clinics across the country, Apollo Hospitals continues to set benchmarks in medical innovation, research, and patient care.</p>
        <p>At Apollo, we strive to make a positive impact on the health and well-being of individuals and communities. Our mission is to bring healthcare of international standards within the reach of every individual, making quality medical care accessible and affordable.</p></i>
    </div>

    <div class="logout-link">
        <a href="logout.php">Logout</a>
    </div>
</body>

</html>
