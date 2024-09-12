<?php
// 1. Tải lên ảnh (Upload Image)
$upload = $cloudinary->uploadApi()->upload($file);
echo "URL của ảnh là: " . $upload['secure_url'];


// 2. Xóa ảnh (Delete Image)
// Để xóa ảnh trên Cloudinary, bạn cần sử dụng public_id của ảnh. public_id là một chuỗi định danh duy nhất mà Cloudinary tạo ra hoặc bạn có thể tự chỉ định trong khi tải ảnh lên.
// Lấy public_id từ kết quả của việc tải lên:
$upload = $cloudinary->uploadApi()->upload($file);
$public_id = $upload['public_id']; // Lấy public_id của ảnh đã tải lên
// Xóa ảnh:
$result = $cloudinary->uploadApi()->destroy($public_id);
echo "Ảnh đã được xóa: " . json_encode($result);


// 3. Cập nhật ảnh (Update Image)
// Khi muốn cập nhật thông tin hoặc thay thế ảnh, bạn có thể sử dụng public_id để cập nhật. Ví dụ, bạn có thể cập nhật các thông số như tags, context, hoặc thay thế ảnh hiện tại bằng ảnh khác.
// Thay thế ảnh (bằng cách tải lại với cùng public_id):
$upload = $cloudinary->uploadApi()->upload($file, ['public_id' => $public_id]);
echo "Ảnh đã được cập nhật. URL mới là: " . $upload['secure_url'];
// Cập nhật thông tin ảnh:
$cloudinary->uploadApi()->explicit($public_id, [
    'tags' => 'new_tag',  // Cập nhật thẻ (tags)
    'context' => 'caption=New Caption',  // Cập nhật ngữ cảnh (context)
]);


// 4. Lấy danh sách ảnh (List Images)
// Cloudinary cũng cung cấp phương thức để liệt kê các ảnh trong tài khoản của bạn.
$resources = $cloudinary->adminApi()->resources();
foreach ($resources['resources'] as $resource) {
    echo "Public ID: " . $resource['public_id'] . " - URL: " . $resource['secure_url'] . "<br>";
}


// 5. Lấy thông tin chi tiết của ảnh (Get Image Details)
// Bạn có thể lấy thông tin chi tiết về ảnh bằng public_id:
$details = $cloudinary->adminApi()->resource($public_id);
echo "Thông tin ảnh: " . json_encode($details);


// 6. Chuyển đổi ảnh (Image Transformation)
// Cloudinary hỗ trợ nhiều kiểu biến đổi ảnh thông qua URL hoặc API, chẳng hạn như thay đổi kích thước, cắt, nén ảnh:
// Ví dụ: Thay đổi kích thước ảnh:
$upload = $cloudinary->uploadApi()->upload($file, [
    'transformation' => [
        'width' => 300,
        'height' => 300,
        'crop' => 'fit'
    ]
]);
