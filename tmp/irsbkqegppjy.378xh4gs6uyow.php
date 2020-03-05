<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>easyTeach | <?= ($pageTitle) ?></title>
    <link rel="stylesheet" href="https://unpkg.com/purecss@1.0.1/build/pure-min.css"
        integrity="sha384-oAOxQR6DkCoMliIh8yFnu25d7Eq/PHS21PClpwjOTeU2jRSq11vu66rf90/cZr47" crossorigin="anonymous" />
    <link rel="stylesheet" type="text/css" href="/css/layout.css" />

    <?php foreach (($csspaths?:[]) as $path): ?>

        <link rel="stylesheet" href="<?= ($path) ?>">
    <?php endforeach; ?>

</head>

<body>

    <div class="wrapper">
        <header class="site-header">

            <form class="header-logo">
                <!-- Icons made by <a href="https://www.flaticon.com/authors/freepik" title="Freepik">Freepik</a> from <a href="https://www.flaticon.com/" title="Flaticon"> www.flaticon.com</a> -->
                <input class="logo" type="image" src="/media/saxophone.png" alt="saxophone_logo"
                    formaction="<?= (Base::instance()->alias('homepage')) ?>">
            </form>

            <a href="<?= (Base::instance()->alias('homepage')) ?>">
                <h1 class="page-title"><?= ($mainHeading) ?></h1>
            </a>

        </header>
        <nav>
            
            <ul>
                <li><a href="<?= (Base::instance()->alias('students')) ?>">
                        <h3>Students</h3>
                    </a></li>
                <li><a href="<?= (Base::instance()->alias('lessons')) ?>">
                        <h3>Lessons</h3>
                    </a></li>
                <li><a href="<?= (Base::instance()->alias('calendar')) ?>">
                        <h3>Calendar</h3>
                    </a></li>
                <li><a href="addjoke.php">
                        <h3>Earnings</h3>
                    </a></li>
            </ul>

            </h3>
        </nav>
        <main>

            <?php echo $this->render($content,NULL,get_defined_vars(),0); ?>

            <p><a href="<?= ($url) ?>"><?= ($name) ?></a></p>

            <?php foreach (($result?:[]) as $item): ?>
                <span><?= ($item['name']) ?></span>
            <?php endforeach; ?>

        </main>

        <footer class="site-footer">


            <form class="pure-form pure form-stacked">
                <button class="pure-button" onclick="history.go(-1);">Back </button>
            </form>

          <span> &copy; easyTeach <?= (date('Y')) ?></span>
           
        </footer>
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <?php foreach (($jScripts?:[]) as $script): ?>
        <script src="<?= ($script) ?>"></script>
    <?php endforeach; ?>

</body>

</html>