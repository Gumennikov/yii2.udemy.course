<div class="file-loading">
    <input id="input-pr-rev" name="input-pr-rev[]" type="file" multiple>
</div>

<script>
    $("#input-pr-rev").fileinput({
        uploadUrl: "/file-upload-batch/1",
        theme: 'explorer-fas',
        uploadAsync: true,
        reversePreviewOrder: true,
        initialPreviewAsData: true,
        overwriteInitial: false,
        initialPreview: [
            "http://lorempixel.com/800/460/animals/3",
            "http://lorempixel.com/800/460/animals/4",
            "http://lorempixel.com/800/460/animals/5",
            "http://lorempixel.com/800/460/animals/6",
            "http://lorempixel.com/800/460/animals/7"
        ],
        initialPreviewConfig: [
            {caption: "Animals-3.jpg", size: 628782, width: "120px", url: "/site/file-delete", key: 3},
            {caption: "Animals-4.jpg", size: 628782, width: "120px", url: "/site/file-delete", key: 4},
            {caption: "Animals-5.jpg", size: 628782, width: "120px", url: "/site/file-delete", key: 5},
            {caption: "Animals-6.jpg", size: 628782, width: "120px", url: "/site/file-delete", key: 6},
            {caption: "Animals-7.jpg", size: 628782, width: "120px", url: "/site/file-delete", key: 7}
        ],
        allowedFileExtensions: ["jpg", "png", "gif"]
    }).on('filesorted', function(e, params) {
        console.log('Modified initial preview is ', $("#input-pr-rev").data('fileinput').initialPreview);
    })
</script>

<?php \metalguardian\fotorama\Fotorama::$useCDN = true; ?>

<?php
$fotorama = \metalguardian\fotorama\Fotorama::begin(
    [
        'options' => [
            'loop' => true,
            'hash' => true,
            'ratio' => 800/600,
        ],
        'spinner' => [
            'lines' => 20,
        ],
        'tagName' => 'span',
        'useHtmlData' => false,
        'htmlOptions' => [
            'class' => 'custom-class',
            'id' => 'custom-id',
        ],
    ]
);
?>
<img src="http://s.fotorama.io/1.jpg" alt="">
<img src="http://s.fotorama.io/2.jpg" alt="">
<img src="http://s.fotorama.io/3.jpg" alt="">
<img src="http://s.fotorama.io/4.jpg" alt="">
<img src="http://s.fotorama.io/5.jpg" alt="">
<?php \metalguardian\fotorama\Fotorama::end(); ?>

<?php
echo \metalguardian\fotorama\Fotorama::widget(
    [
        'items' => [
            ['img' => 'http://s.fotorama.io/1.jpg', 'id' => 'id-one',],
            ['img' => 'http://s.fotorama.io/2.jpg',],
            ['img' => 'http://s.fotorama.io/3.jpg',],
            ['img' => 'http://s.fotorama.io/4.jpg',],
        ],
        'options' => [
            'nav' => 'thumbs',
        ]
    ]
);
?>
