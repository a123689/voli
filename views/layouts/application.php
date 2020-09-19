<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Volio Text On Photo</title>
  <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <link href="assets/css/sb-admin-2.min.css" rel="stylesheet">
  <link href="assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
  <script src="assets/vendor/jquery/jquery.min.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
</head>

<body id="page-top">
  <style>
    .switch {
      position: relative;
      display: inline-block;
      width: 60px;
      height: 34px;
    }

    .switch input {
      opacity: 0;
      width: 0;
      height: 0;
    }

    .slider {
      position: absolute;
      cursor: pointer;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background-color: #ccc;
      -webkit-transition: .4s;
      transition: .4s;
    }

    .slider:before {
      position: absolute;
      content: "";
      height: 26px;
      width: 26px;
      left: 4px;
      bottom: 4px;
      background-color: white;
      -webkit-transition: .4s;
      transition: .4s;
    }

    input:checked+.slider {
      background-color: #2196F3;
    }

    input:focus+.slider {
      box-shadow: 0 0 1px #2196F3;
    }

    input:checked+.slider:before {
      -webkit-transform: translateX(26px);
      -ms-transform: translateX(26px);
      transform: translateX(26px);
    }

    /* Rounded sliders */
    .slider.round {
      border-radius: 34px;
    }

    .slider.round:before {
      border-radius: 50%;
    }
  </style>
  <style>
    .lds-roller {
      display: inline-block;
      position: relative;
      width: 80px;
      height: 80px;
    }

    .lds-roller div {
      animation: lds-roller 1.2s cubic-bezier(0.5, 0, 0.5, 1) infinite;
      transform-origin: 40px 40px;
    }

    .lds-roller div:after {
      content: " ";
      display: block;
      position: absolute;
      width: 7px;
      height: 7px;
      border-radius: 50%;
      background: red;
      margin: -4px 0 0 -4px;
    }

    .lds-roller div:nth-child(1) {
      animation-delay: -0.036s;
    }

    .lds-roller div:nth-child(1):after {
      top: 63px;
      left: 63px;
    }

    .lds-roller div:nth-child(2) {
      animation-delay: -0.072s;
    }

    .lds-roller div:nth-child(2):after {
      top: 68px;
      left: 56px;
    }

    .lds-roller div:nth-child(3) {
      animation-delay: -0.108s;
    }

    .lds-roller div:nth-child(3):after {
      top: 71px;
      left: 48px;
    }

    .lds-roller div:nth-child(4) {
      animation-delay: -0.144s;
    }

    .lds-roller div:nth-child(4):after {
      top: 72px;
      left: 40px;
    }

    .lds-roller div:nth-child(5) {
      animation-delay: -0.18s;
    }

    .lds-roller div:nth-child(5):after {
      top: 71px;
      left: 32px;
    }

    .lds-roller div:nth-child(6) {
      animation-delay: -0.216s;
    }

    .lds-roller div:nth-child(6):after {
      top: 68px;
      left: 24px;
    }

    .lds-roller div:nth-child(7) {
      animation-delay: -0.252s;
    }

    .lds-roller div:nth-child(7):after {
      top: 63px;
      left: 17px;
    }

    .lds-roller div:nth-child(8) {
      animation-delay: -0.288s;
    }

    .lds-roller div:nth-child(8):after {
      top: 56px;
      left: 12px;
    }

    @keyframes lds-roller {
      0% {
        transform: rotate(0deg);
      }

      100% {
        transform: rotate(360deg);
      }
    }
  </style>
  <?= @$content ?>
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="assets/js/sb-admin-2.min.js"></script>
  <script src="assets/vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>
  <script src="assets/js/demo/datatables-demo.js"></script>
</body>

</html>