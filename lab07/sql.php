<!DOCTYPE html>
<html>
    <head>
        <title>php-sql</title>
    </head>
    <body>
        <form method="post">
            database name : <input type="text" name="dbname" />
            <br />
            query : <input type="text" name="query" />
            <br />
            <input type="submit" value="submit"/>
        </form>
        <?php
        if(isset($_POST["dbname"]) and isset($_POST["query"])) {

            $dbname = $_POST["dbname"];
            $db = new PDO("mysql:dbname=$dbname", "root", "asd890");
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sqlquery = $_POST["query"];
            $rows = $db->query($sqlquery,PDO::FETCH_ASSOC);
        ?>
            <ul>
        <?php
            foreach ($rows as $row) {
                ?>
                <li><?php foreach ($row as $col) {
                    print($col." ");
                } ?></li>
        <?php
                }
        ?>
            </ul>
        <?php
            }
        ?>
    </body>
</html>        