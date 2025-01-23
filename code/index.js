hidden = true;
nextButtonState = 0;
teacheridG = 0;
bundle = 1;
courseIdG=0;
$(document).ready(function () {
  $("select").select2();
  $("#courseSelect").next(".select2-container").hide();
});

// JavaScript function to handle select change
function handleMajorChange(majorId) {
  nextButtonState = 0;
  var courseInfo = document.getElementById("courseInfo");
  courseInfo.innerHTML = "";
  if (majorId == "default") {
    $("#courseSelect").next(".select2-container").hide();
    hidden = true;
    return 0;
  }
  // Add your logic here based on the selected value
  console.log("Selected value: " + majorId);
  var xhr = new XMLHttpRequest();
  var url = "fetchCourses.php";
  xhr.open("POST", url, true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  var data = "majorId=" + encodeURIComponent(majorId);
  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
      $("#courseSelect").next(".select2-container").show();
      hidden = false;
      var courseSelect = document.getElementById("courseSelect");
      // Handle the response from the PHP script
      courseSelect.innerHTML = xhr.responseText;
    }
  };

  // Send the request with the data
  xhr.send(data);
}

function handleCourseChange(courseId) {
  nextButtonState = 0;
  // Add your logic here based on the selected value
  if (courseId == "default") {
    var courseInfo = document.getElementById("courseInfo");
    courseInfo.innerHTML = "";
    return 0;
  }

  console.log("Selected value: " + courseId);
  courseIdG=courseId;
  var xhr = new XMLHttpRequest();
  var url = "fetchCourseInfo.php";
  xhr.open("POST", url, true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  var data = "courseId=" + encodeURIComponent(courseId);
  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
      var courseInfo = document.getElementById("courseInfo");
      courseInfo.innerHTML = xhr.responseText;
      var continueButton = document.getElementById("nextButton");
      continueButton.style.display = "block";
    }
  };
  // Send the request with the data
  xhr.send(data);
}


