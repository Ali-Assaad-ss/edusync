    <button onclick="openModal()">Open Modal</button>

    <div id="teacherPopup">
        <div class="popupContent">
            <span id="closeBtn" onclick="closeModal()">&times;</span>
            <div class="photo"></div>
            <div class="teacherInfo">
                <div class="name">john smith</div>
                <div class="tp"> <div class="teacherHeading">Degree: </div><div>bachelor</div> </div>
                <div class="tp"> <div class="teacherHeading">Major: </div><div>bachelor</div> </div>
                <div class="tp"> <div class="teacherHeading">About: </div><div>bachelor</div> </div>
        </div>
    </div>

    <script>
        function openModal() {
            document.getElementById("teacherPopup").style.display = "flex";
            setTimeout(function () {
                document.querySelector(".popupContent").style.transform = "scale(1)";
            }, 10);
        }

        function closeModal() {
            document.querySelector(".popupContent").style.transform = "scale(0)";
            setTimeout(function () {
                document.getElementById("teacherPopup").style.display = "none";
            }, 300);
        }

        // Close modal if clicked outside the content
        window.onclick = function (event) {
            var modal = document.getElementById("teacherPopup");
            if (event.target == modal) {
                closeModal();
            }
        }
    </script>

<style>

        #teacherPopup {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
        }

        .popupContent {
            background-color: #fefefe;
            margin: 15% auto;
            border: 1px solid #888;
            width: 80%;
            height: auto;
            display: flex;
            border-radius: 10px;
            overflow: hidden;
            position: relative;
            transition: transform 0.3s ease-in-out;
            background-color: #333;
            color:#fff;
            max-width: 500px;
        }

        .teacherInfo {
            flex: 1;
            padding: 20px;
            padding-block: 130px;
            display: flex;
            flex-direction: column;
            border-left:1px solid #888;
            justify-content: space-between;
            
        }

        .photo {
            background-color: #fff;
            width: 100px;
            height: 100px;
            position: absolute;
            top:20px;
            left: 50%;
            transform: translateX(-50%);
            background-image: url("design/profile.png");
            background-repeat: no-repeat;
            background-size: cover;
            border-radius: 50%;
        }

        #closeBtn {
            position: absolute;
            color: #aaa;
            top: 10px;
            right: 10px;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }

        #closeBtn:hover {
            color: #555;
        }

        .teacherInfo p {
            margin: 5px 0px;
        }

        .tbutton {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .tbutton:hover {
            background-color: #45a049;
        }
        .name{
            text-align: center;
        }
        .teacherHeading {
            color:#addbff;
        }
        .tp{
            display: flex;
            flex-direction: row;

        }
        
        
    </style>
