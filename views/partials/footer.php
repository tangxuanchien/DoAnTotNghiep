</div>
</main>
<footer>
    <?php
        if($_SERVER['REQUEST_URI'] == '/Datn/' and !empty($_SESSION['name'])):
    ?>
    <div class="container-footer">

        <div class="box-footer">
            HANOIHOME footer
        </div>
        <div class="box-child-footer">
            Bản quyền sáng tác thuộc về TangXuanChien
        </div>
        <div class="image-footer">
            <img src="images/photo-1724780574606-9058c44a5e47.avif" alt="Footer" style="width: -webkit-fill-available; filter: saturate(0.7);">
        </div>
    </div>
    <?php endif; ?>
</footer>
</body>

</html>