function NextButton(num) {
    var courseId = document.getElementById("courseSelect").value;

    if (num==1 && nextButtonState==1){
        document.getElementById("container").style.display = "block";
        handleCourseChange(courseId)
        document.getElementById("prevButton").style.display = "none";  
        nextButtonState = 0;
    }

  if ((num==2&& nextButtonState == 0)||(num==1&& nextButtonState == 2)) {
    console.log("numb",num,"state",nextButtonState);
    nextButtonState = 1;
    document.getElementById("container").style.display = "none";
    // Add your logic here based on the selected value
    if (courseId == "default") {
      var courseInfo = document.getElementById("courseInfo");
      courseInfo.innerHTML = "";
      return 0;
    }

    console.log("Selected value: " + courseId);
    var xhr = new XMLHttpRequest();
    var url = "fetchCourseTeachersu.php";
    xhr.open("POST", url, true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    var data = "courseId=" + encodeURIComponent(courseId);
    xhr.onreadystatechange = function () {
      if (xhr.readyState == 4 && xhr.status == 200) {
        var courseInfo = document.getElementById("courseInfo");
        courseInfo.innerHTML = xhr.responseText;
       
        // document.getElementById("nextButton").style.display = "none";
        document.getElementById("nextButton").style.display = "none";

        document.getElementById("prevButton").style.display = "block";


        //handle teacher change
        // Get all radio buttons by name
        var teachererRadioButtons = document.querySelectorAll(
          'input[name="teacher"]'
        );

        // Add a click event listener to each radio button
        teachererRadioButtons.forEach(function (radioButton) {
          radioButton.addEventListener("click", function () {
            // Handle the click event
            console.log("Selected teacher:", radioButton.id);
            teacherIdG = radioButton.id;
            var continueButton = document.getElementById("nextButton");
            continueButton.style.display = "block";
          });
        });
      }
    };
    // Send the request with the data
    xhr.send(data);
  } else if ((nextButtonState == 1&&num==2)||(nextButtonState ==3&&num==1)){
    bundle = 1;
    nextButtonState = 2;
    document.getElementById("nextButton").style.display = "block";


    var xhr = new XMLHttpRequest();
    var url = "fetchoffers.php";
    xhr.open("POST", url, true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    var data =
      "courseId=" +
      encodeURIComponent(courseId) +
      "&teacherId=" +
      encodeURIComponent(teacherIdG);
    xhr.onreadystatechange = function () {
      if (xhr.readyState == 4 && xhr.status == 200) {
          document.getElementById("courseInfo").innerHTML =xhr.responseText;
          document.getElementById("container").style.display = "none";
          

            // Get all radio buttons with the class name 'switch-input'
            var radioButtons = document.querySelectorAll('.switch-input');
        
            // Add event listener to each radio button
            radioButtons.forEach(function (radioButton,index) {
              radioButton.addEventListener('change', function () {
                // Print the value of the switched radio button
                console.log(index,'Switched to:', radioButton.value);
                if (radioButton.value=="Online") {
                radioButton.parentElement.parentElement.getElementsByClassName("priceo")[0].classList.remove("hiddenPrice")
                radioButton.parentElement.parentElement.getElementsByClassName("pricep")[0].classList.add("hiddenPrice")}
                else{
                    radioButton.parentElement.parentElement.getElementsByClassName("pricep")[0].classList.remove("hiddenPrice")
                    radioButton.parentElement.parentElement.getElementsByClassName("priceo")[0].classList.add("hiddenPrice")
                }

              });
            });

      }
    };
  }
  //state 3 checkout
  else if ((nextButtonState == 2)){
    nextButtonState = 3;
    radioName="view"+bundle;


    var radioButtons = document.getElementsByName(radioName);

    // Check which radio button is selected
    for (var i = 0; i < radioButtons.length; i++) {
      if (radioButtons[i].checked) {
        inperson= radioButtons[i].value;
      }
    }

    var xhr = new XMLHttpRequest();
    var url = "fetchCheckout.php";
    xhr.open("POST", url, true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    var data =
      "bundleId=" +
      encodeURIComponent(bundle)
      + "&teacherId="+encodeURIComponent(teacherIdG)
      + "&courseId=" + encodeURIComponent(courseIdG)
      + "&inperson=" + encodeURIComponent(inperson);
    xhr.onreadystatechange = function () {
      if (xhr.readyState == 4 && xhr.status == 200) {
          document.getElementById("courseInfo").innerHTML =xhr.responseText;
          document.getElementById("nextButton").style.display = "none";
      }
    };
  }
  // Send the request with the data
  xhr.send(data);
}

function viewTeacherInfo(teacherId) {
  console.log("Selected value: " + teacherId);
  var xhr = new XMLHttpRequest();
  var url = "fetchTeacherInfo.php";
  xhr.open("POST", url, true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  var data = "teacherId=" + encodeURIComponent(teacherId);
  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
      // Handle the response from the PHP script
      document.getElementById("teacherPopup").innerHTML = xhr.responseText;
        document.querySelector(".popupContent").style.transform =
          "translate(-50%,-50%)";
      document.getElementById("teacherPopup").style.display = "block";
      closeMain()
    }
  };

  // Send the request with the data
  xhr.send(data);
}

function closeModal() {
    document.getElementById("teacherPopup").innerHTML = "";
    document.getElementById("teacherPopup").style.display = "none";
    openMainpopup();
}
$(window).resize(function () {
  // Reinitialize Select2 on window resize
  $("select").select2();
  if (hidden == true) $("#courseSelect").next(".select2-container").hide();
});

function nextBundle(number) {
  console.log(bundle);
  console.log(number);
  currBundleid = "bundle" + bundle;
  if (number === 2) {
    if (bundle != 4) {
      nextBundleid = "bundle" + (bundle + 1);

      document.getElementById(currBundleid).classList.add("bundleBack");
      document.getElementById(currBundleid).classList.remove("bundleFront");
      document.getElementById(nextBundleid).classList.remove("bundleBack");
      document.getElementById(nextBundleid).classList.add("bundleFront");
      bundle++;
    } else {
      document.getElementById(currBundleid).classList.add("bundleBack");
      document.getElementById(currBundleid).classList.remove("bundleFront");
      document.getElementById("bundle1").classList.remove("bundleBack");
      document.getElementById("bundle1").classList.add("bundleFront");
      bundle = 1;
    }
  }
  if (number === 1) {
    if (bundle != 1) {
      nextBundleid = "bundle" + (bundle - 1);
      document.getElementById(currBundleid).classList.add("bundleBack");
      document.getElementById(currBundleid).classList.remove("bundleFront");
      document.getElementById(nextBundleid).classList.remove("bundleBack");
      document.getElementById(nextBundleid).classList.add("bundleFront");
      bundle--;
    }
   else {
    document.getElementById(currBundleid).classList.add("bundleBack");
    document.getElementById(currBundleid).classList.remove("bundleFront");
    document.getElementById("bundle4").classList.remove("bundleBack");
    document.getElementById("bundle4").classList.add("bundleFront");
    bundle = 4;
  }
}
}
function openMainpopup(){
    console.log("open mainpopup");
    document.getElementById("mainPopupBackground").style.display = "flex";
    document.getElementsByClassName("contactUs")[0].style.display="none";
    $("select").select2();
    if (hidden == true) $("#courseSelect").next(".select2-container").hide();
}

function closeMain(){
  document.getElementById("mainPopupBackground").style.display = "none";
  document.getElementsByClassName("contactUs")[0].style.display="flex";
}

window.onclick = function (event) {
    var modal = document.getElementById("mainPopupBackground");
    if (event.target == modal) {
      closeMain()
    }

    var modal2 = document.getElementById("teacherPopup");
    if (event.target == modal2) {
      closeModal();
    }
  };
  function navigateToContactUs() {
    // Navigate to contactus.php
    window.location.href = 'contactUs.php';
  }
  function ApplyCoupon(num){
    console.log("clicked  add coupon");
    coupon =document.getElementsByClassName("coupon")[num].value;
    xhr = new XMLHttpRequest();
    url="fetchCoupon.php";
    data="code="+encodeURIComponent(coupon);
    xhr.open("POST", url, true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange=function(){
      if (xhr.readyState == 4 && xhr.status == 200) {
        jsonResponse = JSON.parse(xhr.responseText)

        document.getElementsByClassName("priceo")[0].innerHTML=jsonResponse.b1;
        document.getElementsByClassName("pricep")[0].innerHTML=(jsonResponse.b1)+6;
        document.getElementsByClassName("priceo")[1].innerHTML=jsonResponse.b2;
        document.getElementsByClassName("pricep")[1].innerHTML=(jsonResponse.b2)+9;
        document.getElementsByClassName("priceo")[2].innerHTML=(jsonResponse.b3);
        document.getElementsByClassName("pricep")[2].innerHTML=(jsonResponse.b3)+12;
        document.getElementsByClassName("priceo")[3].innerHTML=(jsonResponse.b4);
        document.getElementsByClassName("pricep")[3].innerHTML=(jsonResponse.b4)+19;
      }
      
    }
    xhr.send(data)
  }
  function whatsapp(){
  
    username=document.getElementById("username").value;
    phoneNumber = document.getElementById("phoneNumber").value;
    if(phoneNumber !=""  && username!=""){
    var phone = '96176383261';
    var xhr = new XMLHttpRequest();
    var url = "fetchMessage.php";
    data="username="+username+"&phoneNumber="+phoneNumber;
    xhr.open("POST", url, true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
      if (xhr.readyState == 4 && xhr.status == 200) {
        var message =xhr.responseText;
    // Create the WhatsApp URL
    var whatsappURL = 'https://wa.me/' + phone + '?text=' + encodeURIComponent(message);
    // Open WhatsApp in a new tab or window
    placeOrder()
    window.open(whatsappURL, '_blank');
      }
    };
  // Send the request with the data
  xhr.send(data);

  }
else alert("Fill all Fields")}


function placeOrder(){
  console.log("web order");
  username=document.getElementById("username").value;
  phoneNumber = document.getElementById("phoneNumber").value;
  if(phoneNumber !=""  && username!=""){
  var xhr = new XMLHttpRequest();
  var url = "placeOrder.php";
  data="username="+username+"&phoneNumber="+phoneNumber;
  xhr.open("Post", url, true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
      document.getElementById("courseInfo").innerHTML =xhr.responseText;
      document.getElementById("prevButton").style.display = "none";
    }
  };
xhr.send(data);
}
else alert("Fill all Fields")}