<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    {{-- <form action="{{ url('/authenticate') }}" method="get">
        <h3>Our Sapp</h3>
        <input type="text" name="shop" id="" placeholder="site.myshop.com" required>
        <button type="submit">Login</button>
    </form> --}}
<div class="container m-5">
    <div class="col-md-4 offset-md-4">
        <form action="{{ url('/authenticate') }}" method="get">
            <h1 class="h3 mb-3 fw-normal">Please sign in to your store</h1>

            <div class="form-floating">
              <input type="text" class="form-control mb-3" id="floatingInput"  name="shop" placeholder="site.myshopify.com" required>
              <label for="floatingInput">Login</label>
            </div>

            <button class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>
          </form>
    </div>
</div>


</body>
</html>
