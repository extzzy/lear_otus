<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="description" content="" />
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors" />
  <meta name="generator" content="Hugo 0.88.1" />
  <title>Dashboard Template · Bootstrap v5.1</title>

  <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/dashboard/" />

  <!-- Bootstrap core CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet" />

  <style>

    .bd-placeholder-img {
      font-size: 1.125rem;
      text-anchor: middle;
      -webkit-user-select: none;
      -moz-user-select: none;
      user-select: none;
    }

    @media (min-width: 768px) {
      .bd-placeholder-img-lg {
        font-size: 3.5rem;
      }
    }
  </style>

  <!-- Custom styles for this template -->
  <link href="dashboard.css" rel="stylesheet" />
</head>

<body>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#">Company name</a>
    <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse"
      data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search" />
    <div class="navbar-nav">
      <div class="nav-item text-nowrap">
        <a class="nav-link px-3" href="#">Sign out</a>
      </div>
    </div>
  </header>

  <div class="container-fluid">
    <div class="row">
      <?php require 'left.php'; ?>

      <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div
          class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
          <h1 class="h2">Failover tests</h1>
          <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
              <button type="button" class="btn btn-sm btn-outline-secondary">
                Share
              </button>
              <button type="button" class="btn btn-sm btn-outline-secondary">
                Export
              </button>
            </div>
            <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
              <span data-feather="calendar"></span>
              This week
            </button>
          </div>
        </div>

        <div class="row">
          <div class="col">
            <select class="form-control form-control-sm" id="mySelect">
              <option value="0">MongoDB replicaset (keepalived)</option>
              <option value="1">MongoDB replicaset (vanila)</option>
              <option value="2">Cassandra</option>
            </select>
          </div>
          <div class="col">
            <button type="button" class="btn btn-sm btn-success" id="btn-start" onclick="start()">
              Start
            </button>
            <button type="button" class="btn btn-danger btn-sm" id="btn-stop" onclick="stop()" disabled>
              Stop
            </button>
            <input type="hidden" value="false" id="running" />
          </div>
          <div class="col">
            <span id="spanMaster">Master: db.runCommand("ismaster").primary;</span>
          </div>
          <div class="col">
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <label class="input-group-text" for="inputGroupSelect01">Interval</label>
              </div>
              <select class="form-control form-control-sm" id="inputGroupSelect01">
                  <option value="100">100 ms</option>
                  <option value="500" selected>500 ms</option>
                  <option value="1000">1 sec</option>
                  <option value="3000">3 sec</option>
              </select>
            </div>
          </div>
        </div>
        <br />
        <div class="form-group">
          <textarea class="form-control" id="exampleFormControlTextarea1" rows="2" disabled></textarea>
        </div>

        <canvas height="60vh" id="myChart2"></canvas>

        <div class="row">
          <div class="col">

            <button type="button" class="btn btn-success">"Оживить" мастера</button>
            <button type="button" class="btn btn-danger">"Убить" мастера</button>
            <button type="button" class="btn btn-warning">Переключить мастера</button>
          </div>
        
          <div class="col">
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <label class="input-group-text" for="inputCountDots">Count dots</label>
              </div>
              <select class="form-control form-control-sm" id="inputCountDots">
                  <option value="100" selected>100</option>
                  <option value="500">500</option>
                  <option value="1000">1000</option>
                  <option value="3000">3000</option>
              </select>
            </div>
          </div>

        </div>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
          var ctx = document.getElementById("myChart2").getContext("2d");
          var chart = new Chart(ctx, {
            type: "line",
            data: {
              labels: [],
              datasets: [
                {
                  label: "Connection time",
                  data: [],
                  backgroundColor: "rgba(255, 99, 132, 0.2)",
                  borderColor: "rgba(255, 99, 132, 1)",
                  borderWidth: 1,
                },
              ],
            },
            options: {
              scales: {
                y: {
                  beginAtZero: true,
                },
              },
            },
          });


        </script>

       

        <script type="text/javascript">
           var values = [
            "mongodb://admin:36BbnDJNCcAJEWaoTlzmgRpzK@192.168.200.60:27017",
            "mongodb://admin:36BbnDJNCcAJEWaoTlzmgRpzK@192.168.200.56:27017,192.168.200.57:27017,192.168.200.58:27017/?replicaSet=mongo_repl",
            "mongodb://rs1.example.com,rs2.example.com/?replicaSet=myReplicaSet",
            "Значение 3",
            "Значение 4",
          ];

          var select = document.getElementById("mySelect");
          var textarea = document.getElementById("exampleFormControlTextarea1");
          var selectedIndex = select.value;
          textarea.value = values[selectedIndex];
          select.addEventListener("change", function () {
            var selectedIndex = select.value;
            textarea.value = values[selectedIndex];
          });

          function checkMaster() {
            interval = document.getElementById("inputGroupSelect01"); 
            var select = document.getElementById("mySelect");
            var selectedIndex = select.value;
            var running = document.getElementById("running");
            
            $.ajax({
              url: "getmaster.php?", // Обращаемся к PHP файлу для проверки подключения
              type: "POST",
              data:{"source":values[selectedIndex]},
              success: function (response) {
                //$("#connection-result").prepend("<br>" + response); // Отображаем результат на странице
                //$("#connection-result").prepend("<br>" + values[selectedIndex]); // Отображаем результат на странице
                var answer = response;
                $("#spanMaster").text(answer);
              },
              error: function (xhr, status, error) {
                $("#spanMaster").prepend("<br>" + response); // Отображаем результат на странице
              },
            });
            setTimeout(checkMaster, interval.value);
          }
          checkMaster();

          function sendSomething() {
            interval = document.getElementById("inputGroupSelect01"); 
            var select = document.getElementById("mySelect");
            var selectedIndex = select.value;
            var running = document.getElementById("running");
            
            $.ajax({
              url: "getdata.php?", // Обращаемся к PHP файлу для проверки подключения
              type: "POST",
              data:{"source":values[selectedIndex]},
              success: function (response) {
                
                //$("#connection-result").prepend("<br>" + response); // Отображаем результат на странице

                //$("#connection-result").prepend("<br>" + values[selectedIndex]); // Отображаем результат на странице
                if (running.value === "true") {
                  var answer = "<tr><td> Способ подключения </td><td> Время </td><td> Ошибка (ответ) </td><td>" + response + "</td></tr>";
                  $("#connection-result").prepend(answer);
                  addData("Dataset", response);
                }
              },
              error: function (xhr, status, error) {
                $("#connection-result").prepend("<br>" + response); // Отображаем результат на странице
                //$("#connection-result").prepend(
                //  "Ошибка при проверке подключения к MongoDB"
                //);
              },
            });
            setTimeout(sendSomething, interval.value);
          }
          sendSomething();



          function addData(label, newData) {
            var dots = document.getElementById("inputCountDots");
            if (chart.data.labels.length > dots.value) {
                chart.data.labels.shift();
                chart.data.datasets[0].data.shift();
            }
            var today = new Date();
            var now = today.toLocaleTimeString("ru-RU");
            chart.data.labels.push(now);
            chart.data.datasets.forEach((dataset) => {
              dataset.data.push(newData);
            });

            
            chart.update();
          }

          function start() {
            var start = document.getElementById("btn-start");
            var stop = document.getElementById("btn-stop");
            var running = document.getElementById("running");

            if (running.value === "false") {
              running.value = "true";
              start.disabled = true;
              stop.disabled = false;
            }
          }

          function stop() {
            var start = document.getElementById("btn-start");
            var stop = document.getElementById("btn-stop");
            var running = document.getElementById("running");

            if (running.value === "true") {
              running.value = "false";
              start.disabled = false;
              stop.disabled = true;
            }
          }

         
        </script>

        <div>
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Header</th>
              <th scope="col">Header</th>
              <th scope="col">Время подключения</th>
            </tr>
          </thead>
          <tbody id="connection-result">

          </tbody>
        </table>
        </div>
      </main>

      <script src="js/bootstrap.bundle.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js"
        integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE"
        crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"
        integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha"
        crossorigin="anonymous"></script>
      </div>
  </div>
</body>

</html>