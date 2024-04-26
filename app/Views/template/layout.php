<html>
<head>
    <title><?=$this->renderSection('judul',true)?></title>
</head>
<body>
    <a href="#/">List Barang</a> |
    <a href="#/">Form Inputan Barang</a> |
    <a href="#/">Keranjang</a> |
    <hr>
    <h1><?=$this->renderSection('judul')?></h1>
    <hr>

    <?=$this->renderSection('konten')?>

    <p>Copyright Web Programming II</p>
</body>
</html>