<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

  <h1 class="text-danger text-center mt-4">User Data</h1>

  <div class="card w-50 m-auto mt-4">
    <div class="card-body">

      <h3>ID: {{ $course['id'] }}</h3>
      <h3>Name: {{ $course['name'] }}</h3>
      <h3>description: {{ $course['description'] }}</h3>

    </div>
  </div>

</body>

</html>
