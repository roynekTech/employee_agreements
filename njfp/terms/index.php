<?php
$message = "";
$status = "";

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
        $message = "Error saving agreement. Please check permissions.";
        $status = "error";
    } else {
        $message = "Agreement submitted successfully 🎉";
        $status = "success";
    }
}
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
    background: rgba(15, 23, 42, 0.85);
    backdrop-filter: blur(12px);
    padding: 35px;
    border-radius: 20px;
    box-shadow: 0 15px 50px rgba(0,0,0,0.7);
    border: 1px solid rgba(255,255,255,0.08);
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

/* Popup */
.popup {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.75);
    display: none;
    align-items: center;
    justify-content: center;
    z-index: 999;
}

.popup-content {
    background: #020617;
    padding: 30px;
    border-radius: 16px;
    text-align: center;
    width: 320px;
    animation: scaleIn 0.3s ease;
    border: 1px solid rgba(255,255,255,0.1);
}

.popup.success .popup-content {
    border-left: 5px solid #22c55e;
}

.popup.error .popup-content {
    border-left: 5px solid #ef4444;
}

.popup button {
    margin-top: 15px;
    padding: 10px 20px;
    border-radius: 8px;
    border: none;
    background: #3b82f6;
    color: white;
    cursor: pointer;
}

@keyframes scaleIn {
    from {
        transform: scale(0.7);
        opacity: 0;
    }
    to {
        transform: scale(1);
        opacity: 1;
    }
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
    <p class="sub">This agreement governs your participation with Roynek Technologies.</p>

    <div class="section">
        <strong>1. Confidentiality</strong><br>
        You agree not to disclose, copy, or distribute any confidential information, research, or proprietary materials belonging to Roynek Technologies during and after your engagement.
    </div>

    <div class="section">
    <strong>2. Ownership of Work & Innovation Rights</strong><br>
        Any work, research, or development carried out during your engagement shall be jointly accessible to Roynek Technologies.<br><br>

        Where an idea, concept, or innovation originates primarily from you, you retain the right to further develop, expand, or independently build upon that idea.<br><br>

        However, by participating in this program, you grant Roynek Technologies a <b>perpetual, non-exclusive right</b> to use, adapt, commercialize, or build upon any work or research developed during your engagement.<br><br>

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

<!-- Popup -->
<div id="popup" class="popup">
    <div class="popup-content">
        <span id="popupMessage"></span>
        <button onclick="closePopup()">OK</button>
    </div>
</div>

<script>
const checkbox = document.getElementById("agree");
const button = document.getElementById("submitBtn");

checkbox.addEventListener("change", () => {
    button.disabled = !checkbox.checked;
});

function showPopup(message, type) {
    const popup = document.getElementById("popup");
    const popupMessage = document.getElementById("popupMessage");

    popupMessage.innerText = message;
    popup.classList.add(type);
    popup.style.display = "flex";
}

function closePopup() {
    const popup = document.getElementById("popup");
    popup.style.display = "none";
    popup.classList.remove("success", "error");
}
</script>

<?php if (!empty($message)): ?>
<script>
    showPopup("<?php echo $message; ?>", "<?php echo $status; ?>");
</script>
<?php endif; ?>

</body>
</html>