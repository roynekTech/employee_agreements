<?php
// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     $name = htmlspecialchars($_POST['name']);
//     $email = htmlspecialchars($_POST['email']);
//     $date = date("Y-m-d H:i:s");

//     $entry = "Name: $name | Email: $email | Date: $date\n";

//     file_put_contents("agreements.txt", $entry, FILE_APPEND);

//     echo "<script>alert('Agreement submitted successfully');</script>";
// }
// ?>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = preg_replace("/[^a-zA-Z0-9]/", "_", $_POST['name']);
    $email = $_POST['email'];
    $date = date("Y-m-d_H-i-s");

    $dir = __DIR__ . "/agreements/";
    $filename = $dir . $name . "_" . $date . ".txt";

    $content = "Name: $name\n";
    $content .= "Email: $email\n";
    $content .= "Date: " . date("Y-m-d H:i:s") . "\n";
    $content .= "Status: AGREED\n";

    $result = file_put_contents($filename, $content);

    if ($result === false) {
        die("Error writing file. Check folder permissions.");
    }

    echo "<script>alert('Agreement submitted successfully');</script>";
}
?>


<?php
// if ($_SERVER["REQUEST_METHOD"] == "POST") {

//     $name = preg_replace("/[^a-zA-Z0-9]/", "_", $_POST['name']);
//     $email = $_POST['email'];
//     $date = date("Y-m-d_H-i-s");

//     // Use absolute path
//     $dir = __DIR__ . "/agreements/";

//     if (!file_exists($dir)) {
//         if (!mkdir($dir, 0755, true)) {
//             die("Failed to create directory");
//         }
//     }

//     $filename = $dir . $name . "_" . $date . ".txt";

//     $content = "Name: $name\n";
//     $content .= "Email: $email\n";
//     $content .= "Date: " . date("Y-m-d H:i:s") . "\n";
//     $content .= "Status: AGREED\n";

//     $result = file_put_contents($filename, $content);

//     if ($result === false) {
//         die("Error writing file. Check permissions.");
//     }

//     echo "<script>alert('Agreement submitted successfully');</script>";
// }
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Roynek Agreement</title>

<style>
body {
    margin: 0;
    font-family: 'Segoe UI', sans-serif;
    background: radial-gradient(circle at top, #0f172a, #020617);
    color: #fff;
}

.container {
    max-width: 850px;
    margin: 50px auto;
    background: rgba(15, 23, 42, 0.8);
    backdrop-filter: blur(10px);
    padding: 30px;
    border-radius: 20px;
    box-shadow: 0 10px 40px rgba(0,0,0,0.6);
    border: 1px solid rgba(255,255,255,0.1);
}

h1 {
    font-size: 30px;
    margin-bottom: 10px;
}

.sub {
    color: #94a3b8;
    margin-bottom: 25px;
}

.section {
    margin-bottom: 20px;
    line-height: 1.7;
    color: #cbd5f5;
    font-size: 15px;
}

strong {
    color: #fff;
}

input {
    width: 100%;
    padding: 14px;
    margin-top: 10px;
    border-radius: 10px;
    border: none;
    background: #1e293b;
    color: #fff;
}

.checkbox {
    margin-top: 20px;
    display: flex;
    gap: 10px;
    align-items: center;
}

button {
    width: 100%;
    margin-top: 20px;
    padding: 15px;
    border-radius: 12px;
    border: none;
    font-size: 16px;
    font-weight: bold;
    background: linear-gradient(135deg, #6366f1, #3b82f6);
    color: white;
    cursor: pointer;
    transition: 0.3s;
}

button:hover {
    transform: scale(1.02);
    opacity: 0.9;
}

button:disabled {
    background: gray;
    cursor: not-allowed;
}

.footer {
    text-align: center;
    margin-top: 20px;
    color: #64748b;
    font-size: 13px;
}
</style>
</head>

<body>

<div class="container">
    <h1>Confidentiality & Engagement Agreement</h1>
    <p class="sub">
        This agreement governs your participation with Roynek Technologies.
    </p>

    <div class="section">
        <strong>1. Confidentiality</strong><br>
        You agree not to disclose, copy, or distribute any confidential information, research, or proprietary materials belonging to Roynek Technologies during and after your engagement.
    </div>

    <div class="section">
        <strong>2. Ownership of Work & Innovation Rights</strong><br>
        Any work, research, or development carried out during your engagement shall be jointly accessible to Roynek Technologies.<br><br>

        Where an idea, concept, or innovation originates primarily from you, you retain the right to further develop, expand, or independently build upon that idea.<br><br>

        However, by participating in this program, you grant Roynek Technologies a **perpetual, non-exclusive right** to use, adapt, commercialize, or build upon any work or research developed during your engagement.<br><br>

        This ensures that both you and the organization can continue benefiting from the innovation without restricting each other’s growth.
    </div>

    <div class="section">
        <strong>3. Non-Disclosure</strong><br>
        You shall not share sensitive or internal information with any third party without written permission.
    </div>

    <div class="section">
        <strong>4. Professional Conduct</strong><br>
        You agree to act with integrity, professionalism, and respect throughout your engagement.
    </div>

    <div class="section">
        <strong>5. Breach</strong><br>
        Violation of this agreement may result in termination and possible legal action.
    </div>

    <form method="POST">
        <input type="text" name="name" placeholder="Full Name" required>
        <input type="email" name="email" placeholder="Email Address" required>

        <div class="checkbox">
            <input type="checkbox" id="agree">
            <label for="agree">I agree to the terms</label>
        </div>

        <button id="submitBtn" disabled>Agree & Submit</button>
    </form>

    <div class="footer">
        Roynek Technologies © <?php echo date("Y"); ?>
    </div>
</div>

<script>
const checkbox = document.getElementById("agree");
const button = document.getElementById("submitBtn");

checkbox.addEventListener("change", () => {
    button.disabled = !checkbox.checked;
});
</script>

</body>
</html>