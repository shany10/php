<h1>Home page</h1>
<?php if(!empty($_SESSION['user'])) : ?>
    <a href="/gallery" style="display: block;">Gallery</a>
    <a href="/addUserToGroup" style="display: block;">Groupe</a>
    <a href="/upload" style="display: block;">Upload photo</a>
    <a href="/logout" style="display: block;">Logout</a>
<?php endif; ?>  