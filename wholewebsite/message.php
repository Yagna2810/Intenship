<?php
include 'db.php';

$user_message = strtolower(trim($_POST['text']));

$faq = [
    "hello" => "Hello! How can I assist you today?",
    "hi" => "Hi there! What do you need help with?",
    "how are you" => "I'm great! Ready to help you find the best masalas!",
    "what is your name" => "I'm MasalaBot, your spice expert!",
    "how can I order" => "You can browse our products and add them to your cart. Need help choosing?",
    "delivery options" => "We deliver all over India! Shipping takes 3-5 days.",
    "cash on delivery" => "Yes, we support COD as well as online payments!",
    "best masalas" => "Our best-selling masalas are Garam Masala, Red Chilli Powder, and Coriander Powder.",
    "organic masalas" => "Yes! We offer a range of organic masalas. Would you like to see them?",
    "price of turmeric powder" => "Which size do you need? We have 100g and 500g packs.",
    "discount" => "We often have special offers. Check our website for current deals!",
    "authentic products" => "Yes, we provide 100% pure masalas with no preservatives.",
    "store location" => "We are an online store, but our warehouse is in Mumbai.",
    "brands" => "We offer our own premium masala blends!",
    "gift packs" => "Yes, we have masala gift packs. Would you like to see them?",
    "track my order" => "You can track your order using your order ID on our website.",
    "cancel my order" => "Cancellations are allowed within 24 hours. Please contact customer support."
];

// **Check if user query is in predefined FAQ**
foreach ($faq as $key => $response) {
    if (strpos($user_message, $key) !== false) {
        echo $response;
        exit();
    }
}

// **Search for Matching Products in Database**
$query = "SELECT name, quantity, url FROM products WHERE LOWER(name) LIKE '%$user_message%'";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    $response = "Here are the available options for <b>$user_message</b>:<ul>";
    while ($row = mysqli_fetch_assoc($result)) {
        $response .= '<li>' . $row['name'] . ' (' . $row['quantity'] . '): <a style="color: blue;" href="' . $row['url'] . '">View Product</a></li>';

    }
    $response .= "</ul>";
    echo $response;
} else {
    echo "Sorry, I couldn't find any products related to <b>$user_message</b>. Please try another keyword.";
}
?>
