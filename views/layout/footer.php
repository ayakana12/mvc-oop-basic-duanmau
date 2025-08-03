<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <footer>
        <div class="footer-content">
            <p>&copy; 2023 PolyShop. All rights reserved.</p>
        </div>
    </footer>
    
</body>
</html>
<style>
    
html, body {
    height: 100%;
    margin: 0;
    padding: 0;
}



    /* Footer Styling */
footer {
    background-color: #2c3e50; /* Dark background for contrast */
    color: #ecf0f1; /* Light text color */
    padding: 20px 0;
    width: 100%;
    text-align: center;
    margin-top: 15% ;
    
}

.footer-content {
    max-width: 1200px; /* Max width for larger screens */
    margin: 0 auto; /* Center the content */
    padding: 0 20px; /* Side padding for smaller screens */
    height: 150px; /* Fixed height for the footer */
}

.footer-content p {
    margin: 0;
    font-size: 16px; /* Readable font size */
    font-family: 'Arial', sans-serif; /* Clean font */
    line-height: 150px;
}

/* Responsive Design */
@media (max-width: 768px) {
    .footer-content p {
        font-size: 14px; /* Slightly smaller font for mobile */
    }
}
</style>