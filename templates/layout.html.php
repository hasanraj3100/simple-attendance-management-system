<html>
    <head>
        <title></title>
        <link rel='stylesheet' href='style.css'>
    </head>
    <body>
        <header>
            <h1 onclick='home()'> Attendance management system</h1>
            <div class="navbar">
                <ul>
                    <li><a href="/">Home </a></li>
                    <li><a href="/courses">Manage Course</a></li>
                    <li><a href="/semesters">Manage Semester</a></li>
                    <li><a href="/departments">Manage Department</a></li>
                </ul>
            </div>
        </header>

        <main>
            <?=$output?>
        </main>

    <script>
        function home() {
  location.replace("/")
}
    </script>
    </body>
</html>