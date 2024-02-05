<nav class="navbar navbar-expand-lg navbar-light bg-warning fixed-top">
    <img src="resource/img/tesdalogo1.jpg" height="72px;" alt="tesda logo">
    <div class="logotesda"><h1>TESDA</h1> </div>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup"
        aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav ml-auto">
            <a class="nav-item nav-link">User: <b><?php echo $user->data()->fname." ||"; ?></b></a>
            <a class="nav-item nav-link text-danger" href="time"><div id="timer">Time remaining: <span id="minutes"></span> minutes<span id="seconds"></span> seconds</div></a>
        </div>
    </div>
</nav>