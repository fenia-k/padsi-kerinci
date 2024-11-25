<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Kerinci.Co</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Google Fonts for custom font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&display=swap">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body, html {
            width: 100%;
            height: 100%;
            font-family: Arial, sans-serif;
            background-image: url('{{ asset('storage/real.jpg') }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            display: flex;
            justify-content: flex-end; /* Align the form to the right */
            align-items: center;
            position: relative;
            padding-right: 2rem; /* Add padding to create space from the edge */
        }

        /* Logo in the top-right corner with circular style */
        .logo {
            position: absolute;
            top: 20px;
            right: 20px;
            width: 80px;
            height: 80px;
            border-radius: 50%; /* Make the logo circular */
            overflow: hidden; /* Ensure the image is clipped to the circle */
            object-fit: cover; /* Ensure the image covers the circle without distortion */
        }

        .login-container {
            text-align: center;
            color: #333;
            max-width: 400px;
            width: 100%;
        }

        .title {
            font-size: 3rem; /* Increase the title size */
            font-weight: bold;
            color: #333;
            margin-bottom: 2rem;
            font-family: 'Playfair Display', serif; /* Custom font for title */
        }

        .input-field, .select-field {
            width: 100%;
            padding: 1rem; /* Larger padding */
            padding-right: 2.5rem; /* Extra padding for the icon space */
            margin-bottom: 1rem;
            border: none;
            border-radius: 30px;
            background-color: rgba(139, 69, 19, 0.2); /* Lighter, more transparent brown */
            outline: none;
            color: #333;
            font-size: 1.3rem; /* Larger font size */
            text-align: left;
            transition: background-color 0.3s ease; /* Smooth transition for hover effect */
        }

        .input-field:hover, .select-field:hover {
            background-color: rgba(139, 69, 19, 0.4); /* Darker brown on hover */
        }

        .input-field::placeholder, .select-field option {
            color: rgba(51, 51, 51, 0.7); /* Slightly darker placeholder text for contrast */
        }

        /* Autofill background override */
        input:-webkit-autofill {
            background-color: rgba(139, 69, 19, 0.2) !important;
            color: #333 !important;
            -webkit-box-shadow: 0 0 0px 1000px rgba(139, 69, 19, 0.2) inset;
            transition: background-color 0.3s ease;
        }

        .password-container {
            position: relative;
            display: flex;
            align-items: center;
        }

        .toggle-password {
            position: absolute;
            right: 20px; /* Spacing from the right edge */
            top: 50%;
            transform: translateY(-80%); /* Center icon vertically */
            cursor: pointer;
            color: rgba(51, 51, 51, 0.7);
            font-size: 1.3rem;
        }

        .login-button {
            background-color: #b3804d; /* Warm brown color for the button */
            color: white;
            border: none;
            border-radius: 30px;
            font-size: 1.3rem; /* Larger button text */
            cursor: pointer;
            padding: 1rem;
            width: 100%;
            margin-top: 1.5rem;
            transition: background-color 0.3s ease;
        }

        .login-button:hover {
            background-color: #8c6239; /* Darker shade on hover */
        }
    </style>
</head>
<body>
    <!-- Logo positioned in the top-right corner of the background with circular style -->
    <img src="{{ asset('logo kerinci.jpg') }}" alt="Kerinci.Co Logo" class="logo">

    <div class="login-container">
        <!-- Title Centered with Custom Font -->
        <div class="title">Kerinci. Co</div>

        <!-- Login Form -->
        <form action="{{ route('login') }}" method="POST">
            @csrf

            <!-- User Selection Dropdown -->
            <!-- <div>
                <select name="user_type" class="select-field" required>
                    <option value="">User</option>
                    <option value="customer">Owner</option>
                    <option value="admin">Pegawai</option>
                </select>
            </div> -->

            <!-- Email Field (Unchanged) -->
            <div>
                <label for="email" class="sr-only">Email</label>
                <input type="email" name="email" id="email" class="input-field" placeholder="Email" required>
            </div>

            <!-- Password Field with Font Awesome Eye Icon -->
            <div class="password-container">
                <label for="password" class="sr-only">Password</label>
                <input type="password" name="password" id="password" class="input-field" placeholder="Password" required>
                <i class="fas fa-eye toggle-password" onclick="togglePasswordVisibility()"></i>
            </div>

            <!-- Login Button -->
            <button type="submit" class="login-button">Login</button>
        </form>
    </div>

    <script>
        function togglePasswordVisibility() {
            const passwordField = document.getElementById("password");
            const togglePassword = document.querySelector(".toggle-password");
            if (passwordField.type === "password") {
                passwordField.type = "text";
                togglePassword.classList.remove("fa-eye");
                togglePassword.classList.add("fa-eye-slash"); // Change icon to eye-slash
            } else {
                passwordField.type = "password";
                togglePassword.classList.remove("fa-eye-slash");
                togglePassword.classList.add("fa-eye"); // Change icon to eye
            }
        }
    </script>
</body>
</html>
