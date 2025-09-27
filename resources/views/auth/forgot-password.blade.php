<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password || IBATEK</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="shortcut icon" href="{{ asset('build/assets/images/logo/ibtk.png') }}" type="image/x-icon">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        :root {
            --orange-primary: #FF7700;
            --orange-light: #FFA557;
            --orange-dark: #E56A00;
            --orange-bg: #FFF5EB;
        }
        
        body {
            background: linear-gradient(120deg, var(--orange-bg) 0%, #f8fafc 100%);
            min-height: 100vh;
            position: relative;
            overflow-x: hidden;
        }
        
        .orange-bg {
            background-color: var(--orange-primary);
        }
        
        .orange-text {
            color: var(--orange-primary);
        }
        
        .orange-button {
            background-color: var(--orange-primary);
            transition: all 0.3s ease;
        }
        
        .orange-button:hover {
            background-color: var(--orange-dark);
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        
        .logo-container {
            background: linear-gradient(135deg, var(--orange-primary) 0%, var(--orange-light) 100%);
            width: 90px;
            height: 90px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            border: 4px solid white;
        }
        
        .floating-circle {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 119, 0, 0.1);
            z-index: -1;
        }
        
        .circle-1 {
            width: 250px;
            height: 250px;
            top: -50px;
            left: -50px;
        }
        
        .circle-2 {
            width: 150px;
            height: 150px;
            bottom: 50px;
            right: 50px;
        }
        
        .circle-3 {
            width: 100px;
            height: 100px;
            top: 50%;
            right: 100px;
        }
        
        .input-focus:focus {
            border-color: var(--orange-primary);
            box-shadow: 0 0 0 3px rgba(255, 119, 0, 0.2);
        }
        
        .form-container {
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.9);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            border-radius: 16px;
            overflow: hidden;
        }
        
        .pattern-bg {
            background: 
                radial-gradient(circle at 10% 20%, rgba(255, 167, 87, 0.1) 0%, transparent 20%),
                radial-gradient(circle at 90% 80%, rgba(255, 119, 0, 0.1) 0%, transparent 20%);
        }
        
        .info-box {
            background-color: #FFFAF0;
            border-left: 4px solid var(--orange-primary);
            border-radius: 4px;
            padding: 1rem;
            margin-bottom: 1.5rem;
        }
        
        .status-success {
            background-color: #F0FFF4;
            border-left: 4px solid #38A169;
            border-radius: 4px;
            padding: 1rem;
            margin-bottom: 1.5rem;
        }
        
        .status-error {
            background-color: #FFF5F5;
            border-left: 4px solid #E53E3E;
            border-radius: 4px;
            padding: 1rem;
            margin-bottom: 1.5rem;
        }
    </style>
</head>
<body class="flex items-center justify-center p-4 pattern-bg">
    <!-- Floating circles for background -->
    <div class="floating-circle circle-1"></div>
    <div class="floating-circle circle-2"></div>
    <div class="floating-circle circle-3"></div>
    
    <div class="w-full max-w-md form-container">
        <!-- Header dengan logo -->
        <div class="orange-bg py-6 px-6 text-center">
            <div class="logo-container">
                <i class="fas fa-key text-white text-4xl"></i>
            </div>
            <h2 class="text-white text-2xl font-bold mt-4">Reset Kata Sandi</h2>
            <p class="text-orange-100 mt-2">Masukkan email untuk reset kata sandi</p>
        </div>
        
        <div class="p-6">
            <!-- Info text -->
            <div class="info-box mb-6">
                <p class="text-gray-700 text-sm">
                    Lupa kata sandi? Tidak masalah. Beri tahu kami alamat email Anda dan kami akan mengirimkan link reset kata sandi yang memungkinkan Anda memilih yang baru.
                </p>
            </div>

            <!-- Session Status -->
            <div class="status-success mb-4" :class="{ 'hidden': !session('status') }">
                <p class="text-green-700 text-sm">{{ session('status') }}</p>
            </div>

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <!-- Email Address -->
                <div class="mb-6">
                    <label for="email" class="block text-gray-700 text-sm font-bold mb-2">
                        <i class="fas fa-envelope text-orange-500 mr-1"></i> Alamat Email
                    </label>
                    <input id="email" class="input-focus shadow appearance-none border rounded w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="email" placeholder="email@contoh.com">
                    @if ($errors->has('email'))
                        <div class="status-error mt-2">
                            <p class="text-red-500 text-xs">{{ $errors->first('email') }}</p>
                        </div>
                    @endif
                </div>

                <div class="flex items-center justify-between">
                    <a class="inline-block align-baseline font-bold text-sm orange-text hover:text-orange-800 transition-colors" href="{{ route('login') }}">
                        <i class="fas fa-arrow-left mr-1"></i> Kembali ke Login
                    </a>

                    <button type="submit" class="orange-button text-white font-bold py-3 px-6 rounded focus:outline-none focus:shadow-outline flex items-center">
                        <i class="fas fa-paper-plane mr-2"></i> Kirim Link Reset
                    </button>
                </div>
            </form>
            
            <!-- Divider -->
            <div class="relative flex items-center mt-8 mb-6">
                <div class="flex-grow border-t border-gray-300"></div>
                <span class="flex-shrink mx-4 text-gray-500 text-sm">Butuh bantuan?</span>
                <div class="flex-grow border-t border-gray-300"></div>
            </div>
            
            <!-- Support contact -->
            <div class="text-center">
                <p class="text-gray-600 text-sm">Hubungi kami di 
                    <a href="mailto:support@example.com" class="font-bold orange-text hover:text-orange-800 transition-colors">support@example.com</a>
                </p>
            </div>
        </div>
    </div>
    
    <script>
        // Menambahkan efek interaktif pada input
        document.querySelectorAll('input').forEach(input => {
            input.addEventListener('focus', () => {
                input.parentElement.classList.add('ring-2', 'ring-orange-200', 'rounded-md');
            });
            
            input.addEventListener('blur', () => {
                input.parentElement.classList.remove('ring-2', 'ring-orange-200', 'rounded-md');
            });
        });
    </script>
</body>
</html>