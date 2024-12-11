<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <title>Admin Dashboard</title>
  <link rel="stylesheet" href="	https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>

<body>
  <nav>
    <div class="logo">
      <div class="logo-image">
        <img src="logo.png" alt="">
      </div>
    </div>
    <div class="menu-items">
      <ul class="navLinks">
        <li class="navList active">
          <a href="#">
            <ion-icon name="home-outline"></ion-icon>
            <span class="links">Dashboard</span>
          </a>
        </li>
        <li class="navList">
          <a href="#">
            <ion-icon name="folder-outline"></ion-icon>
            <span class="links">Content</span>
          </a>
        </li>
        <li class="navList">
          <a href="#">
            <ion-icon name="analytics-outline"></ion-icon>
            <span class="links">Analytics</span>
          </a>
        </li>
        <li class="navList">
          <a href="#">
            <ion-icon name="heart-outline"></ion-icon>
            <span class="links">Likes</span>
          </a>
        </li>
        <li class="navList">
          <a href="#">
            <ion-icon name="chatbubbles-outline"></ion-icon>
            <span class="links">Comments</span>
          </a>
        </li>
      </ul>
      <ul class="bottom-link">
        <li>
          <a href="#">
            <ion-icon name="person-circle-outline"></ion-icon>
            <span class="links">Profile</span>
          </a>
        </li>
        <li>
          <a href="#">
            <ion-icon name="log-out-outline"></ion-icon>
            <span class="links">Logout</span>
          </a>
        </li>
      </ul>
    </div>
  </nav>
  
  <table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">First</th>
        <th scope="col">Last</th>
        <th scope="col">Handle</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <th scope="row">1</th>
        <td>Mark</td>
        <td>Otto</td>
        <td>@mdo</td>
      </tr>
      <tr>
        <th scope="row">2</th>
        <td>Jacob</td>
        <td>Thornton</td>
        <td>@fat</td>
      </tr>
      <tr>
        <th scope="row">3</th>
        <td colspan="2">Larry the Bird</td>
        <td>@twitter</td>
      </tr>
    </tbody>
  </table>

</body>

</html>