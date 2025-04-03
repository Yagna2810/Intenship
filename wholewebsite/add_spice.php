
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Masala</title>
    <style>
       /* Global Styles */
body {
    font-family: 'Poppins', sans-serif;
    background-color: #f8f9fa;
    margin: 0;
    padding: 0;
}

/* Centered Form Container */
.form-container {
    width: 70%; /* Increased width */
    max-width: 800px; /* More space for larger screens */
    margin: 50px auto;
    padding: 25px;
    background: linear-gradient(135deg, #ffffff, #f0f8ff);
    border-radius: 12px;
    box-shadow: 0 5px 12px rgba(0, 0, 0, 0.15);
    border: 3px solid #007bff;
}

/* Form Title */
h2 {
    text-align: center;
    color: #007bff;
    margin-bottom: 20px;
    font-size: 26px;
}

/* Form Elements */
form {
    display: flex;
    flex-direction: column;
}

label {
    font-weight: bold;
    color: #333;
    margin-top: 12px;
    font-size: 16px;
}

/* Inputs */
input, textarea, select {
    width: 100%;
    padding: 14px;
    margin-top: 5px;
    border: 2px solid #007bff;
    border-radius: 10px;
    font-size: 18px;
    background: #e3f2fd;
    color: #333;
    transition: all 0.3s ease-in-out;
}

input:focus, textarea:focus, select:focus {
    background: #d1ecf1;
    border-color: #0056b3;
    outline: none;
}

/* File Input */
input[type="file"] {
    padding: 8px;
    border: none;
    background: #f8f9fa;
}

/* Submit Button */
button {
    width: 100%;
    padding: 14px;
    margin-top: 25px;
    background: linear-gradient(90deg, #007bff, #6610f2);
    color: white;
    border: none;
    border-radius: 10px;
    font-size: 20px;
    cursor: pointer;
    transition: all 0.3s ease-in-out;
}

button:hover {
    background: linear-gradient(90deg, #0056b3, #6f42c1);
    transform: scale(1.05);
}

/* Responsive Design */
@media (max-width: 992px) {
    .form-container {
        width: 80%;
    }
}

@media (max-width: 768px) {
    .form-container {
        width: 90%;
    }
}

    </style>
</head>
<body>
<div class="form-container">
<form action="save_spice.php" method="post" enctype="multipart/form-data">
    <label>Name:</label>
    <input type="text" name="name" required><br>

    <label>Price-500gm:</label>
    <input type="text" name="price" required><br>

    <label>Price-100gm:</label>
    <input type="text" name="price_1" required><br>

    <label>Image 1:</label>
    <input type="file" name="image_1" required><br>

    <label>Image 2:</label>
    <input type="file" name="image_2" required><br>

    <label>City:</label>
    <input type="text" name="city" required><br>

    <label>State:</label>
    <input type="text" name="state" required><br>

    <label>How to Use:</label>
    <textarea name="how_to_use" required></textarea><br>

    <label>About the Spice: p1</label>
    <textarea name="about_spice_1" required></textarea><br>

    <label>About the Spice: p2</label>
    <textarea name="about_spice_2" required></textarea><br>
    <label>About the Spice: p3</label>
    <textarea name="about_spice_3" required></textarea><br>

    <label>Health Benefits (comma-separated):</label>
    <input type="text" name="health_benefits" placeholder="e.g., Boosts Immunity, Improves Digestion"><br>

    <button type="submit">Add Masala</button>
</form>
</div>
</body>
</html>
