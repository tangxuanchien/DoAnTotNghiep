</div>
</main>
<footer>
    <?php
        if($_SERVER['REQUEST_URI'] == '/Datn/' and !empty($_SESSION['name'])):
    ?>
    <div class="container-footer">
        <div class="box-footer">
            <ul>
                <li>
                    <img src="https://res.cloudinary.com/djdf56dfq/image/upload/v1728370944/nb6vvykp5cfauwifdhm5.png" alt="logo" height="50px">
                    <div class="box-footer-content">
                        <p> HANOIHOME được sáng lập bởi công ty cùng tên đã đi vào vận hành</p>
                        <p> hoạt động từ 2024 với mục tiêu sẽ là đơn vị đi đầu trong lĩnh vực bất</p>
                        <p> động sản áp dụng các công nghệ chuyển đổi số</p>
                    </div>
                    <ul class="li-link">
                        <li><a href="https://www.facebook.com/" target="_blank"><i class="fa-brands fa-facebook"></i></a></li>
                        <li><a href="https://www.linkedin.com/" target="_blank"><i class="fa-brands fa-linkedin"></i></a></li>
                        <li><a href="https://www.youtube.com/" target="_blank"><i class="fa-brands fa-youtube"></i></a></li>
                    </ul>
                </li>
                <li>
                    <p>Navigation</p>
                    <p>Navigation</p>
                    <p>Navigation</p>
                    <p>Navigation</p>
                    <p>Navigation</p>
                    <p>Navigation</p>
                    <p>Navigation</p>
                </li>
            </ul>
        </div>
        <div class="box-child-footer">
            DỰ ÁN LẬP TRÌNH CÁ NHÂN CỦA TĂNG XUÂN CHIẾN
        </div>
        <div class="image-footer">
            <img src="images/photo-1724780574606-9058c44a5e47.avif" alt="Footer" style="width: -webkit-fill-available; filter: saturate(0.7);">
        </div>
    </div>
    <?php endif; ?>
</footer>
</body>

</html>