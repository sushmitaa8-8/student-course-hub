<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<main id="main-content">

    <section class="hero">
        <div class="container hero-grid">
            <div>
                <h2>Find your perfect degree at Kripa Technical Institute</h2>
                <p class="lead">
                    Discover our range of undergraduate and postgraduate programmes
                    in technology, computing, and engineering. Register your interest
                    today and we will keep you informed about open days, application
                    deadlines, and programme updates.
                </p>
                <div class="button-group">
                    <a class="btn btn-primary" href="/student-course-hub/?page=programmes">Browse Programmes</a>
                    <a class="btn btn-outline" href="/student-course-hub/?page=interest">Register Interest</a>
                </div>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div class="section-heading">
                <h2>Explore Our Pages</h2>
            </div>
            <div class="grid grid-3">
                <article class="card">
                    <h3>Student Pages</h3>
                    <p>Browse programmes, see modules, check staff, and register your interest.</p>
                    <a class="text-link" href="/student-course-hub/?page=programmes">Open student pages</a>
                </article>
                <article class="card">
                    <h3>Forms</h3>
                    <p>Register or withdraw your interest in a programme.</p>
                    <a class="text-link" href="/student-course-hub/?page=interest">Register interest</a>
                    <br>
                    <a class="text-link" href="/student-course-hub/?page=withdraw">Withdraw interest</a>
                </article>
                <article class="card">
                    <h3>Admin Area</h3>
                    <p>Manage programmes, modules, and view the student mailing list.</p>
                    <a class="text-link" href="/student-course-hub/?page=login">Admin login</a>
                </article>
            </div>
        </div>
    </section>

</main>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>