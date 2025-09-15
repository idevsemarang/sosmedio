    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="assets/js/script.js"></script>
    <script>
        initializePage();
    </script>

    <?php
    if (isset($pushScripts)) {
        include $pushScripts;
    }
    ?>
    </body>

    </html>