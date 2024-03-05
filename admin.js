// JavaScript function to handle select change
function handleMajorChange2(majorId) {
  // Add your logic here based on the selected value
  console.log("Selected value: " + majorId);
  var xhr = new XMLHttpRequest();
  var url = "fetchCourses.php";
  xhr.open("POST", url, true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  var data = "majorId=" + encodeURIComponent(majorId);
  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
      $("#courseSelect2").next(".select2-container").show();
      var courseSelect = document.getElementById("courseSelect2");
      // Handle the response from the PHP script
      courseSelect.innerHTML = xhr.responseText;
    }
  };

  // Send the request with the data
  xhr.send(data);
}

function handleCourseChange2(courseId) {
  // Add your logic here based on the selected value
  if (courseId == "default") return 0;

  console.log("Selected value: " + courseId);
  var xhr = new XMLHttpRequest();
  var url = "fetchCourseMajor.php";
  xhr.open("POST", url, true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  var data = "courseId=" + encodeURIComponent(courseId);
  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
      var courseInfo = document.getElementById("courseInfo2");
      courseInfo.innerHTML = xhr.responseText;
      $("select").select2();
    }
  };
  // Send the request with the data
  xhr.send(data);
}
function addCourseMajor() {
  const majorId = document.getElementById("majorSelect2").value;
  const courseId = document.getElementById("courseSelect2").value;
  console.log(courseId, majorId);

  // Check if values are not equal to "default"
  if (majorId !== "default" && courseId !== "default") {
    const xhr = new XMLHttpRequest();
    const url = "addCourseMajor.php";
    const data =
      "majorId=" +
      encodeURIComponent(majorId) +
      "&courseId=" +
      encodeURIComponent(courseId);
    xhr.open("POST", url, true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
      if (xhr.readyState === 4) {
        if (xhr.status === 200) {
          alert("major added successfully");
        } else {
          alert("Failed to add major. Status: " + xhr.status);
        }
        handleCourseChange2(courseId);
      }
    };

    xhr.send(data);
  }
}

function removeMajor(majorId) {
  const xhr = new XMLHttpRequest();
  const url = "deleteCourseMajor.php";
  const courseId = document.getElementById("courseSelect2").value;
  const data =
    "majorId=" +
    encodeURIComponent(majorId) +
    "&courseId=" +
    encodeURIComponent(courseId);

  xhr.open("POST", url, true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

  xhr.onreadystatechange = function () {
    if (xhr.readyState === 4) {
      if (xhr.status === 200) {
        alert("major deleted successfully");
      } else {
        alert("Failed to delete major. Status: " + xhr.status);
      }
      handleCourseChange2(courseId);
    }
  };

  xhr.send(data);
}

$(window).resize(function () {
  // Reinitialize Select2 on window resize
  $("select").select2();
});
// JavaScript function to handle select change
function handleMajorChange(majorId) {
  if (majorId == "default") return 0;
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
      var courseSelect = document.getElementById("courseSelect");
      // Handle the response from the PHP script
      courseSelect.innerHTML = xhr.responseText;
    }
  };

  // Send the request with the data
  xhr.send(data);
}

function handleCourseChange(courseId) {
  // Add your logic here based on the selected value
  if (courseId == "default") return 0;

  console.log("Selected value: " + courseId);
  var xhr = new XMLHttpRequest();
  var url = "fetchCourseTeachersa.php";
  xhr.open("POST", url, true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  var data = "courseId=" + encodeURIComponent(courseId);
  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
      var courseInfo = document.getElementById("courseInfo");
      courseInfo.innerHTML = xhr.responseText;
      $("select").select2();
    }
  };
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
      document.getElementById("teacherPopup").style.display = "block";
    }
  };

  // Send the request with the data
  xhr.send(data);
}

