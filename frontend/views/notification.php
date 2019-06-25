

<script>

    document.addEventListener('touchmove', function (event) {

        event.preventDefault();

    }, false);

</script>

<style>

    * { margin: 0; padding; 0 }

    .notification { padding: 100px 0; overflow: hidden; text-align: center; font-size: 12px; background-color: #fff; }

    .notification h1 {

        display: block; margin: 0 auto; width: 100px; margin-bottom: 20px; padding: 10px;

        font-size: 18px; background-color: #f3f4f5; border-radius: 10px;

    }

    .notification p {

        color: #f00; font-weight: bold; font-size: 20px; overflow: hidden;

        margin: 50px 0; padding: 0 10px; box-sizing: border-box;

    }

    .notification a { text-decoration: none; font-size: 12px; }

</style>

<div class="notification">



    <h1>提示信息</h1>



    <p><?= $msg; ?></p>



    <?php if ($auto): ?>

        <script>

            function redirect($url) {

                window.location.href = $url;

            }

            setTimeout("redirect('<?= $goto; ?>');", 3000);

        </script>

        <a href="<?= $goto; ?>">页面正在自动转向，也可点此直接跳转</a>

        <br/>

        <br/>

        <br/>

        <br/>

    <?php endif; ?>

</div>

