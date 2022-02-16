<?php 
    require_once 'vendor/autoload.php';
    function scandir1($dir)
    {
        return  count(array_values(array_diff(scandir($dir), array('..', '.'))));
    }
    if (isset($_POST['sub'])) {
    $getval = $_POST['color'];
    $colorval= $getval; 

    $img = scandir1('img');
    for ($i=0; $i < $img; $i++) { 
    $path = "img/$i.jpeg";
    $pathsaved = "img-changed/$i.jpg";
   $client = new GuzzleHttp\Client();
   $res = $client->post('https://api.remove.bg/v1.0/removebg', [
       'multipart' => [
           [
               'name'     => 'image_file',
               'contents' => fopen($path, 'r')
           ],
           [
               'name'     => 'size',
               'contents' => 'auto'
             
   
           ],
           [
                'name'     => 'bg_color',
                'contents' => $colorval
           ]
       ],
       'headers' => [
           'X-Api-Key' => 'AFwp4miPzM27mtwZe51h6EWV'
       ]
   ]);
   
   $fp = fopen($pathsaved, "wb");
   if (fwrite($fp, $res->getBody())) {
    echo $path." ->  Sukses Terganti "."<br>";
   }
   fclose($fp);
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Convert BG</title>
</head>
<body>
    <h3> Must Format .jpeg </h3>
Name of file must numeric begin 0 <br>
Example 0.jpeg , 1.jpeg .....
    <form method="post">
    <label for="favcolor">Pilih Warna</label>
        <input type="color" id="color" name="color" value="#ff0000" required>
        <input type="submit" value="Choose" id="sub" name="sub" > 
    </form>

</body>
</html>
