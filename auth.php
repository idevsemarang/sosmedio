<?php include "header.php" ?>


<div id="authSection" class="auth-container">

    <div class="w-100 text-center mb-4">
        <img src="assets/images/logo-sosmedio.png" class="mx-auto" width="100px">
    </div>
    <!-- Login Form -->
    <form id="loginForm">

        <div class="mb-3">
            <label for="">Email</label>
            <input type="email" class="form-control" name="email" placeholder="Email" required>
        </div>
        <div class="mb-4">
            <label for="">Password</label>
            <input type="password" name="password" class="form-control" placeholder="Kata Sandi" required>
        </div>
        <button type="button" id="btn-for-loginForm" class="btn btn-success w-100" onclick="handleLogin('login.php', 'loginForm')">Masuk</button>
        <p class="text-center mt-3">Belum punya akun? <a href="#" id="showRegister">Daftar sekarang</a></p>
    </form>

    <!-- Register Form (initially hidden) -->
    <form id="registerForm" style="display: none;">
        <div class="mb-3">
            <label for="">Nama</label>
            <input type="text" class="form-control" name="name" placeholder="Nama Lengkap" required>
        </div>
        <div class="mb-3">
            <label for="">Email</label>
            <input type="email" name="email" class="form-control" placeholder="Email" required>
        </div>
        <div class="mb-3">
            <label for="">Negara</label>
            <select name="country_id" class="form-control support-live-select2" id="select-country"></select>
        </div>
        <div class="mb-4">
            <label for="">Password</label>
            <input type="password" name="password" class="form-control" placeholder="Kata Sandi" required>
        </div>
        <button type="button" id="btn-for-registerForm" class="btn btn-success w-100" onclick="handleRegister('register.php', 'registerForm')">Daftar</button>
        <p class="text-center mt-3">Sudah punya akun? <a href="#" id="showLogin">Masuk</a></p>
    </form>
</div>

<?php
$pushScripts = "extends/auth-scripts.php";

include "footer.php";
?>