function addCourseTeacher() {
  const teacherId = document.getElementById("teacherSelect").value;
  const courseId = document.getElementById("courseSelect").value;

  // Check if values are not equal to "default"
  if (teacherId !== "default" && courseId !== "default") {
    const xhr = new XMLHttpRequest();
    const url = "addCourseTeacher.php";
    const data =
      "teacherId=" +
      encodeURIComponent(teacherId) +
      "&courseId=" +
      encodeURIComponent(courseId);

    xhr.open("POST", url, true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    xhr.onreadystatechange = function () {
      if (xhr.readyState === 4) {
        if (xhr.status === 200) {
          alert("Teacher added successfully");
        } else {
          alert("Failed to add teacher. Status: " + xhr.status);
        }
        handleCourseChange(courseId);
      }
    };

    xhr.send(data);
  }
}

function removeTeacher(teacherId) {
  const xhr = new XMLHttpRequest();
  const url = "deleteCourseTeacher.php";
  const courseId = document.getElementById("courseSelect").value;
  const data =
    "teacherId=" +
    encodeURIComponent(teacherId) +
    "&courseId=" +
    encodeURIComponent(courseId);

  xhr.open("POST", url, true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

  xhr.onreadystatechange = function () {
    if (xhr.readyState === 4) {
      if (xhr.status === 200) {
        alert("Teacher deleted successfully");
      } else {
        alert("Failed to delete teacher. Status: " + xhr.status);
      }
      handleCourseChange(courseId);
    }
  };

  xhr.send(data);
}

function closeModal() {
    document.getElementById("teacherPopup").innerHTML = "";
    document.getElementById("teacherPopup").style.display = "none";
}

// Close modal if clicked outside the content
window.onclick = function (event) {
  var modal = document.getElementById("teacherPopup");
  if (event.target == modal) {
    closeModal();
  }
};

// Add event listeners for the Save buttons
document.querySelectorAll(".tsave-btn").forEach(function (button) {
  button.addEventListener("click", function () {
    // Get the corresponding row
    var row = this.closest(".editable-row");

    // Get the data-id attribute to identify the record
    var teacherId = row.getAttribute("data-id");

    // Get the edited values from the contenteditable cells
    var name = row.cells[0].innerText.trim();
    var degree = row.cells[1].querySelector("#degreeSelect").value;
    var major = row.cells[2].innerText.trim();
    var description = row.cells[3].innerText.trim();
    var status = row.cells[4].querySelector("#statusSelect").value;

    // Send the data to the server using AJAX
    $.ajax({
      url: "updateTeacher.php",
      method: "POST",
      data: {
        teacherId: teacherId,
        name: name,
        degree: degree,
        major: major,
        description: description,
        status: status,
      },
      success: function (response) {
        // Handle the response from the server
        alert(response);
        location.reload();
      },
      error: function (xhr, status, error) {
        // Handle errors
        console.error(xhr.responseText);
      },
    });
  });
});

$("#tsearch").on("input", function () {
  var searchText = $(this).val().toLowerCase();

  // Iterate through each row in the table
  $("#teacherTable tbody tr").each(function () {
    var rowText = $(this).text().toLowerCase();
    console.log(rowText);

    // Show/hide rows based on the search input
    if (rowText.includes(searchText)) {
      $(this).show();
    } else {
      $(this).hide();
    }
  });
});

// deleting order
document.querySelectorAll(".odelete-btn").forEach(function (button) {
  button.addEventListener("click", function () {
    var userResponse = window.confirm(
      "Are you sure you want to delete this order?"
    );

    if (userResponse) {
      // User clicked "OK" (true)

      // Get the corresponding row
      var row = this.closest(".editable-row");

      // Get the data-id attribute to identify the record
      var orderId = row.getAttribute("data-id");
      $.ajax({
        url: "deleteOrder.php",
        method: "POST",
        data: {
          orderId: orderId,
        },
        success: function (response) {
          // Handle the response from the server
          alert(response);
          location.reload();
        },
        error: function (xhr, status, error) {
          // Handle errors
          console.error(xhr.responseText);
        },
      });
    }
  });
});
// deleting message
document.querySelectorAll(".mgdelete-btn").forEach(function (button) {
  button.addEventListener("click", function () {
    var userResponse = window.confirm(
      "Are you sure you want to delete this message?"
    );

    if (userResponse) {
      // User clicked "OK" (true)

      // Get the corresponding row
      var row = this.closest(".editable-row");

      // Get the data-id attribute to identify the record
      var messageId = row.getAttribute("data-id");
      $.ajax({
        url: "deleteMessage.php",
        method: "POST",
        data: {
          messageId: messageId,
        },
        success: function (response) {
          // Handle the response from the server
          alert(response);
          location.reload();
        },
        error: function (xhr, status, error) {
          // Handle errors
          console.error(xhr.responseText);
        },
      });
    }
  });
});
// reading message
document.querySelectorAll(".mgread").forEach(function (button) {
  button.addEventListener("click", function () {
    var row = this.closest(".editable-row");
    row.classList.add("seen");
    // Get the data-id attribute to identify the record
    var messageId = row.getAttribute("data-id");
    $.ajax({
      url: "readMessage.php",
      method: "POST",
      data: {
        messageId: messageId,
      },
      success: function (response) {
        // Handle the response from the server
        document.getElementById("messagePopup").innerHTML = response;
        document.getElementById("messagePopupBackground").style.display = "flex";
      },
      error: function (xhr, status, error) {
        // Handle errors
        console.error(xhr.responseText);
      },
    });
  });
});


function closeMessage(event){
    if ((event.target.id === 'messagePopupBackground')||(event.target.id==='messagecloseBtn')) {
    document.getElementById('messagePopupBackground').style.display="none";}
}

//deleting teacher information
document.querySelectorAll(".tdelete-btn").forEach(function (button) {
  button.addEventListener("click", function () {
    var userResponse = window.confirm(
      "Are you sure you want to delete this teacher?"
    );

    if (userResponse) {
      // User clicked "OK" (true)

      // Get the corresponding row
      var row = this.closest(".editable-row");

      // Get the data-id attribute to identify the record
      var teacherId = row.getAttribute("data-id");
      $.ajax({
        url: "deleteTeacher.php",
        method: "POST",
        data: {
          teacherId: teacherId,
        },
        success: function (response) {
          // Handle the response from the server
          alert(response);
          location.reload();
        },
        error: function (xhr, status, error) {
          // Handle errors
          console.error(xhr.responseText);
        },
      });
    }
  });
});

function addTeacher() {
  // Get the corresponding row
  var row = document.getElementById("newTeacher");

  // Get the edited values from the contenteditable cells
  var name = row.cells[0].innerText.trim();
  var degree = row.cells[1].querySelector("#degreeSelect").value;
  var major = row.cells[2].innerText.trim();
  var description = row.cells[3].innerText.trim();
  var status = row.cells[4].querySelector("#statusSelect").value;
  // Send the data to the server using AJAX
  $.ajax({
    url: "addTeacher.php",
    method: "POST",
    data: {
      teacherName: name,
      teacherDegree: degree,
      teacherMajor: major,
      teacherDescription: description,
      status: status,
    },
    success: function (response) {
      // Handle the response from the server
      alert(response);
      location.reload();
    },
    error: function (xhr, status, error) {
      // Handle errors
      console.error(xhr.responseText);
    },
  });
}

// Add event listeners for the Save buttons
document.querySelectorAll(".msave-btn").forEach(function (button) {
  button.addEventListener("click", function () {
    // Get the corresponding row
    var row = this.closest(".editable-row");

    // Get the data-id attribute to identify the record
    var majorId = row.getAttribute("data-id");

    // Get the edited values from the contenteditable cells
    var name = row.cells[0].innerText.trim();

    // Send the data to the server using AJAX
    $.ajax({
      url: "updatemajor.php",
      method: "POST",
      data: {
        majorId: majorId,
        name: name,
      },
      success: function (response) {
        // Handle the response from the server
        alert(response);
        location.reload();
      },
      error: function (xhr, status, error) {
        // Handle errors
        console.error(xhr.responseText);
      },
    });
  });
});

document.querySelectorAll(".cpsave-btn").forEach(function (button) {
  button.addEventListener("click", function () {
    // Get the corresponding row
    var row = this.closest(".editable-row");

    // Get the data-id attribute to identify the record
    var ocode = row.getAttribute("data-id");

    var code = row.cells[0].innerText.trim();
    var discount = row.cells[1].innerText.trim();

    // Send the data to the server using AJAX
    $.ajax({
      url: "updatecoupon.php",
      method: "POST",
      data: {
        ocode: ocode,
        code: code,
        discount: discount,
      },
      success: function (response) {
        // Handle the response from the server
        alert(response);
        location.reload();
      },
      error: function (xhr, status, error) {
        // Handle errors
        console.error(xhr.responseText);
      },
    });
  });
});


//deleting Coupon info
document.querySelectorAll(".cpdelete-btn").forEach(function (button) {
  button.addEventListener("click", function () {
    var userResponse = window.confirm(
      "Are you sure you want to delete this copon?"
    );

    if (userResponse) {
      // User clicked "OK" (true)

      // Get the corresponding row
      var row = this.closest(".editable-row");

      // Get the data-id attribute to identify the record
      var code = row.getAttribute("data-id");
      $.ajax({
        url: "deleteCoupon.php",
        method: "POST",
        data: {
          code: code,
        },
        success: function (response) {
          // Handle the response from the server
          alert(response);
          location.reload();
        },
        error: function (xhr, status, error) {
          // Handle errors
          console.error(xhr.responseText);
        },
      });
    }
  });
});
//deleting major
document.querySelectorAll(".mdelete-btn").forEach(function (button) {
  button.addEventListener("click", function () {
    var userResponse = window.confirm(
      "Are you sure you want to delete this teacher?"
    );

    if (userResponse) {
      // User clicked "OK" (true)

      // Get the corresponding row
      var row = this.closest(".editable-row");

      // Get the data-id attribute to identify the record
      var majorId = row.getAttribute("data-id");
      $.ajax({
        url: "deleteMajor.php",
        method: "POST",
        data: {
          majorId: majorId,
        },
        success: function (response) {
          // Handle the response from the server
          alert(response);
          location.reload();
        },
        error: function (xhr, status, error) {
          // Handle errors
          console.error(xhr.responseText);
        },
      });
    }
  });
});

function addCoupon() {
  
  // Get the corresponding row
  var row = document.getElementById("newCoupon");

  // Get the edited values from the contenteditable cells
  var code = row.cells[0].innerText.trim();
  var discount = row.cells[1].innerText.trim();
  // Send the data to the server using AJAX
  $.ajax({
    url: "addCoupon.php",
    method: "POST",
    data: {
      code: code,
      discount:discount,
    },
    success: function (response) {
      // Handle the response from the server
      alert(response);
      location.reload();
    },
    error: function (xhr, status, error) {
      // Handle errors
      console.error(xhr.responseText);
    },
  });
}
function addMajor() {
  // Get the corresponding row
  var row = document.getElementById("newMajor");

  // Get the edited values from the contenteditable cells
  var major = row.cells[0].innerText.trim();

  // Send the data to the server using AJAX
  $.ajax({
    url: "addMajor.php",
    method: "POST",
    data: {
      major: major,
    },
    success: function (response) {
      // Handle the response from the server
      alert(response);
      location.reload();
    },
    error: function (xhr, status, error) {
      // Handle errors
      console.error(xhr.responseText);
    },
  });
}
$("#msearch").on("input", function () {
  var searchText = $(this).val().toLowerCase();

  // Iterate through each row in the table
  $("#majorTable tbody tr").each(function () {
    var rowText = $(this).text().toLowerCase();
    console.log(rowText);

    // Show/hide rows based on the search input
    if (rowText.includes(searchText)) {
      $(this).show();
    } else {
      $(this).hide();
    }
  });
});
// Add event listeners for the Save buttons
document.querySelectorAll(".csave-btn").forEach(function (button) {
  button.addEventListener("click", function () {
    // Get the corresponding row
    var row = this.closest(".editable-row");

    // Get the data-id attribute to identify the record
    var courseId = row.getAttribute("data-id");

    // Get the edited values from the contenteditable cells
    var name = row.cells[0].innerText.trim();
    var description = row.cells[1].innerText.trim();
    var level = row.cells[2].innerText.trim();

    // Send the data to the server using AJAX
    $.ajax({
      url: "updateCourse.php",
      method: "POST",
      data: {
        courseId: courseId,
        courseName: name,
        courseDescription: description,
        courseLevel: level,
      },
      success: function (response) {
        // Handle the response from the server
        alert(response);
        location.reload();
      },
      error: function (xhr, status, error) {
        // Handle errors
        console.error(xhr.responseText);
      },
    });
  });
});

$("#csearch").on("input", function () {
  var searchText = $(this).val().toLowerCase();

  // Iterate through each row in the table
  $("#courseTable tbody tr").each(function () {
    var rowText = $(this).text().toLowerCase();
    console.log(rowText);

    // Show/hide rows based on the search input
    if (rowText.includes(searchText)) {
      $(this).show();
    } else {
      $(this).hide();
    }
  });
});

//deleting teacher information
document.querySelectorAll(".cdelete-btn").forEach(function (button) {
  button.addEventListener("click", function () {
    var userResponse = window.confirm(
      "Are you sure you want to delete this Course?"
    );

    if (userResponse) {
      // User clicked "OK" (true)

      // Get the corresponding row
      var row = this.closest(".editable-row");

      // Get the data-id attribute to identify the record
      var courseId = row.getAttribute("data-id");
      $.ajax({
        url: "deleteCourse.php",
        method: "POST",
        data: {
          courseId: courseId,
        },
        success: function (response) {
          // Handle the response from the server
          alert(response);
          location.reload();
        },
        error: function (xhr, status, error) {
          // Handle errors
          console.error(xhr.responseText);
        },
      });
    }
  });
});

function addCourse() {
  var row = document.getElementById("newCourse");

  var name = row.cells[0].innerText.trim();
  var majorId = row.cells[1].querySelector("#majorSelect").value;
  var description = row.cells[2].innerText.trim();
  var level = row.cells[3].innerText.trim();

  if (majorId == "default") {
    alert("choose a major");
    return 0;
  }
  // Send the data to the server using AJAX
  $.ajax({
    url: "addCourse.php",
    method: "POST",
    data: {
      courseName: name,
      courseMajor: majorId,
      courseDescription: description,
      courseLevel: level,
    },
    success: function (response) {
      // Handle the response from the server
      alert(response);
      location.reload();
    },
    error: function (xhr, status, error) {
      // Handle errors
      console.error(xhr.responseText);
    },
  });
}

// update order
document.querySelectorAll(".osave-btn").forEach(function (button) {
  button.addEventListener("click", function () {
    // Get the corresponding row
    var row = this.closest(".editable-row");

    // Get the data-id attribute to identify the record
    var orderId = row.getAttribute("data-id");

    // Get the edited values from the contenteditable cells
    var name = row.cells[1].innerText.trim();
    var phone = row.cells[2].innerText.trim().toUpperCase();
    var teacherId = row.cells[3].querySelector("#oteacherSelect").value;
    var courseId = row.cells[4].querySelector("#ocourseSelect").value;
    var Bundle = row.cells[5].innerText.trim().toUpperCase();
    var Price = row.cells[6].innerText.trim();
    var Status = row.cells[8].innerText.trim();

    // Send the data to the server using AJAX
    $.ajax({
      url: "updateOrder.php",
      method: "POST",
      data: {
        id: orderId,
        username: name,
        PhoneNumber: phone,
        teacherId: teacherId,
        courseId: courseId,
        Bundle: Bundle,
        Price: Price,
        Status: Status,
      },
      success: function (response) {
        // Handle the response from the server
        alert(response);
        location.reload();
      },
      error: function (xhr, status, error) {
        // Handle errors
        console.error(xhr.responseText);
      },
    });
  });
});

function admin(page) {
    resetColors();
    document.getElementById(page).classList.add("menuSelected");
    $.ajax({
            url: 'fetchAdmin.php',
            method: 'POST',
            data: {
                page: page,
            },
            success: function(response) {
                document.getElementById("main").innerHTML=response;
                $(document).ready(function() {
                    $('select').select2();
                    var script = document.createElement('script');
                    script.src = 'admin.js';
                    document.getElementById("scriptDiv").innerHTML="";
                    document.getElementById("scriptDiv").appendChild(script);
    });
            },
            error: function(xhr, status, error) {
                // Handle errors
                console.error(xhr.responseText);
            }
        });
    
}

function resetColors() {
        var menuItems = document.querySelectorAll("#menu div");
        menuItems.forEach(function (item) {
            item.classList.remove("menuSelected");
        });
    }

    function updatePrice() {
      // Get values from HTML elements
      var basePrice = document.getElementById("basePrice").value;
      var degreeAdd = document.getElementById("degreeAdd").value;
      var levelAdd = document.getElementById("levelAdd").value;
  
      // Send data using AJAX
      $.ajax({
          type: "POST",
          url: "updatePrice.php",
          data: {
              basePrice: basePrice,
              degreeAdd: degreeAdd,
              levelAdd: levelAdd
          },
          success: function(response) {
              // Handle the response if needed
              alert(response);
          },
          error: function(error) {
              // Handle errors if needed
              console.log(error);
          }
      });
  }
  

$("select").select2();



$('document').ready(function () {
  var trigger = $('#hamburger'),
      isClosed = false;

  trigger.click(function () {
    burgerTime();
  });

  function burgerTime() {
    if (isClosed == true) {
      trigger.removeClass('is-open');
      trigger.addClass('is-closed');
      isClosed = false;
      document.getElementById("menu").style.display ="none";
      
    } else {
      trigger.removeClass('is-closed');
      trigger.addClass('is-open');
      isClosed = true;
      document.getElementById("menu").style.display ="flex";
    }
  }

});