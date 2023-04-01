<meta name="viewport" content="width=device-width, initial-scale=1">


<link href="{{asset('front/assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
<link href="{{asset('front/assets/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
<link href="{{asset('front/assets/vendor/boxicons/css/boxicons.min.css')}}" rel="stylesheet">
<link href="{{asset('front/assets/vendor/quill/quill.snow.css')}}" rel="stylesheet">
<link href="{{asset('front/assets/vendor/quill/quill.bubble.css')}}" rel="stylesheet">
<link href="{{asset('front/assets/vendor/remixicon/remixicon.css')}}" rel="stylesheet">
<link href="{{asset('front/assets/vendor/simple-datatables/style.css')}}" rel="stylesheet">

<!-- Template Main CSS File -->
<link href="{{asset('front/assets/css/style.css')}}" rel="stylesheet">
<style>
body.modal-open {
        overflow: hidden;
    }

    .overlay {
        display: none;
        position: fixed;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        z-index: 999;
        background: rgba(255, 255, 255, 0.8) url("{{ asset('img/loader.gif') }}") center no-repeat;
    }

    /* Turn off scrollbar when body element has the loading class */
    body.loading {
        overflow: hidden;
    }

    /* Make spinner image visible when body element has the loading class */
    body.loading .overlay {
        display: block;
    }

    html {
        margin: 0;
        padding: 0;
        overflow-x: hidden;
    }
.sidebar-nav .nav-content {
  padding: 0;
  margin: 0;
  list-style: none;
  width: 94%;
  float: right;
  border-radius: 4px;
  overflow: hidden;
  margin-bottom: 5px;
}
.sidebar-nav .nav-content a {
  display: flex;
  align-items: center;
  font-size: 14px;
  font-weight: 600;
  background-color: #fff;
  color: #000;
  padding: 10px 10px 10px 25px;
  transition: 0.3s;
  border:1px solid transparent;
}
.sidebar-nav .nav-content a:hover {
  background-image: linear-gradient(90deg, #E52092, #982CBA);
  border: 1px solid #fff;
  color: #fff !important;
}
.sidebar-nav .nav-content a i {
  font-size: 6px;
  margin-right: 8px;
  line-height: 0;
  border-radius: 50%;
}
.sidebar-nav .nav-content a:hover,
.sidebar-nav .nav-content a.active {
  color: #000;
}
.sidebar-nav .nav-content a.active i {
  background-color: #4154F1;
}
</style>
