<!DOCTYPE html>

<html>
<head>
    <title>Amazon Parser</title>
</head>
<body>

<h1>Amazon Parser</h1>
<h2>First matched product</h2>

<?php
if ($query) {
    // in case if some product's attribute is not found
    $noValue = '<b>?????</b>';
    ?>

    Title:
    <?php echo ($firstProduct['title']) ? $firstProduct['title'] : $noValue; ?>
    <br/>

    Price:
    <?php echo ($firstProduct['price']) ? $firstProduct['price'] : $noValue; ?>
    <br/>

    Image:
    <?php echo ($firstProduct['imgUrl']) ? '<p><img src="'.$firstProduct['imgUrl'].'"></p>' : $noValue; ?>
    <br/>

    Description:
    <?php echo $firstProduct['description'] ? '<br/>'.$firstProduct['description'] : $noValue ;

} else {
    $url = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'].'?query=iphone';
    ?>

    Set some keyword at GET parameter 'query'.
    <br/>
    For example: <a href="<?php echo $url; ?>"><?php echo $url; ?></a>

<?php
}
?>

</body>
</html>