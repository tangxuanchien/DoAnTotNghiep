<form action="upload.php" method="POST" enctype="multipart/form-data">
    <label for="image">Chọn ảnh để tải lên:</label>
    <input type="file" name="image" id="image" multiple>
    <!-- <button type="submit">Tải ảnh lên</button> -->
</form>

<script>
        const imageInput = document.getElementById('image');

        imageInput.addEventListener('change', () => {
            // Tự động submit form khi người dùng chọn file
            imageInput.form.submit();
        });
    </script>

<!-- <div class="mb-3 mt-3">
        <form action="/cloudinary/upload.php" method="POST" enctype="multipart/form-data">
            <label for="image" class="form-label">Chọn ảnh chính cho bài đăng</label>
            <input class="form-control" type="file" name="image_url">
            <button type="submit">Tải ảnh lên</button>
        </form>
    </div> -->