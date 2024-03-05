


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <script>
    function goback() {
      window.location.href = 'index.php';
    }
  </script>
  <div id="container"></div>
  <div class="flip-card" onclick="goback()">Back</div>
  <div class="contact-wrapper">
    <div class="envelope">
      <div class="back paper"></div>
      <div class="content">
        <div class="form-wrapper">
          <form method="post">
            <div class="top-wrapper">
              <div class="input">
                <label>Name</label>
                <input type="text" name="name" required />
              </div>
              <div class="input">
                <label>Phone</label>
                <input type="text" name="phone" required />
              </div>
              <div class="input">
                <label>Email</label>
                <input type="text" name="_replyto" required />
              </div>
            </div>
            <div class="bottom-wrapper">
              <div class="input">
                <label>Subject</label>
                <input type="text" name="_subject" required />
              </div>
              <div class="input">
                <label>Message</label>
                <textarea rows="5" name="message" required></textarea>
              </div>
              <div class="submit">
                <button class="submit-card" type="submit">Send Mail</button>
              </div>
            </div>
          </form>
        </div>
      </div>
      <div class="front paper"></div>
    </div>
  </div>

</body>


<style>
  body {
    /* background: linear-gradient(45deg, #bb1881, #f88b50); */
    background: url(design/1.jpg);
    background-repeat: no-repeat;
    background-size: cover;
    font-family: sans-serif;
    height: 100vh;
    width: 100vw;
    margin: 0;
  }

  .contact-wrapper {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    width: 100%;
  }

  .flip-card {
    border-radius: 0.5em;
    position: fixed;
    top: 1em;
    left: 1em;
    width: 5em;
    padding: 0.5em;
    border: 0.1em solid #fff;
    color: #fff;
    text-align: center;
    cursor: pointer;
    z-index: 9;
  }

  .envelope {
    position: relative;
    display: block;
    width: 30em;
    height: 35em;
    margin: 0 auto;
  }

  .envelope.active .content {
    padding: 15em 2em 2em;
  }

  .envelope.active .paper.front,
  .envelope.active .paper.back {
    animation-duration: 1.5s;
    animation-direction: normal;
    animation-timing-function: ease-in-out;
    animation-fill-mode: forwards;
  }

  .envelope.active .paper.front {
    animation-name: envelope-front;
  }

  .envelope.active .paper.back {
    animation-name: envelope-back;
  }

  .envelope.active .paper.back:before {
    animation-duration: 0.5s;
    animation-direction: normal;
    animation-timing-function: ease-in-out;
    animation-fill-mode: forwards;
    animation-delay: 1.25s;
    animation-name: envelope-back-before;
  }

  .envelope.active .bottom-wrapper {
    transform: rotateX(180deg);
  }

  .envelope.active .bottom-wrapper:after {
    z-index: 0;
    opacity: 1;
  }

  .envelope .content {
    padding: 2em;
    box-sizing: border-box;
    position: relative;
    z-index: 9;
    transition: all 0.5s ease-in-out;
    transition-delay: 1s;
  }

  .envelope .top-wrapper,
  .envelope .bottom-wrapper {
    box-sizing: border-box;
    background: #00a555;
    color: #fff;
  }

  .envelope .top-wrapper {
    padding: 2em 2em 0;
    border-top-left-radius: 0.5em;
    border-top-right-radius: 0.5em;
  }

  .envelope .bottom-wrapper {
    padding: 0 2em 2em;
    border-bottom-left-radius: 0.5em;
    border-bottom-right-radius: 0.5em;
    transition: all 0.5s ease-in-out;
    transform-origin: top;
    transform-style: preserve-3d;
    position: relative;
    overflow: hidden;
    margin-top: -1px;
  }

  .envelope .bottom-wrapper:after {
    position: absolute;
    content: '';
    display: block;
    opacity: 0;
    background: #03a9f5;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: -1;
  }

  .envelope form label {
    display: block;
    padding-bottom: 0.5em;
  }

  .envelope form input,
  .envelope form textarea {
    width: 100%;
    box-shadow: 0;
    background: transparent;
    color: #fff;
  }

  .envelope form input {
    border-width: 0 0 0.1em;
    border-color: #fff;
    border-style: solid;
  }

  .envelope form textarea {
    border: 0.1em solid #fff;
    border-radius: 0.25em;
  }

  .envelope form .submit-card {
    background: #fff;
    color: #222;
    text-align: center;
    padding: 0.5em;
    box-sizing: border-box;
    background: #fff;
    width: 100%;
    border: 0;
    box-shadow: none;
    border-radius: 0.25em;
    cursor: pointer;
  }

  .envelope form .input {
    padding-bottom: 1em;
  }

  .envelope .paper {
    position: absolute;
    display: block;
    top: 0;
    left: 0;
    border-bottom-left-radius: 0.5em;
    border-bottom-right-radius: 0.5em;
    overflow: hidden;
  }

  .envelope .paper.back {
    top: 0;
  }

  .envelope .paper.back:before {
    content: '';
    display: block;
    width: 0;
    height: 0;
    margin-bottom: -1px;
    border-style: solid;
    border-width: 0 15em 10em 15em;
    border-color: transparent transparent #d3d3d3 transparent;
    transform-origin: bottom;
    transform-style: preserve-3d;
    z-index: 0;
  }

  .envelope .paper.back:after {
    content: '';
    display: block;
    background-color: #d3d3d3;
    width: 30em;
    height: 20em;
  }

  .envelope .paper.front {
    top: 10em;
    box-shadow: 0.1em 0.5em 0.5em rgba(0, 0, 0, 0.25);
    z-index: 0;
  }

  .envelope .paper.front:before {
    content: '';
    display: block;
    width: 0;
    height: 0;
    border-style: solid;
    border-width: 10em 15em 0 15em;
    border-color: transparent #fff;
  }

  .envelope .paper.front:after {
    content: '';
    display: block;
    width: 30em;
    height: 10em;
    background: #fff;
    margin-top: -1px;
  }

  @media (max-width: 768px) {
    .envelope{
      width:92%;
    }
.paper{
  width:100%
}
.envelope .paper.front:before {width: auto;}
.envelope .paper.back:before {width: auto;}
.envelope .paper.front:after {width: auto;}
.envelope .paper.back:after {width: auto;}
  }

  @media (max-width: 520px) {
    .envelope{
      width:92%;
    }
.paper{
  width:100%
}
.envelope .paper {display: none;}

  }

</style>
<?php
if (isset($_POST["message"])) {
    include "connect.php";

    // Sanitize and validate input (you may want to customize this based on your needs)
    $name = mysqli_real_escape_string($conn, $_POST["name"]);
    $email = mysqli_real_escape_string($conn, $_POST["_replyto"]);
    $phone = mysqli_real_escape_string($conn, $_POST["phone"]);
    $content = mysqli_real_escape_string($conn, $_POST["message"]);
    $subject = mysqli_real_escape_string($conn, $_POST["_subject"]);

    // Insert data into the database
$stmt = $conn->prepare("INSERT INTO `message` (`name`, `phone`, `email`, `subject`, `content`) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("sssss", $name, $phone, $email, $subject, $content);
$stmt->execute();
$stmt->close();
$conn->close();
}
?>

</body>
</html>