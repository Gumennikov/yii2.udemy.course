<?php
/**
 * Created by PhpStorm.
 * User: ISAV-HP
 * Date: 31.07.2019
 * Time: 7:27
 */
?>

<h3>Основное представление для конструирования макета страницы</h3>

<div id="div1" class="div1">
    <p>div1</p>
    <a href="#" id="select2">Подгрузить сюда php-файл с представлением для рендера select2</a>
</div>

<br>

<div id="div2" class="div2">
    <p>div2</p>
</div>

<div id="div3" class="div3">
    <p>div3</p>
</div>

<script>
    $(document).ready(function(){
        $("#select2").click(function(){
            $("#div1").load('test-page-select2');
        });
    });
</script>

<script>
    $(document).ready(function(){
        $("#div2").click(function() {
            $.ajax({
                type: "GET",
                url: "test-page-select2",
                dataType: "json"
            });
        });
    });
</script>

<script type="text/javascript">
    $(document).ready(function(){
        $("#div3").load('test-page-select2');

    });
</script>
