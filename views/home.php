<?php
session_start();
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>dịch vụ sửa chữa và rửa xe tại nhà</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/home.css">
    <script src="../assets/js/home.js"></script>
</head>

<body>
    <!-- Header -->
    <header>
        <div class="container">
            <ul class="nav">
                <li class="logo">
                    <img src="../assets/images/logo.png" alt="Auto Care Logo">
                </li>
                <div class="nav-links">
                    <li><a href="home.php">Trang chủ</a></li>
                    <li><a href="branches.php">Hệ thống</a></li>
                    <li><a href="booking.php">Đặt lịch</a></li>
                    <li><a href="dich-vu-da-dat.php">Dịch vụ đã đặt</a></li>
                </div>

                <li class="user-profile">
                    <div class="profile" id="profile-btn">
                        <img src="../assets/images/Avatar-mac-dinh.png" alt="User Avatar">
                        <span class="username">
                            <?php 
                                if (isset($_SESSION["user"])) {
                                    echo htmlspecialchars($_SESSION["user"]["full_name"]);
                                } else {
                                    echo "Người dùng";
                            }
                            ?>
                        </span>
                    </div>
                    <div class="dropdown" id="profile-dropdown">
                        <ul>
                            <li><a href="profile.php">Hồ sơ</a></li>
                            <li><a href="../index.php">Đăng xuất</a></li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </header>


    <!-- Banner -->
    <section class="banner">
        <div class="banner-content">
            <h1>Xe sạch bóng, chạy ngon ơ</h1>
            <h2>Chăm sóc tận tình cho từng chi tiết</h2>

            <div class="booking-box">
                <a href="booking.php" class="btn">Đặt lịch ngay</a>
            </div>
        </div>
    </section>


    <!-- Giới thiệu -->
    <section class="about">
        <div class="container">
            <h2>Giới Thiệu</h2>
            <p>AUTO MOTO CARE là thương hiệu hàng đầu trong lĩnh vực chăm sóc và bảo dưỡng xe ô tô tại Việt Nam. Chúng
                tôi cam kết mang đến dịch vụ chuyên nghiệp và hiệu quả nhất cho khách hàng.</p>
        </div>
    </section>

    <!-- tiêu chuẩn bảo dưỡng -->
    <section class="tieu-chuan">
        <h1>TIÊU CHUẨN BẢO DƯỠNG CHĂM SÓC XE TẠI NHÀ ĐÚNG CÁCH</h1>
        <P>Tại (trang web), chúng tôi nghiên cứu và phát triển mô hình bảo dưỡng chăm sóc xe ô tô, xe máy tại nhà toàn
            diện, chất lượng cao với 3 tiêu chí sau:
        </P>
        <ul>
            <li>Quy trình: được kiểm soát nghiêm ngặt và tuân theo đúng các giai đoạn đã thiết lập.</li>
            <li>Đội ngũ kỹ thuật viên: được đào tạo bài bản, tuân thủ từng các nguyên tác khi tực hiện các dịch vụ bảo
                dưỡng chăm sóc xe tại nhà.</li>
            <li>Am hiểu chuyên môn: Áp dụng chính xác các sản phẩm, dụng cụ cho từng chi tiết khác nhau trên xe</li>
        </ul>
    </section>

    <!-- dịch vụ -->
    <section class="danh-sach-dich-vu">
        <div>
            <h1>CÁCH DỊCH VỤ ĐƯỢC CUNG CẤP BỞI AUTO MOTO CARE </h1>
            <hr>
            <p>Hai mô hình dịch vụ tiêu chuẩn được AUTO MOTO CARE cung cấp bao gồm</p>
        </div>
        <div class="tu-van">
            <h1>A. Trung tâm tư vấn chuyên gia</h1>
            <h2>Trung tâm tư vấn giải đáp khách hàng</h2>
            <p>Với AUTO MOTO CARE , cách đặt lịch hẹn cùng những thắc mắc về cách bảo dưỡng , chăm sóc xe tại nhà của
                khách hàng đều được đội ngũ của chúng tôi hỗ trợ giải đáp nhanh chóng , đúng cách</p>
            <h3>Tư vấn và giải đáp:</h3>
            <hr>
            <ul>
                <li>Cách chăm sóc ngoại nội thất xe ô tô: Rửa xe, tẩy ố kính, bụi sắt, nhựa đường, loại bỏ mùi hôi, nấm
                    mốc,…</li>
                <li>Cách bảo dưỡng nhanh và kiểm tra xe hơi cơ bản tại nhà.</li>
                <li>Tư vấn các sản phẩm chăm sóc và bảo dưỡng nhanh xe ô tô.</li>
                <li>Giải đáp các lỗi thường gặp trên khoang động cơ, phanh, lốp,…</li>
                <li>Giải đáp thắc mắc về đánh giá xe.</li>
            </ul>

        </div>

        <div class="dichvu">
            <div>
                <h1>B. Dịch vụ bảo dưỡng chăm sóc xe tại nhà của AUTO MOTO CARE</h1>
            </div>
            <div>
                <ul>
                    <li>
                        <h2>1. Chăm sóc xe tại nhà</h2>
                        <p>Cung cấp tất cả các dịch vụ chăm sóc xe tại nhà toàn diện gồm:</p>
                        <ul>
                            <li>Rửa xe đúng cách.</li>
                            <li>Vệ sinh nội thất chi tiết.</li>
                            <li>Phục hồi nhựa nhám.</li>
                            <li>Tẩy bụi sắt, chất bẩn bám cứng.</li>
                            <li>Vệ sinh khoang động cơ.</li>
                            <li>Phủ PDF bảo vệ.</li>
                        </ul>
                    </li>
                    <li>
                        <h2>2. Bảo dưỡng phanh, thắng đĩa</h2>
                        <p>Cung cấp tất cả các sản phẩm, địch vụ bảo dưỡng phanh bao gồm:</p>
                        <ul>
                            <li>Vệ sinh thắng đĩa.</li>
                            <li>Láng đĩa phanh.</li>
                            <li>Xử lý các vấn đề liên quan đến hệ thống phanh xe</li>
                        </ul>
                    </li>

                    <li>
                        <h2>3. Bảo dưỡng, thay lốp xe</h2>
                        <p>Cung cấp tất cả các sản phẩm dịch vụ bảo dưỡng thay lốp xe bao gồm:</p>
                        <ul>
                            <li>Vá lốp.</li>
                            <li>Thay lốp.</li>
                            <li>Cân mâm, bấm chì.</li>
                            <li>Vệ Sinh mâm vỏ.</li>
                            <li>Bảo dưỡng định kì.</li>
                        </ul>
                    </li>

                    <li>
                        <h2>4. Bảo dưỡng khoang động cơ</h2>
                        <p>Cung câp tất cả các dịch vụ bao gồm</p>
                        <ul>
                            <li>Vệ sinh khoang động cơ.</li>
                            <li>Thay nhớt.</li>
                            <li>Thay nước làm mát khoang động cơ.</li>
                            <li>Thay lọc gió, lọc điều hòa.</li>
                            <li>Thay lọc nhớt.</li>
                            <li>Bảo dưỡng khoang động cơ.</li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </section>

    <!-- Cam kết -->
    <section class="cam-ket">
        <div>
            <h1>CAM KẾT CỦA AUTO MOTO CARE</h1>
            <P>Là công ty chuyên cung cấp các giải pháp Bảo dưỡng chăm sóc xe hơi tại nhà hàng đầu khu vực TP HCM, chúng
                tôi cam kết mang lại những lợi ích đặc biệt dành cho đối tác, khách hàng như sau:</P>
        </div>
        <div>
            <ul>
                <li>
                    <h2>Đối với khách hàng</h2>
                    <ul>
                        <li>Tiết kiệm thời gian</li>
                        <li>nhanh chóng, tiện lợi</li>
                        <li>Giảm thiểu rủi ro về giao thông</li>
                    </ul>
                </li>

                <li>
                    <h2>Đối với nhân viên</h2>
                    <ul>
                        <li>Chủ động linh hoạt trong công việc</li>
                        <li>Tăng thêm thu nhập</li>
                        <li>Tự làm chủ dịch vụ của mình</li>
                    </ul>
                </li>

                <li>
                    <h2>Đối với AUTO MOTO CARE</h2>
                    <ul>
                        <li>Mang lại sản phẩm, dịch vụ chất lượng cao</li>
                        <li>Phục vụ tối đa nhu cầu của khách hàng</li>
                        <li>Tạo ra các giá trị chất lượng cho cuộc sống</li>
                    </ul>
                </li>

                <li>
                    <h2>Đối với xã hội</h2>
                    <ul>
                        <li>tạo ra tiện ích cho xã hội</li>
                        <li>Bảo vệ, giảm thải ra môi trường</li>
                        <li>Giảm lượng lưu thông cho hệ thống hạ tầng</li>
                    </ul>
                </li>
            </ul>
        </div>
    </section>

    <!-- phản hồi từ khách hàng -->

    <section class="testimonials">
        <div class="container">
            <h2>Phản Hồi Khách Hàng</h2>
            <div class="testimonial-item">
                <p>"Tôi thực sự ấn tượng với dịch vụ của AUTO MOTO CARE. Xe của tôi không chỉ được làm sạch kỹ lưỡng mà
                    còn được chăm sóc rất tỉ mỉ từng chi tiết. Nhân viên làm việc rất chuyên nghiệp và thân thiện. Đặc
                    biệt, việc đặt lịch trực tuyến rất tiện lợi, giúp tôi tiết kiệm được rất nhiều thời gian."</p>
                <h4>- Nguyễn Văn A</h4>
            </div>
            <div class="testimonial-item">
                <p>"Lần đầu tiên sử dụng dịch vụ rửa xe tại nhà của AUTO MOTO CARE, tôi cảm thấy vô cùng hài lòng. Xe
                    được làm sạch từ trong ra ngoài, mùi hôi trong xe cũng được xử lý triệt để. Thêm vào đó, nhân viên
                    tư vấn rất nhiệt tình, hướng dẫn tôi cách bảo dưỡng xe đúng cách. Rất đáng để thử và tôi chắc chắn
                    sẽ quay lại!"</p>
                <h4>- Trần Thị B</h4>
            </div>
            <div class="testimonial-item">
                <p>"Dịch vụ này thực sự là một giải pháp tuyệt vời cho những người bận rộn như tôi. Không cần phải ra
                    trung tâm, chỉ cần đặt lịch và chờ nhân viên đến tận nơi xử lý. Xe của tôi sạch bóng, nội thất được
                    làm mới hoàn toàn. Tôi còn nhận được nhiều lời khuyên hữu ích về cách duy trì tình trạng xe tốt
                    nhất. Cảm ơn AUTO MOTO CARE rất nhiều!"</p>
                <h4>- Lê Thị C</h4>
            </div>
            <div class="testimonial-item">
                <p>"Tôi đã thử qua nhiều dịch vụ rửa xe, nhưng AUTO MOTO CARE là nơi khiến tôi cảm thấy hài lòng nhất.
                    Nhân viên rất nhiệt tình và luôn giữ thái độ tôn trọng khách hàng. Sản phẩm sử dụng cũng là hàng
                    chính hãng, không gây hại cho xe. Tôi cảm thấy an tâm mỗi khi giao xe của mình cho đội ngũ ở đây."
                </p>
                <h4>- Phạm Văn D</h4>
            </div>
            <div class="testimonial-item">
                <p>"Một trải nghiệm trên cả tuyệt vời! Không chỉ giúp tôi tiết kiệm thời gian, dịch vụ của AUTO MOTO
                    CARE còn làm tôi bất ngờ về chất lượng. Xe tôi không chỉ sạch mà còn sáng bóng hơn hẳn. Đội ngũ kỹ
                    thuật viên rất chuyên nghiệp, giải thích rõ ràng từng bước thực hiện. Tôi sẽ giới thiệu cho bạn bè
                    và gia đình."</p>
                <h4>- Hoàng Thị E</h4>
            </div>
        </div>
    </section>

    <!-- form cho người dùng đánh giá dịch vụ -->
    <section class="review-form-section">
        <div class="container">
            <h1>Khách Hàng Đánh Giá</h1>
            <p>Chúng tôi luôn mong muốn cải thiện dịch vụ. Hãy cho chúng tôi biết ý kiến của bạn!</p>

            <form class="review-form" id="reviewForm">
                <div class="form-group">
                    <label for="name">Tên của bạn:</label>
                    <input type="text" id="name" name="name" placeholder="Ví dụ: Nguyễn Văn A" required>
                </div>

                <div class="form-group">
                    <label for="email">Email của bạn:</label>
                    <input type="email" id="email" name="email" placeholder="email@example.com" required>
                </div>

                <div class="form-group">
                    <label for="service">Bạn đã sử dụng dịch vụ nào?</label>
                    <select id="service" name="service" required>
                        <option value="">-- Chọn dịch vụ --</option>
                        <option value="rửa xe">Rửa xe</option>
                        <option value="bảo dưỡng">Bảo dưỡng</option>
                        <option value="sửa chữa">Sửa chữa</option>
                        <option value="khác">Khác</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Đánh giá dịch vụ của chúng tôi:</label>
                    <div class="stars">
                        <input type="radio" id="star-5" name="rating" value="5">
                        <label for="star-5" title="Tuyệt vời"></label>

                        <input type="radio" id="star-4" name="rating" value="4">
                        <label for="star-4" title="Tốt"></label>

                        <input type="radio" id="star-3" name="rating" value="3">
                        <label for="star-3" title="Bình thường"></label>

                        <input type="radio" id="star-2" name="rating" value="2">
                        <label for="star-2" title="Tệ"></label>

                        <input type="radio" id="star-1" name="rating" value="1">
                        <label for="star-1" title="Rất tệ"></label>
                    </div>
                </div>


                <div class="form-group">
                    <label for="comment">Nhận xét chi tiết:</label>
                    <textarea id="comment" name="comment" rows="4" placeholder="Viết nhận xét của bạn..."
                        required></textarea>
                </div>

                <button type="submit">Gửi Đánh Giá</button>
            </form>

            <div class="thank-you" id="thankYou">
                <h3>Cảm ơn bạn đã đánh giá!</h3>
                <p>Chúng tôi rất trân trọng ý kiến của bạn.</p>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container footer-container">
            <div class="footer-info">
                <h3>Liên Hệ</h3>
                <p><i class="fas fa-map-marker-alt"></i> chưa có</p>
                <p><i class="fas fa-envelope"></i> chưa có</p>
                <p><i class="fas fa-phone"></i> chưa có</p>
            </div>
            <div class="footer-social">
                <h3>Theo Dõi</h3>
                <a href="#"><img src="../assets/images/Facebook-logo.png" alt="Facebook"></a>
                <a href="#"><img src="../assets/images/Instagram-logo.png" alt="Instagram"></a>
            </div>
        </div>
    </footer>

    <!-- Nút liên hệ -->
    <div class="floating-buttons">
        <a href="tel:0835552953" class="call-button">
            <i class="fas fa-phone"></i> Gọi Ngay
        </a>
        <a href="https://zalo.me/0835552953" class="zalo-button" target="_blank" rel="noopener noreferrer">
            <img src="../assets/images/zalo-logo.png" alt="Zalo"> Zalo Chat
        </a>
    </div>
    
    <script>
        document.addEventListener("DOMContentLoaded", () => {
      const btn = document.getElementById("profile-btn");
      const dropdown = document.getElementById("profile-dropdown");

      btn.addEventListener("click", (e) => {
        e.stopPropagation();
        dropdown.style.display = dropdown.style.display === "block" ? "none" : "block";
      });

      document.addEventListener("click", () => {
        dropdown.style.display = "none";
      });
    });
    </script>
</body>
</html>