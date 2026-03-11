<?php
    class ToastController{
        public function showToast($message, $type, $timelife){
            echo '
                <style id="toast-style">
                    .toast{
                        width: 300px;
                        padding: 15px;
                        position: fixed;
                        left: 50%;
                        text-align: center;
                        transform: translateX(-50%);
                        margin: 100px auto;
                        color: white;
                        border-radius: 10px;
                        animation: fadeOut ' . ($timelife / 1000) . 's forwards;
                        z-index: 1000;
                    }
                    .success{
                        background-color: green;
                    }
                    .error{
                        background-color: red;
                    }
                    .closeBtn{
                        position: absolute;
                        top: 5px;
                        right: 10px;
                        background: none;
                        border: none;
                        color: white;
                        font-size: 19px;
                        cursor: pointer;
                    }
                </style>
                <script>
                    setTimeout(()=>{
                        document.getElementById("toast").remove();
                        document.getElementById("toast-style").remove();
                    },'.$timelife.')
                </script>
                <div id="toast" class="toast ' . $type . '">
                    <h5>
                        ' . $message . '
                    </h5>
                    <button class="closeBtn" onclick="this.parentElement.remove()">x</button>
                </div>
            ';
        }
    }
?>