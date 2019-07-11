<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="{{ asset('pdf_template/pdf_style.css') }}">
</head>
<body>
    
  <div id="header">
    <h1>Deatils</h1>
  </div>

       @yield('content')

  <div id="footer">
    SCMS-{{ Date('Y') }}
  </div>
     

     <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
</body>
</html>
