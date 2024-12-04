<div class="container d-flex justify-content-center align-items-center ">
    <div class="card p-4 shadow" style="width: 100%; max-width: 400px; border-color: #006A67;">
        
        <h2 class="text-center mb-4" style="color: #006A67;">Connexion</h2>

        <?php if(isset($error)): ?>
            <div class="alert alert-danger text-center"><?php echo $error; ?></div>
        <?php endif; ?>

        <form method="POST" action="login.php">
            <div class="form-group mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" id="email" name="email" class="form-control" required>
            </div>

            <div class="form-group mb-3">
                <label for="password" class="form-label">Mot de passe</label>
                <input type="password" id="password" name="password" class="form-control" required>
            </div>

            <button type="submit" class="btn w-100" style="background-color: #006A67; color: white;">Se connecter</button>
        </form>
    </div>
</div>