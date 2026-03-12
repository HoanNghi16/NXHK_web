<?php
    class Layout {
        public function getHeader(){
            if (isset($_SESSION['user_id'])){
                $this->getUserHeader();
                return;
            }
            echo '
            <style>
                header{
                    position:sticky;
                    top:0;
                    background:#020617;
                    z-index:100;
                }

                .navbar{
                    max-width:1200px;
                    margin:auto;
                    display:flex;
                    align-items:center;
                    justify-content:space-between;
                    padding:20px;
                }
                .nav-icons{
                    display:flex;
                    align-items:center;
                    gap:18px;
                }

                .nav-icon{
                    display:flex;
                    align-items:center;
                    justify-content:center;
                    cursor:pointer;
                }

                .nav-icon svg{
                    width:25px;
                    height:25px;
                    color:white;
                    transition:0.25s;
                }

                .nav-icon:hover svg{
                    color:#38bdf8;
                    transform:scale(1.15);
                }
                .logo{
                    font-size:24px;
                    font-weight:700;
                    color:#38bdf8;
                }

                .menu{
                    display:flex;
                    list-style:none;
                    gap:30px;
                }

                .menu a{
                    text-decoration:none;
                    color:white;
                    transition:.3s;
                }

                .menu a:hover{
                    color:#38bdf8;
                }

            </style>
            <header>
                <div class="navbar">

                    <div class="logo">NeoTech</div>

                    <ul class="menu">
                        <li><a href="#">Trang chủ</a></li>
                        <li><a href="#">Laptop</a></li>
                        <li><a href="#">Điện thoại</a></li>
                        <li><a href="#">Gaming</a></li>
                        <li><a href="#">Phụ kiện</a></li>
                    </ul>

                    <div class="nav-icons">
                        <a class="nav-icon" href="/nxhk_web/user/register.php">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M18 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0ZM3 19.235v-.11a6.375 6.375 0 0 1 12.75 0v.109A12.318 12.318 0 0 1 9.374 21c-2.331 0-4.512-.645-6.374-1.766Z" />
                            </svg>

                        </a>
                        <span class="nav-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m15.75 15.75-2.489-2.489m0 0a3.375 3.375 0 1 0-4.773-4.773 3.375 3.375 0 0 0 4.774 4.774ZM21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                        </span>
                    </div>

                </div>

            </header>
            ';
        }

        public function getUserHeader(){
            echo '
            <header>
                <div class="navbar">

                    <div class="logo">NeoTech</div>

                    <ul class="menu">
                        <li><a href="#">Trang chủ</a></li>
                        <li><a href="#">Laptop</a></li>
                        <li><a href="#">Điện thoại</a></li>
                        <li><a href="#">Gaming</a></li>
                        <li><a href="#">Phụ kiện</a></li>
                    </ul>

                    <div class="nav-icons">
                        <a class="nav-icon" href="/nxhk_web/user/register.php">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M18 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0ZM3 19.235v-.11a6.375 6.375 0 0 1 12.75 0v.109A12.318 12.318 0 0 1 9.374 21c-2.331 0-4.512-.645-6.374-1.766Z" />
                            </svg>

                        </a>
                        <span class="nav-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m15.75 15.75-2.489-2.489m0 0a3.375 3.375 0 1 0-4.773-4.773 3.375 3.375 0 0 0 4.774 4.774ZM21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                        </span>
                        <span class="nav-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                            </svg>
                        </span>
                    </div>

                </div>

            </header>
            ';
        }

        public function getFooter(){
            echo '
            <style>
                footer{
                    color:white;
                    background:#020617;
                    padding:50px 20px;
                }

                .footer-container{
                    max-width:1200px;
                    margin:auto;
                    display:flex;
                    justify-content:space-between;
                    gap:40px;
                }

                .footer-col h3{
                    margin-bottom:15px;
                }
            </style>
                    <footer>

                        <div class="footer-container">

                            <div class="footer-col">
                                <h3>NeoTech</h3>
                                <p>Website bán đồ công nghệ chính hãng.</p>
                            </div>

                            <div class="footer-col">
                                <h3>Hỗ trợ</h3>
                                <p>Chính sách bảo hành</p>
                                <p>Đổi trả</p>
                                <p>Liên hệ</p>
                            </div>

                            <div class="footer-col">
                                <h3>Liên hệ</h3>
                                <p>Email: neotech@gmail.com</p>
                                <p>Hotline: 0123 456 789</p>
                            </div>

                        </div>

                    </footer>
            ';
        }
    };
?>