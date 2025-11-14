<?php

 $message = $_POST["message"] ?? 'ola';

 $files = scandir("./messages");
 $num_files = count($files) - 2; // Subtract 2 for . and ..

 $fileName = "msg-{$num_files}.txt";

 $file = fopen("./messages/{$fileName}", 'x');

 fwrite($file, $message);

 fclose($file);

 header("Location: index.php");

?>