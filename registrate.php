<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport"
        content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
        crossorigin="anonymous">
    <link rel="stylesheet"
        href="css/login.css">
    <title>Registrate</title>
</head>

<body>
    <div class="container w-75 bg-primary mt-4 mb-4 rounded shadow">
        <div class="row align-items-stretch">
            <div class="col bg d-none d-lg-block col-md-5 col-lg-5 col-xl-6 rounded">

            </div>
            <div class="col bg-white p-5 rounded-end">
                <div class="text-center">
                    <p class="logo">HotFood</p>
                </div>

                <h2 class="fw-bold text-center py-4 title">Registrate</h2>

                <!-- login -->

                <form action="#">
                    <div class="mb-4">
                        <label for="user"
                            class="form-label">Correo Electronico</label>
                        <input type="text"
                            class="form-control"
                            name="user">
                    </div>
                    <div class="mb-4">
                        <label for="password"
                            class="form-label">Contraseña</label>
                        <input type="password"
                            class="form-control"
                            name="password">
                    </div>
                    <div class="mb-4">
                        <label for="password2"
                            class="form-label">Repita la Contraseña</label>
                        <input type="password"
                            class="form-control"
                            name="password2">
                    </div>
                    <div class="mb-4">
                        <label for="name"
                            class="form-label">Nombre y Apellido</label>
                        <input type="text"
                            class="form-control"
                            name="name">
                    </div>
                    <div class="mb-4">
                        <label for="phone"
                            class="form-label">Celular</label>
                        <input type="number"
                            class="form-control"
                            name="phone">
                    </div>
                    <div class="mb-4">
                        <label for="adress"
                            class="form-label">Dirección</label>
                        <input type="text"
                            class="form-control"
                            name="adress">
                    </div>


                    <div class="d-grid">
                        <button type="submit"
                            class="btn">Registrarse</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>

</html>