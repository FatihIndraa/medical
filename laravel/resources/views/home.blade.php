<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Medical</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <nav class="navbar navbar-expand-md navbar-dark bg-primary py-3">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="{{ '/' }}">
                <i class="bi bi-heart-fill me-2"></i> Medical
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navcol-2">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navcol-2">
                <ul class="navbar-nav">
                    @auth
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <b>Selamat datang, {{ auth()->user()->name }}</b>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="/dashboard"><i class="bi bi-calendar-check"></i> My
                                        Dashboard</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <form action="/logout">
                                        @csrf
                                        <button type="submit" class="dropdown-item"><i class="bi bi-box-arrow-left"></i>
                                            Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @else
                        <li class="nav-item">
                            <a href="/login" class="nav-link active"><i class="bi bi-box-arrow-in-right"></i> Login</a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="https://source.unsplash.com/1600x600/?hospital" class="d-block w-100 img-fluid"
                    alt="Hospital">
            </div>
            <div class="carousel-item">
                <img src="https://source.unsplash.com/1600x600/?medical" class="d-block w-100 img-fluid" alt="Medical">
            </div>
            <div class="carousel-item">
                <img src="https://source.unsplash.com/1600x600/?doctor" class="d-block w-100 img-fluid" alt="Doctor">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-8">
                @auth
                    <h2 class="mb-4">Selamat datang di Medical, {{ auth()->user()->name }}</h2>
                @endauth
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed aliquet felis vel velit pretium, sit
                    amet ultrices leo feugiat. Integer id nisi ac urna vestibulum rhoncus. Cras auctor nec sem vel
                    finibus. Integer volutpat erat at ipsum sollicitudin, vel scelerisque odio venenatis.</p>
                <p>Vestibulum dapibus justo vitae leo pulvinar scelerisque. Curabitur ut orci a libero tempus hendrerit.
                    Duis et semper ex. In hac habitasse platea dictumst. Nam ullamcorper tellus eget justo volutpat,
                    eget aliquet nisi consequat.</p>
                <p>Ut interdum, magna nec molestie elementum, ipsum metus pellentesque urna, in consectetur ipsum libero
                    non nisi. Donec elementum sapien a ex pharetra, sit amet aliquam purus pellentesque. Duis sit amet
                    nulla ligula. Duis id enim a ex vehicula consequat eget et tortor.</p>
            </div>
            <div class="col-lg-4">
                <h3 class="mb-4">Make a Complaint</h3>
                <form>
                    <div class="mb-3">
                        <label for="complaintSubject" class="form-label">Subject</label>
                        <input type="text" class="form-control" id="complaintSubject" placeholder="Enter subject">
                    </div>
                    <div class="mb-3">
                        <label for="complaintMessage" class="form-label">Message</label>
                        <textarea class="form-control" id="complaintMessage" rows="5" placeholder="Enter your complaint"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>

    <div class="container mt-5">
        <h2 class="mb-4">Featured Content</h2>
        <div class="row">
            <div class="col-lg-4 mb-4">
                <div class="card">
                    <img src="https://source.unsplash.com/400x300/?medical" class="card-img-top" alt="Medical Image">
                    <div class="card-body">
                        <h5 class="card-title">Medical Article 1</h5>
                        <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#exampleModal">
                            Read More
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 mb-4">
                <div class="card">
                    <img src="https://source.unsplash.com/400x300/?hospital" class="card-img-top"
                        alt="Hospital Image">
                    <div class="card-body">
                        <h5 class="card-title">Hospital News</h5>
                        <p class="card-text">Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#exampleModal">
                            Read More
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 mb-4">
                <div class="card">
                    <img src="https://source.unsplash.com/400x300/?doctor" class="card-img-top" alt="Doctor Image">
                    <div class="card-body">
                        <h5 class="card-title">Doctor's Advice</h5>
                        <p class="card-text">Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut
                            aliquip ex ea commodo consequat.</p>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#exampleModal">
                            Read More
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Article Title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <img src="https://source.unsplash.com/800x600/?medical" class="img-fluid mb-3" alt="Modal Image">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed aliquet felis vel velit pretium, sit
                        amet
                        ultrices leo feugiat. Integer id nisi ac urna vestibulum rhoncus. Cras auctor nec sem vel
                        finibus. Integer
                        volutpat erat at ipsum sollicitudin, vel scelerisque odio venenatis.</p>
                    <p>Vestibulum dapibus justo vitae leo pulvinar scelerisque. Curabitur ut orci a libero tempus
                        hendrerit. Duis
                        et semper ex. In hac habitasse platea dictumst. Nam ullamcorper tellus eget justo volutpat, eget
                        aliquet
                        nisi consequat.</p>
                    <p>Ut interdum, magna nec molestie elementum, ipsum metus pellentesque urna, in consectetur ipsum
                        libero non
                        nisi. Donec elementum sapien a ex pharetra, sit amet aliquam purus pellentesque. Duis sit amet
                        nulla
                        ligula. Duis id enim a ex vehicula consequat eget et tortor.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha384-..." crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-..."
        crossorigin="anonymous"></script>
</body>

</html>
